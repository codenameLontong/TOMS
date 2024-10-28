<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Department;
use App\Models\Directorate;
use App\Models\Division;
use App\Models\Section;

class StructureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all companies with their related directorates, divisions, departments, and sections
        $companies = Company::with([
            'directorates.divisions.departments.sections'
        ])->get();

        // Pass the hierarchical data to the view
        return view('dashboard.structure', compact('companies'));
    }

}
