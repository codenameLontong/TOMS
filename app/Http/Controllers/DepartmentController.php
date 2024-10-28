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
        $departments = Department::all();
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

        return redirect()->route('department.index')->with('success', 'Department berhasil dibuat!.');
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
            'nama_department' => 'required',
            'division_id' => 'required|exists:divisions,id',
        ]);

        $department->update($request->all());

        return redirect()->route('department.index')->with('success', 'Department berhasil di-update.');
    }

    public function delete(Department $department)
    {
        $department->delete();

        return redirect()->route('department.index')->with('success', 'Department berhasil dihapus.');
    }
}
