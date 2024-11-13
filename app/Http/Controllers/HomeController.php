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

        // Group Pegawai counts by cabang (location) and gender
        $pegawaiData = Pegawai::where('employment_status', 'active')
            ->selectRaw('cabang, jenis_kelamin, COUNT(*) as count')
            ->groupBy('cabang', 'jenis_kelamin')
            ->get();

        // Prepare data for the map
        $mapData = $pegawaiData->groupBy('cabang')->map(function ($items) {
            $maleCount = $items->where('jenis_kelamin', 'MALE')->sum('count');
            $femaleCount = $items->where('jenis_kelamin', 'FEMALE')->sum('count');
            $totalCount = $maleCount + $femaleCount;

            return [
                'MALE' => $maleCount,
                'FEMALE' => $femaleCount,
                'total' => $totalCount,
            ];
        });

        // Data for the gender pie chart
        $genderData = Pegawai::where('employment_status', 'active')
            ->selectRaw("jenis_kelamin, COUNT(*) as count")
            ->groupBy('jenis_kelamin')
            ->pluck('count', 'jenis_kelamin');

        // Data for the company pie chart
        $companyData = Pegawai::where('employment_status', 'active')
            ->selectRaw("coy, COUNT(*) as count")
            ->whereIn('coy', ['TRAKTOR NUSANTARA', 'SWADAYA HARAPAN NUSANTARA'])
            ->groupBy('coy')
            ->pluck('count', 'coy');

        // Data for the education pie chart
        $educationLevels = ['SD', 'SMP', 'SLTP', 'SMA', 'SMK', 'S1', 'D1', 'D3', 'D4'];
        $educationData = Pegawai::where('employment_status', 'active')
            ->selectRaw("pendidikan, COUNT(*) as count")
            ->whereIn('pendidikan', $educationLevels)
            ->groupBy('pendidikan')
            ->pluck('count', 'pendidikan');

        return view('dashboard', compact('jumlahPegawai', 'jumlahVendor', 'mapData', 'genderData', 'companyData', 'educationData'));
    }
}
