<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Department;
use App\Models\Directorate;
use App\Models\Division;
use App\Models\Section;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::with('division')
            ->join('divisions', 'departments.division_id', '=', 'divisions.id')
            ->orderBy('divisions.nama_division', 'asc')
            ->orderBy('departments.nama_department', 'asc')
            ->select('departments.*')
            ->get();

        return view('dashboard.department', compact('departments'));
    }

    public function create()
    {
        $companies = Company::all();
        $directorates = Directorate::all();
        $divisions = Division::all();
        $departments = Department::all();
        $sections = Section::all();

        return view('dashboard.tambah-department', compact('companies', 'directorates', 'divisions', 'departments', 'sections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_department' => 'required',
            'division_id' => 'required|exists:divisions,id',
        ]);

        Department::create($request->all());

        return redirect()->route('department.index')->with('success', 'Department berhasil dibuat!');
    }

    public function view(Department $department)
    {
        return view('dashboard.view-department', compact('department'));
    }

    public function edit(Department $department)
    {
        return view('dashboard.edit-department', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'nama_department' => 'required|unique:departments,nama_department,' . $department->id,
        ]);

        $department->update([
            'nama_department' => $request->input('nama_department'),
        ]);
        return redirect()->route('department.index')->with('success', 'Department berhasil di-update.');
    }

    public function delete(Department $department)
    {
        $department->delete();

        return redirect()->route('department.index')->with('success', 'Department berhasil dihapus.');
    }

    public function checkNamaDepartment(Request $request)
    {
        // Fetch the 'nama_department' and 'division_id' from the request
        $nama_department = $request->query('nama_department');
        $nama_division = $request->query('division_id');

        // Check if a department with the same 'nama_department' exists in the selected 'division_id'
        $exists = Department::where('nama_department', $nama_department)
                            ->where('division_id', $nama_division)
                            ->exists();

        // Return a JSON response with the result
        return response()->json(['exists' => $exists]);
    }
}
