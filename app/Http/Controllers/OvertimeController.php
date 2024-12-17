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
        $user = auth()->user();
        $userId = $user->id;
        $userRoleId = $user->role_id;

        // General query for all overtimes
        $overtimes = Overtime::with('pegawai')
            ->where('is_deleted', false)
            ->orderBy('id', 'desc');

        // Check for role-based filtering
        if ($userRoleId == 5) { // 'hcs_dept_head' role
            $overtimes = $overtimes->whereIn('status', ['Need HC Approval', 'Approved']);
        } elseif (!in_array($userRoleId, [1, 2])) { // Regular users
            $overtimes = $overtimes->where(function ($query) use ($userId, $user) {
                $query->whereHas('pegawai', function ($subQuery) use ($user) {
                    $subQuery->where('alamat_email', $user->email);
                })
                ->orWhere('order_by', $userId);
            });
        } elseif (in_array($userRoleId, [3, 4])) { // Specific roles needing verification
            $overtimes = $overtimes->where('status', 'Need Verification');
        }

        // Fetch all overtimes with pagination
        $overtimes = $overtimes->paginate(10);

        // Filter rejected overtimes specific to the logged-in user
        if (in_array($userRoleId, [1, 2])) {
            // Admin or Superadmin can see all rejected overtimes
            $rejectedOvertimes = Overtime::with('pegawai')
                ->whereIn('status', ['Rejected', 'Rejected by Superior', 'Rejected by Employee'])
                ->get(); // No user-based filter
        } else {
            // Regular users only see rejected overtimes related to them
            $rejectedOvertimes = Overtime::with('pegawai')
                ->whereIn('status', ['Rejected', 'Rejected by Superior', 'Rejected by Employee'])
                ->where(function ($query) use ($userId) {
                    $query->where('escalation_approved_by', $userId)
                        ->orWhere('approved_by', $userId)
                        ->orWhere('order_by', $userId); // Check if any of the columns match the logged-in user's ID
                })
                ->get(); // Filtered for the logged-in user
        }

        return view('dashboard.overtime', compact('overtimes', 'rejectedOvertimes'));
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
        // Find the overtime record by ID, including related data
        $overtime = Overtime::with(['overtimeReason', 'orderedBy'])->findOrFail($id);

        // Get the newest HC user with role_id = 5
        $hcUser = \App\Models\User::where('role_id', 5)->latest()->first();

        // Return the detail view with the overtime data and HC user
        return view('dashboard.view-overtime', compact('overtime', 'hcUser'));
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
    $user = auth()->user(); // Logged-in user

    // Determine rejection status based on the user's role_id
    if ($user->role_id == 3) {
        // If the user has role_id = 3 (Superior)
        $status = 'Rejected by Superior';
    } elseif ($user->role_id == 7) {
        // If the user has role_id = 7 (Employee)
        $status = 'Rejected by Employee';
    } else {
        // Fallback status if the role_id doesn't match either condition
        $status = 'Rejected';
    }

    // Update the overtime record with rejection details
    $overtime->update([
        'rejected_by' => $user->id,
        'rejected_at' => now(),
        'rejected_note' => request('rejected_note'),
        'status' => $status, // Set the status based on the user's role_id
    ]);

    return redirect()->back()->with('error', 'Overtime has been rejected.');
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
    public function reapprove($id)
{
    $overtime = Overtime::findOrFail($id);
    $user = auth()->user(); // Logged-in pegawai

    // Check if the user is the previous approver
    if ($user->id !== $overtime->approved_by && $user->id !== $overtime->escalation_approved_by) {
        return redirect()->back()->with('error', 'You are not authorized to reapprove this overtime.');
    }

    // Update overtime details with the new inputs
    $overtime->update([
        'start_time' => request('start_time'),
        'end_time' => request('end_time'),
        'approved_note' => request('approved_note'),
        'status' => 'Need HC Approval', // Change the status back to 'Need HC Approval' or any other appropriate status
    ]);

    return redirect()->route('overtime.index')->with('success', 'Overtime has been re-sent for approval.');
}


    public function exportXlsx()
    {
        $overtimeData = Overtime::with(['pegawai', 'overtimeReason'])->get()->map(function ($overtime) {
            return [
                'id' => $overtime->id,
                'pegawai_name' => $overtime->pegawai->nama ?? 'N/A',
                'directorate' => $overtime->pegawai->directorate ?? 'N/A',
                'division' => $overtime->pegawai->division ?? 'N/A',
                'department' => $overtime->pegawai->department ?? 'N/A',
                'section' => $overtime->pegawai->section ?? 'N/A',
                'order_by' => $overtime->orderedBy->name ?? 'N/A',
                'order_at' => $overtime->order_at,
                'is_holiday' => $overtime->is_holiday ? 'Yes' : 'No',
                'request_date' => $overtime->request_date,
                'start_time' => $overtime->start_time,
                'end_time' => $overtime->end_time,
                'overtime_reason' => $overtime->overtimeReason->title ?? 'N/A',
                'todo_list' => $overtime->todo_list,
                'note' => $overtime->note,
                'status' => $overtime->status,
                'approved_by' => $overtime->approvedByUser->name ?? 'N/A',
                'approved_at' => $overtime->approved_at,
                'approved_note' => $overtime->approved_note,
                'approved_date' => $overtime->approved_date,
                'approved_start_time' => $overtime->approved_start_time,
                'approved_end_time' => $overtime->approved_end_time,
                'escalation_approved_by' => $overtime->escalationApprovedByUser->name ?? 'N/A',
                'escalation_approved_at' => $overtime->escalation_approved_at,
                'escalation_approved_note' => $overtime->escalation_approved_note,
                'escalation_approved_date' => $overtime->escalation_approved_date,
                'escalation_approved_start_time' => $overtime->escalation_approved_start_time,
                'escalation_approved_end_time' => $overtime->escalation_approved_end_time,
                'hc_head_confirmed_by' => $overtime->hcHeadConfirmedByUser->name ?? 'N/A',
                'hc_head_confirmed_at' => $overtime->hc_head_confirmed_at,
                'hc_head_confirmed_note' => $overtime->hc_head_confirmed_note,
                'hc_head_confirmed_date' => $overtime->hc_head_confirmed_date,
                'hc_head_confirmed_start_time' => $overtime->hc_head_confirmed_start_time,
                'hc_head_confirmed_end_time' => $overtime->hc_head_confirmed_end_time,
                'rejected_at' => $overtime->rejected_at ?? 'N/A',
                'rejected_by' => $overtime->rejectedByUser->name ?? 'N/A',
                'rejected_note' => $overtime->rejected_note ?? 'N/A',
            ];
        });

        $filename = 'overtime_data_export.xlsx';

        return Excel::download(new class($overtimeData) implements \Maatwebsite\Excel\Concerns\FromCollection, \Maatwebsite\Excel\Concerns\WithHeadings {
            private $data;
            public function __construct($data)
            {
                $this->data = $data;
            }

            public function collection()
            {
                return collect($this->data);
            }

            public function headings(): array
            {
                return [
                    'ID',
                    'Pegawai Name',
                    'Directorate',
                    'Division',
                    'Department',
                    'Section',
                    'Order By',
                    'Order At',
                    'Is Holiday',
                    'Request Date',
                    'Start Time',
                    'End Time',
                    'Overtime Reason',
                    'To-Do List',
                    'Note',
                    'Status',
                    'Approved By Employee',
                    'Approved At',
                    'Approved Note',
                    'Approved Date',
                    'Approved Start Time',
                    'Approved End Time',
                    'Superior Approved By',
                    'Superior Approved At',
                    'Superior Approved Note',
                    'Superior Approved Date',
                    'Superior Approved Start Time',
                    'Superior Approved End Time',
                    'HC Head Confirmed By',
                    'HC Head Confirmed At',
                    'HC Head Confirmed Note',
                    'HC Head Confirmed Date',
                    'HC Head Confirmed Start Time',
                    'HC Head Confirmed End Time',
                    'Rejected At',
                    'Rejected By',
                    'Rejected Note',
                ];
            }
        }, $filename);
    }
}
