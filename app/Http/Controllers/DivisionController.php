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
        $divisions = Division::with('directorate')
            ->join('directorates', 'divisions.directorate_id', '=', 'directorates.id')
            ->orderBy('directorates.nama_directorate', 'asc')
            ->orderBy('divisions.nama_division', 'asc')
            ->select('divisions.*')
            ->get();

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

        return redirect()->route('division.index')->with('success', 'Division berhasil dibuat!');
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
            'nama_division' => 'required|unique:divisions,nama_division,' . $division->id,
        ]);

        $division->update([
            'nama_division' => $request->input('nama_division'),
        ]);
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
        $nama_directorate = $request->query('directorate_id');

        // Check if a division with the same 'nama_division' exists
        $exists = Division::where('nama_division', $nama_division)
                            ->where('directorate_id', $nama_directorate)
                            ->exists();

        // Return a JSON response with the result
        return response()->json(['exists' => $exists]);
    }
}
