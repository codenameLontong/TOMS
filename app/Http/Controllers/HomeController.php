<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Vendor;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index()
    {
        // Get the counts for Pegawai and Vendor
        $jumlahPegawai = Pegawai::where('employment_status', 'active')->count();
        $jumlahVendor = Vendor::count();

        // Pass these variables to your current view
        return view('dashboard', compact('jumlahPegawai', 'jumlahVendor'));
    }
}
