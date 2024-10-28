<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Department;
use App\Models\Directorate;
use App\Models\Division;
use App\Models\Section;

class DivisionController extends Controller
{
    public function index()
    {
        $divisions = Division::all();
        return view('dashboard.division', compact('divisions'));
    }

    public function create()
    {
        $companies = Company::all();
        $directorates = Directorate::all();
        $divisions = Division::all();
        $departments = Department::all();
        $sections = Section::all();

        return view('dashboard.tambah-division', compact('companies', 'directorates', 'divisions', 'departments', 'sections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_division' => 'required',
            'directorate_id' => 'required|exists:directorates,id',
        ]);

        Division::create($request->all());

        return redirect()->route('division.index')->with('success', 'Division berhasil dibuat!.');
    }

    public function view(Division $division)
    {
        return view('dashboard.view-division', compact('division'));
    }

    public function edit(Division $division)
    {
        return view('dashboard.edit-division', compact('division'));
    }

    public function update(Request $request, Division $division)
    {
        $request->validate([
            'nama_division' => 'required',
            'directorate_id' => 'required|exists:directorates,id',
        ]);

        $division->update($request->all());

        return redirect()->route('division.index')->with('success', 'Division berhasil di-update.');
    }

    public function delete(Division $division)
    {
        $division->delete();

        return redirect()->route('division.index')->with('success', 'Division berhasil dihapus.');
    }

    public function checkNamaDivision(Request $request)
    {
        // Fetch the 'nama_division' from the request
        $nama_division = $request->query('nama_division');

        // Check if a division with the same 'nama_division' exists
        $exists = Division::where('nama_division', $nama_division)->exists();

        // Return a JSON response with the result
        return response()->json(['exists' => $exists]);
    }

    public function getDirectoratesByCompany(Request $request)
    {
        // Fetch the 'company_id' from the request
        $companyId = $request->query('company_id');

        // Get the directorates associated with the selected company
        $directorates = Directorate::where('company_id', $companyId)->get();

        // Return a JSON response with the directorates
        return response()->json(['directorates' => $directorates]);
    }
}
