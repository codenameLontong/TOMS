<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use App\Models\PegawaiHistory;
use App\Models\Overtime;
use App\Models\OvertimeReasonOrder;
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
        // Get the logged-in user's email and ID
        $userEmail = auth()->user()->email;
        $userId = auth()->user()->id;

        // Check if the user is the special user with ID 5
        if ($userId == 5) {
            // For user with ID 5, show only overtimes with statuses 'Need HC Approval' and 'Confirmed'
            $overtimes = Overtime::with('pegawai')
                ->where('is_deleted', false)
                ->whereIn('status', ['Need HC Approval', 'Confirmed']) // Include both statuses
                ->paginate(10);
        } elseif (!auth()->user()->hasRole('superadmin') && !auth()->user()->hasRole('admin')) {
            // For regular users who are not superadmin/admin, apply email and order_by conditions
            $overtimes = Overtime::with('pegawai')
                ->where('is_deleted', false)
                ->where(function ($query) use ($userEmail, $userId) {
                    $query->whereHas('pegawai', function ($subQuery) use ($userEmail) {
                        $subQuery->where('alamat_email', $userEmail);
                    })
                    ->orWhere('order_by', $userId); // Check if order_by matches the logged-in user's ID
                })
                ->paginate(10);
        } else {
            // For superadmin/admin users, show all non-deleted overtimes
            $overtimes = Overtime::with('pegawai')
                ->where('is_deleted', false)
                ->paginate(10);
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
        // Validate incoming data (removing email validation)
        $request->validate([
            'person_id' => 'required|exists:pegawais,id',  // Validate the person_id exists in the pegawais table
            'request_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'overtime_reason_order_id' => 'required',
            'todo_list' => 'required',
        ]);

        // Find Pegawai by person_id
        $pegawai = Pegawai::find($request->person_id);

        if (!$pegawai) {
            return redirect()->back()->withErrors(['person_id' => 'Pegawai with this ID not found.']);
        }

        // Create the overtime record
        Overtime::create([
            'person_id' => $pegawai->id,  // Save Pegawai's person_id
            'request_date' => $request->request_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'overtime_reason_order_id' => $request->overtime_reason_order_id,
            'todo_list' => $request->todo_list,
            'name' => $pegawai->nama,  // Retrieve name from Pegawai
            'department' => $pegawai->department, // Retrieve department from Pegawai
            'status' => 'Plan', // Default status is "Plan"
            'email' => $pegawai->alamat_email, // Retrieve email from Pegawai
            'order_by' => auth()->user()->id, // Get logged-in user's ID
            'order_at' => now(), // Set current datetime
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
    public function verify($id)
    {
        $overtime = Overtime::findOrFail($id);
        $user = auth()->user(); // Logged-in pegawai

        // Update the overtime record with approved data
        $overtime->update([
            'escalation_approved_by' => $user->id,
            'escalation_approved_at' => now(),
            'escalation_approved_note' => request('verification_note'), // Ensure this is included in the request
            'escalation_approved_date' => $overtime->request_date,
            'escalation_approved_start_time' => $overtime->start_time,
            'escalation_approved_end_time' => $overtime->end_time,
            'status' => 'Need HC Approval', // Update the status as needed
        ]);

        return redirect()->back()->with('success', 'Overtime approved successfully!');
    }

    public function confirm($id)
    {
        $overtime = Overtime::findOrFail($id);
        $user = auth()->user(); // Logged-in pegawai

        // Update overtime record with approved data
        $overtime->update([
            'confirm_by' => auth()->user()->id,
            'confirm_at' => now(),
            'confirm_note' => request('verification_note'),
            'confirm_date' => $overtime->request_date,
            'confirm_start_time' => $overtime->start_time,
            'confirm_end_time' => $overtime->end_time,
            'status' => 'Approved', // Or any status you'd prefer
        ]);

        return redirect()->back()->with('success', 'Overtime approved successfully!');
    }

}
