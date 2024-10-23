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
        // Retrieve overtimes that are not deleted and eager load the pegawai relationship
        $overtimes = Overtime::with('pegawai')->where('is_deleted', false)->paginate(10);

        return view('dashboard.overtime', compact('overtimes'));
    }


    public function create()
    {
        // Fetch only active reasons (is_active = true)
        $overtimeReasons = OvertimeReasonOrder::where('is_active', true)->get();

        // Pass the reasons to the view
        return view('dashboard.tambah-overtime', compact('overtimeReasons'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'person_id' => 'required',
            'request_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'overtime_reason_order_id' => 'required',
            'todo_list' => 'required',
            'nama',
            'department',
        ]);

        Overtime::create([
            'person_id' => $request->person_id,
            'request_date' => $request->request_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'overtime_reason_order_id' => $request->overtime_reason_order_id,
            'todo_list' => $request->todo_list,
            'name' => $request->name,
            'department' => $request->department,
            'status' => 'Plan', // Set status to "Plan" by default
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
        $pegawais = Pegawai::where('nrp', 'LIKE', "%{$query}%")
            ->orWhere('nama', 'LIKE', "%{$query}%")
            ->limit(10)  // Limiting the number of results to prevent overload
            ->get(['id', 'nrp', 'nama', 'department', 'division']);

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



}
