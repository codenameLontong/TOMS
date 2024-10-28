<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Department;
use App\Models\Directorate;
use App\Models\Division;
use App\Models\Section;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::all();
        return view('dashboard.section', compact('sections'));
    }

    public function create()
    {
        $companies = Company::all();
        $directorates = Directorate::all();
        $divisions = Division::all();
        $departments = Department::all();
        $sections = Section::all();

        return view('dashboard.tambah-section', compact('companies', 'directorates', 'divisions', 'departments', 'sections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_section' => 'required',
            'department_id' => 'required|exists:departments,id',
        ]);

        Section::create($request->all());

        return redirect()->route('section.index')->with('success', 'Section berhasil dibuat!.');
    }

    public function view(Section $section)
    {
        return view('dashboard.view-section', compact('section'));
    }

    public function edit(Section $section)
    {
        return view('dashboard.edit-section', compact('section'));
    }

    public function update(Request $request, Section $section)
    {
        $request->validate([
            'nama_section' => 'required',
            'department_id' => 'required|exists:departments,id',
        ]);

        $section->update($request->all());

        return redirect()->route('section.index')->with('success', 'Section berhasil di-update.');
    }

    public function delete(Section $section)
    {
        $section->delete();

        return redirect()->route('section.index')->with('success', 'Section berhasil dihapus.');
    }
}
