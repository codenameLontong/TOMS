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


    public function edit($id)
    {
        $overtime = Overtime::findOrFail($id);
        return view('overtime.edit', compact('overtime'));
    }

    public function update(Request $request, $id)
    {
        $overtime = Overtime::findOrFail($id);
        $overtime->update($request->all());
        return redirect()->route('dashboard.overtime');
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
}
