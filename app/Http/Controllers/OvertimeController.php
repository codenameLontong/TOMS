<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use App\Models\PegawaiHistory;
use App\Models\Overtime;
use App\Models\OvertimeReasonOrder;
use App\Models\Exception;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Excel;
use App\Imports\PegawaiImport;
use Illuminate\Support\Facades\Hash; // Use for password hashing
use Spatie\Permission\Models\Role;

class OvertimeController extends Controller
{
    public function index()
{
    // Get the logged-in user's ID, email, role_id, and dept_id
    $user = auth()->user();
    $userId = $user->id;
    $userEmail = $user->email;
    $userRoleId = $user->role_id;

    // Check if the user is the special user with role 'hcs_dept_head' (role_id 5)
    if ($userRoleId == 5) {
        $overtimes = Overtime::with('pegawai')
            ->where('is_deleted', false)
            ->whereIn('status', ['Need HC Approval', 'Approved'])
            ->paginate(10);
    } elseif (!in_array($userRoleId, [1, 2])) {
        // Regular users who are not superadmin/admin, apply email and order_by conditions
        $overtimes = Overtime::with('pegawai')
            ->where('is_deleted', false)
            ->where(function ($query) use ($userEmail, $userId) {
                $query->whereHas('pegawai', function ($subQuery) use ($userEmail) {
                    $subQuery->where('alamat_email', $userEmail);
                })
                ->orWhere('order_by', $userId); // Check if order_by matches the logged-in user's ID
            })
            ->paginate(10);
    } elseif (auth()->user()->role_id === 3 || auth()->user()->role_id === 4) {
        $overtimes = Overtime::where('status', 'Need Verification')->get();
    } else {
        // For superadmin/admin users, show all non-deleted overtimes
        $overtimes = Overtime::with('pegawai')
            ->where('is_deleted', false)
            ->paginate(10);
    }

    // Check and update is_holiday for each overtime record
    foreach ($overtimes as $overtime) {
        $isWeekend = in_array(Carbon::parse($overtime->request_date)->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY]);
        $isExceptionHoliday = Exception::where('holiday_date', $overtime->request_date)->exists();

        $isHoliday = $isWeekend || $isExceptionHoliday;

        // Update the is_holiday column if necessary
        if ($overtime->is_holiday != $isHoliday) {
            $overtime->update(['is_holiday' => $isHoliday ? 1 : 0]);
        }
    }

