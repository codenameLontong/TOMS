<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Vendor;
use App\Models\Overtime;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        // Get the counts for Pegawai and Vendor
        $jumlahPegawai = Pegawai::where('employment_status', 'active')->count();
        $jumlahVendor = Vendor::count();

        // Fetch overtime status counts
        $overtimeCounts = Overtime::selectRaw('status, COUNT(*) as count')
            ->where('is_deleted', false)
            ->groupBy('status')
            ->pluck('count', 'status');

        // Ensure all statuses are available even if no overtime of that status exists
        $overtimeStatuses = [
            'Need Verification' => 0,
            'Need HC Approval' => 0,
            'Approved' => 0,
        ];

        foreach ($overtimeCounts as $status => $count) {
            if (array_key_exists($status, $overtimeStatuses)) {
                $overtimeStatuses[$status] = $count;
            }
        }

        // Group Pegawai counts by cabang (location) and gender
        $pegawaiData = Pegawai::where('employment_status', 'active')
            ->selectRaw('cabang, jenis_kelamin, COUNT(*) as count')
            ->groupBy('cabang', 'jenis_kelamin')
            ->get();

        // Prepare data for the map
        $mapData = $pegawaiData->groupBy('cabang')->map(function ($items) {
            $maleCount = $items->where('jenis_kelamin', 'PRIA')->sum('count');
            $femaleCount = $items->where('jenis_kelamin', 'WANITA')->sum('count');
            $totalCount = $maleCount + $femaleCount;

            return [
                'PRIA' => $maleCount,
                'WANITA' => $femaleCount,
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
        $educationLevels = ['SD/Sederajat', 'SMP/Sederajat', 'SMA/Sederajat','S1','D1','D2','D3','D4'];
        $educationData = Pegawai::where('employment_status', 'active')
            ->selectRaw("pendidikan, COUNT(*) as count")
            ->whereIn('pendidikan', $educationLevels)
            ->groupBy('pendidikan')
            ->pluck('count', 'pendidikan');

        // Get the counts of appraisal statuses
        $appraisalStatusCounts = DB::table('appraisals_employee')
            ->select(DB::raw('appraisal_status, COUNT(*) as count'))
            ->groupBy('appraisal_status')
            ->pluck('count', 'appraisal_status');

        // Ensure both statuses are present
        $appraisalStatuses = [
            1 => 0, // Need Superior Approval
            2 => 0, // Approved
        ];

        foreach ($appraisalStatusCounts as $status => $count) {
            if (array_key_exists($status, $appraisalStatuses)) {
                $appraisalStatuses[$status] = $count;
            }
        }

        // Pass the overtime status counts to the view
        return view('dashboard', compact(
            'jumlahPegawai',
            'jumlahVendor',
            'mapData',
            'genderData',
            'companyData',
            'educationData',
            'overtimeStatuses', // New variable passed to the view
            'appraisalStatuses', // Pass the appraisal status counts here
        ));
    }

    public function filterMapData(Request $request)
    {
        $company = $request->get('company');

        if (!$company) {
            return response()->json([]);
        }

        $pegawaiData = Pegawai::where('employment_status', 'active')
            ->where('coy', $company)
            ->selectRaw('cabang, jenis_kelamin, COUNT(*) as count')
            ->groupBy('cabang', 'jenis_kelamin')
            ->get();

        $mapData = $pegawaiData->groupBy('cabang')->map(function ($items) {
            $maleCount = $items->where('jenis_kelamin', 'PRIA')->sum('count');
            $femaleCount = $items->where('jenis_kelamin', 'WANITA')->sum('count');
            $totalCount = $maleCount + $femaleCount;

            return [
                'PRIA' => $maleCount,
                'WANITA' => $femaleCount,
                'total' => $totalCount,
            ];
        });

        return response()->json($mapData);
    }

    public function getOvertimeData(Request $request)
    {
        // Default to the current year if none is selected
        $year = $request->get('year', now()->year);

        // Initialize an array to hold total overtime hours for each month
        $monthlyOvertime = array_fill(1, 12, 0);

        // Fetch overtime data where status is approved and hc_head_confirmed_date is within the selected year
        $overtimeData = Overtime::where('status', 'Approved')
            ->whereYear('hc_head_confirmed_date', $year) // Filter by year
            ->get();

        // Loop through each overtime record to calculate the total hours per month
        foreach ($overtimeData as $overtime) {
            // Extract month from hc_head_confirmed_date
            $month = Carbon::parse($overtime->hc_head_confirmed_date)->month;

            // Calculate overtime hours (difference between start and end time)
            $start = Carbon::parse($overtime->hc_head_confirmed_start_time);
            $end = Carbon::parse($overtime->hc_head_confirmed_end_time);

            // Add the calculated hours to the respective month
            $overtimeHours = $end->diffInHours($start); // Difference in hours
            $monthlyOvertime[$month] += $overtimeHours;
        }

        // Return the monthly overtime data as JSON
        return response()->json($monthlyOvertime);
    }


    public function getAvailableYears()
    {
        $years = Overtime::where('status', 'Approved')
                        ->selectRaw('YEAR(hc_head_confirmed_date) as year')
                        ->distinct()
                        ->pluck('year')
                        ->sortDesc();

        return response()->json(['years' => $years]);
    }

}
