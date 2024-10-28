<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Appraisal;
use App\Models\AppraisalCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Excel;
use App\Imports\PegawaiImport;
use Illuminate\Support\Facades\Hash; // Use for password hashing
use Spatie\Permission\Models\Role;

class AppraisalController extends Controller
{
    public function index()
    {
        $appraisals = Appraisal::all();
        return view('dashboard.appraisal', compact('appraisals'));
    }

    public function category()
    {
        $appraisalcategorys = AppraisalCategory::all();
        return view('dashboard.appraisalcategory', compact('appraisalcategorys'));
    } 
    
    public function showupdatecategory(AppraisalCategory $appraisalcategorys)
    {
        return view('dashboard.edit-appraisalcategory', compact('appraisalcategorys'));
    }

    public function createcategory()
    {
        return view('dashboard.tambah-appraisalcategory');
    }

    public function create()
    {
        return view('dashboard.tambah-appraisal');
    }

    public function storecategory(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        AppraisalCategory::create([
            'id',
            'title' => $request->title,
            'description' => $request->description,
            'isactive'=>'1'
        ]);

        return redirect()->route('appraisal.category')->with('success', 'Data berhasil ditambahkan!');
    }

    public function updatecategory(Request $request,AppraisalCategory $appraisalcategorys)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'isactive' => 'required',
        ]);

       
        $appraisalcategorys->update([
            'title' => $request->title,
            'description' => $request->description,
            'isactive' => $request->isactive,
        ]);
        
        return redirect()->route('appraisal.category')->with('success', 'Data berhasil diupdate!');
    }
}