    return view('dashboard.overtime', compact('overtimes'));
}


    public function create()
    {
        // Fetch only active reasons (is_active = true)
        $overtimeReasons = OvertimeReasonOrder::where('is_active', true)->get();

        // Fetch all pegawai from pegawais table (or users table if linked)
        $pegawais = Pegawai::all();  // Make sure 'Pegawai' model is correct

        if (auth()->user()->hasRole('pegawai')) {
            abort(403, 'Unauthorized action.');
        }

        // Pass the reasons and pegawai to the view
        return view('dashboard.tambah-overtime', compact('overtimeReasons', 'pegawais'));
    }

    public function store(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'request_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'overtime_reason_order_id' => 'required',
            'todo_list' => 'required',
        ]);

        // Find Pegawai by pegawai_id
        $pegawai = Pegawai::find($request->pegawai_id);

        if (!$pegawai) {
            return redirect()->back()->withErrors(['pegawai_id' => 'Pegawai with this ID not found.']);
        }

        // Check if the request_date is a weekend
        $isWeekend = in_array(Carbon::parse($request->request_date)->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY]);

        // Check if the request_date is in the exceptions table
        $isExceptionHoliday = Exception::where('holiday_date', $request->request_date)->exists();

        // Set is_holiday to 1 if it's a weekend or an exception holiday
        $isHoliday = $isWeekend || $isExceptionHoliday;

        // Create the overtime record
        Overtime::create([
            'pegawai_id' => $pegawai->id,
            'request_date' => $request->request_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'overtime_reason_order_id' => $request->overtime_reason_order_id,
            'todo_list' => $request->todo_list,
            'name' => $pegawai->nama,
            'department' => $pegawai->department,
            'status' => 'Plan',
            'email' => $pegawai->alamat_email,
            'order_by' => auth()->user()->id,
            'order_at' => now(),
            'is_holiday' => $isHoliday ? 1 : 0, // Set is_holiday based on the checks
        ]);

        // Redirect or return a response
        return redirect()->route('overtime.index')->with('success', 'Overtime request created successfully.');
    }

    public function destroy($id)
    {
        $overtime = Overtime::findOrFail($id);
        // Set the deleted_by before calling delete
        $overtime->deleted_by = auth()->user()->id;
        $overtime->is_deleted = true;
        $overtime->save(); // Save the change to deleted_by
        $overtime->delete(); // Soft delete the record

        return redirect()->route('overtime.index')->with('success', 'Overtime data marked as deleted.');
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Fetch pegawais where employment_status is active
        $pegawais = Pegawai::where('employment_status', 'active')
            ->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('nrp', 'LIKE', "%{$query}%")
                            ->orWhere('nama', 'LIKE', "%{$query}%");
            })
            ->get(['id', 'nrp', 'nama', 'department', 'division', 'alamat_email']);

        return response()->json($pegawais);
    }


    public function show($id)
    {
        // Find the overtime record by ID
        $overtime = Overtime::with('overtimeReason')->findOrFail($id);

        // Return the detail view
        return view('dashboard.view-overtime', compact('overtime'));
    }
    public function edit($id)
    {
        // Find the overtime record by ID
        $overtime = Overtime::with('overtimeReason')->findOrFail($id);
        $overtimeReasons = OvertimeReasonOrder::where('is_active', true)->get();

        // Return the edit view
        return view('dashboard.edit-overtime', compact('overtime', 'overtimeReasons'));
    }
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'request_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'overtime_reason_order_id' => 'required|exists:overtime_reason_orders,id',
            'todo_list' => 'required|string',
        ]);

        // Find the overtime record by ID
        $overtime = Overtime::findOrFail($id);

        // Update the overtime record with the validated data
        $overtime->update($validatedData);

        // Redirect the user back to the detail page with a success message
        return redirect()->route('overtime.index')->with('success', 'Overtime updated successfully!');
    }
    public function approve($id)
    {
        $overtime = Overtime::findOrFail($id);
        $user = auth()->user(); // Logged-in pegawai

        // Update overtime record with approved data
        $overtime->update([
            'approved_by' => auth()->user()->id,
            'approved_at' => now(),
            'approved_note' => request('approved_note'),
            'approved_date' => $overtime->request_date,
            'approved_start_time' => $overtime->start_time,
            'approved_end_time' => $overtime->end_time,
            'status' => 'Need Verification', // Or any status you'd prefer
        ]);

        return redirect()->back()->with('success', 'Overtime approved successfully!');
    }
    public function reject($id)
    {
        $overtime = Overtime::findOrFail($id);
        $user = auth()->user(); // Logged-in pegawai

        // Update overtime record with rejected data
        $overtime->update([
            'rejected_by' => auth()->user()->id,
            'rejected_at' => now(),
            'rejected_note' => request('rejected_note'),
            'status' => 'Rejected',
        ]);

        return redirect()->back()->with('error', 'Overtime rejected.');
    }
    public function verify(Request $request, $id)
{
    $overtime = Overtime::findOrFail($id); // Retrieve the specific overtime record
    $user = auth()->user(); // Get the currently logged-in user

    // Check if the start and end times have been provided by the user.
    // If they haven't been modified, fall back to the current values in the $overtime object.
    $approvedStartTime = $request->input('approved_start_time') ?? $overtime->approved_start_time;
    $approvedEndTime = $request->input('approved_end_time') ?? $overtime->approved_end_time;

    // Update the overtime record with the verification and approval data
    $overtime->update([
        'escalation_approved_by' => $user->id,
        'escalation_approved_at' => now(),
        'escalation_approved_note' => $request->input('verification_note'), // Store verification note
        'escalation_approved_date' => $overtime->request_date, // Keep original request date
        'escalation_approved_start_time' => $approvedStartTime, //  Use either modified or original start time
        'escalation_approved_end_time' => $approvedEndTime, // Use either modified or original end time
        'status' => 'Need HC Approval', // Update the status
    ]);

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Overtime approved successfully!');
}

    public function confirm($id)
    {
        $overtime = Overtime::findOrFail($id);
        $user = auth()->user(); // Logged-in pegawai

        // Update overtime record with approved data
        $overtime->update([
            'hc_head_confirmed_by' => auth()->user()->id,
            'hc_head_confirmed_at' => now(),
            'hc_head_confirmed_note' => request('confirmation_note'),
            'hc_head_confirmed_date' => $overtime->request_date,
            'hc_head_confirmed_start_time' => $overtime->start_time,
            'hc_head_confirmed_end_time' => $overtime->end_time,
            'status' => 'Approved', // Or any status you'd prefer
        ]);

        return redirect()->back()->with('success', 'Overtime approved successfully!');
    }

}
