<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Department;
use App\Models\Directorate;
use App\Models\Division;
use App\Models\Section;

class DirectorateController extends Controller
{
    public function index()
    {
        $directorates = Directorate::all();
        return view('dashboard.directorate', compact('directorates'));
    }

    public function create()
    {
        $companies = Company::all();
        $directorates = Directorate::all();
        $divisions = Division::all();
        $departments = Department::all();
        $sections = Section::all();

        return view('dashboard.tambah-directorate', compact('companies', 'directorates', 'divisions', 'departments', 'sections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_directorate' => 'required',
            'company_id' => 'required|exists:companies,id',
        ]);

        Directorate::create($request->all());

        return redirect()->route('directorate.index')->with('success', 'Directorate berhasil dibuat!.');
    }

    public function view(Directorate $directorate)
    {
        return view('dashboard.view-directorate', compact('directorate'));
    }

    public function edit(Directorate $directorate)
    {
        return view('dashboard.edit-directorate', compact('directorate'));
    }

    public function update(Request $request, Directorate $directorate)
    {
        $request->validate([
            'nama_directorate' => 'required',
            'company_id' => 'required|exists:companies,id',
        ]);

        $directorate->update($request->all());

        return redirect()->route('directorate.index')->with('success', 'Directorate berhasil di-update.');
    }

    public function delete(Directorate $directorate)
    {
        $directorate->delete();

        return redirect()->route('directorate.index')->with('success', 'Directorate berhasil dihapus.');
    }

    public function checkNamaDirectorate(Request $request)
    {
        // Fetch the 'nama_directorate' from the request
        $nama_directorate = $request->query('nama_directorate');

        // Check if a directorate with the same 'nama_directorate' exists
        $exists = Directorate::where('nama_directorate', $nama_directorate)->exists();

        // Return a JSON response with the result
        return response()->json(['exists' => $exists]);
    }
}
