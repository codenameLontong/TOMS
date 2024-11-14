<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Appraisal;
use App\Models\AppraisalCategory;
use App\Models\AppraisalEmployee;
use App\Models\AppraisalItem;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Excel;
use App\Imports\PegawaiImport;
use Illuminate\Support\Facades\Hash; // Use for password hashing
use Spatie\Permission\Models\Role;
use DB;

class AppraisalController extends Controller
{
    public function index()
    {
        $userEmail = auth()->user()->email;
        $role = auth()->user()->role_id;
        $departmentUser = auth()->user()->dept_id;
        $appraisals = DB::table('appraisals')
        ->leftJoin('appraisals_employee', 'appraisals.id', '=', 'appraisals_employee.id_appraisal')
        ->select('appraisals.*','appraisals_employee.id as appraisal_employee_id', 'appraisals_employee.pegawai_fill_at','appraisals_employee.superior_approved_at',
                'appraisals_employee.rata_rata','appraisals_employee.nilai_final','appraisals_employee.appraisal_status as appraisal_employee_status ',
                DB::raw("(SELECT status FROM appraisal_status WHERE appraisal_status.id = appraisals_employee.appraisal_status) as appraisal_status_name")
                )
        ->get();  
        
        $appraisalsEmployee = DB::table('appraisals_employee')
        ->join('pegawais', 'appraisals_employee.pegawai_id', '=', 'pegawais.id')
        ->whereIn('pegawais.id', function ($query) use ($departmentUser) {
            $query->select('pegawai_id')
                  ->from('users')
                  ->where('dept_id', $departmentUser);
        })
        ->select('appraisals_employee.id as id_appraisal_employee', 'appraisals_employee.*', 'pegawais.*')
        ->get();
        
        if($role==3){
        return view('dashboard.appraisal-approval', compact('appraisals','role','appraisalsEmployee'));
        }else{
            return view('dashboard.appraisal', compact('appraisals','role'));
        

    }
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
        $appraisalcategorys = AppraisalCategory::where('isactive', '1')->get();

        
        return view('dashboard.tambah-appraisal', compact('appraisalcategorys'));
    }

    public function updateappraisalemployee(AppraisalEmployee $appraisalsEmployee)
    {
        $pegawai_id = $appraisalsEmployee->pegawai_id;
        $cek_appraisal_employee = AppraisalEmployee::where('id_appraisal', $appraisalsEmployee->id_appraisal)
                                           ->where('pegawai_id', $pegawai_id)
                                           ->first();
            
        $appraisal = $appraisalsEmployee;
        $appraisal_item = DB::table('appraisals_item')
        ->join('appraisals_category', 'appraisals_item.id_appraisals_kategori', '=', 'appraisals_category.id')
        ->select('appraisals_item.*','appraisals_category.*')
        ->where('appraisals_item.id_appraisals_employee', $cek_appraisal_employee->id)
        ->get();    

        return view('dashboard.edit-appraisalemployee', compact('appraisal','appraisal_item'));  
    }

    public function createappraisalemployee(Appraisal $appraisal)
    {
        $pegawai_id = auth()->user()->id;
        $cek_appraisal_employee = AppraisalEmployee::where('id_appraisal', $appraisal->id)
                                           ->where('pegawai_id', $pegawai_id)
                                           ->get();
        $appraisal_employee=$cek_appraisal_employee->toArray();
        if($cek_appraisal_employee->isEmpty())
        {
        
        $get_id_appraisal_category = $appraisal->id_appraisals_kategori;
        $id_appraisal_category = array_map('intval', explode(',', $get_id_appraisal_category));
        $appraisalcategorys = AppraisalCategory::whereIn('id', $id_appraisal_category)->get();

       return view('dashboard.tambah-appraisalemployee', compact('appraisal','appraisalcategorys'));

        }else{
        
        $appraisal_item = DB::table('appraisals_item')
        ->join('appraisals_category', 'appraisals_item.id_appraisals_kategori', '=', 'appraisals_category.id')
        ->select('appraisals_item.*','appraisals_category.*')
        ->where('appraisals_item.id_appraisals_employee', $appraisal_employee[0])
        ->get(); 
        
        
        // AppraisalItem::where('id_appraisals_employee', $appraisal_employee[0])->get();
        return view('dashboard.view-appraisalemployee', compact('appraisal','appraisal_item'));
        
        }
        
        
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

    public function storeappraisal(Request $request)
    {
    $appraisalcategorys = AppraisalCategory::where('isactive', '1')->get();
        // Gabungkan ID kategori appraisal yang aktif menjadi satu string yang dipisahkan koma
    $appraisalcategorysid = $appraisalcategorys->pluck('id')->implode(',');  
    $monthperiod = $request->input('monthperiod');
    $yearperiod = $request->input('yearperiod');
    $period = $monthperiod . '-' . $yearperiod;

    // Simpan data ke database
    Appraisal::create([
        'appraisal_period' => $period,
        'id_appraisals_kategori' => $appraisalcategorysid,
        'appraisal_status' => '1',
    ]);

    
    // Redirect dengan pesan sukses
    return redirect()->route('appraisal.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function storeappraisalemployee(Request $request)
    {
    
    $appraisal_status='1';
    $pegawai_id = auth()->user()->pegawai_id;
    $input=$request->all();
    $data=[];
    foreach ($input as $key => $value) {
        $data[$key] = $value; // Menyimpan setiap input dalam array $data
    }

    $filteredArray = [];
    foreach ($input as $key => $value) {
    if (is_numeric($key) && $key >= 1) {
        $filteredArray[$key] = $value;
    }
    }

    // Mulai transaksi
    DB::beginTransaction();

    try {
        // Insert ke tabel appraisal_employee
        $appraisalEmployee = AppraisalEmployee::create([
                    'id_appraisal' => $data['id_appraisal'],
                    'pegawai_id' => $pegawai_id,
                    'appraisal_period' => $data['appraisal_period'],
                    'appraisal_status' =>'1'
                ]);

        // Insert ke tabel appraisal_item dengan menggunakan id dari appraisal_employee
        foreach ($filteredArray as $key => $value) {
            AppraisalItem::create([
                'id_appraisals_employee' => $appraisalEmployee->id, // Menggunakan id dari appraisal_employee
                'id_appraisals_kategori' => $key, // Menggunakan key sebagai id kategori
                'pegawai_score' => $value, // Menggunakan value sebagai score
            ]);
        }

        // Commit transaksi
        DB::commit();
        // Redirect dengan pesan sukses
        return redirect()->route('appraisal.index')->with('success', 'Data berhasil ditambahkan!');

    } catch (\Exception $e) {
        // Rollback jika terjadi error
        DB::rollBack();
    }
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

    public function updateappraisalitem(Request $request,AppraisalEmployee $appraisalemployee, AppraisalItem $appraisalitem)
    {
        
        $input=$request->all();
        $data=[];
        foreach ($input as $key => $value) {
            $data[$key] = $value; // Menyimpan setiap input dalam array $data
        }

        $filteredArray = [];
        foreach ($input as $key => $value) {
        if (is_numeric($key) && $key >= 1) {
            $filteredArray[$key] = $value;
        }
        }

        if (count($filteredArray) > 0) {
            $average = array_sum($filteredArray) / count($filteredArray);
        } else {
            $average = 0; // Jika tidak ada elemen, rata-rata diset ke 0
        }
        
        $superior_approved_at = Carbon::now()->toDateString();
        $rata_rata = $average;

        $score_value = DB::table('appraisals_score')
        ->where('min', '<=', $rata_rata) // Cek apakah rata_rata lebih besar atau sama dengan min
        ->where('max', '>=', $rata_rata) // Cek apakah rata_rata lebih kecil atau sama dengan max
        ->pluck('score_value');
             
        //Mulai transaksi
        DB::beginTransaction();
        

        try {
        // Update ke tabel appraisal_employee
        $appraisalemployee = AppraisalEmployee::where('id', $input['id_appraisal']) // Menemukan appraisal_employee berdasarkan ID
        ->update([
            'superior_approved_at' => $superior_approved_at,
            'rata_rata' => $rata_rata,
            'nilai_final' => $score_value,
            'appraisal_status' =>'2'
        ]);

          foreach ($filteredArray as $key => $value) {
            $appraisalitem = AppraisalItem::where('id_appraisals_employee', $input['id_appraisal'])
                                          ->where('id_appraisals_kategori', $key)
                                          ->first();  // Ambil record pertama yang ditemukan
                            
            $appraisalitem->update([
                    'final_score_bysuperior' => $value // Update nilai score
                ]);

        }

        // Commit transaksi
        DB::commit();
        // Redirect dengan pesan sukses
        return redirect()->route('appraisal.index')->with('success', 'Data berhasil ditambahkan!');

    } catch (\Exception $e) {
        // Rollback jika terjadi error
        DB::rollBack();
    }
    }
}



// $appraisal_status='1';
//     $pegawai_id = auth()->user()->id;
//     $input=$request->all();
//     $data=[];
//     foreach ($input as $key => $value) {
//         $data[$key] = $value; // Menyimpan setiap input dalam array $data
//     }

//     $filteredArray = [];
//     foreach ($input as $key => $value) {
//     if (is_numeric($key) && $key >= 1) {
//         $filteredArray[$key] = $value;
//     }
//     }

//     // Mulai transaksi
//     DB::beginTransaction();

//     try {
//         // Insert ke tabel appraisal_employee
//         $appraisalEmployee = AppraisalEmployee::create([
//                     'id_appraisal' => $data['id_appraisal'],
//                     'pegawai_id' => $pegawai_id,
//                     'appraisal_period' => $data['appraisal_period'],
//                     'appraisal_status' =>'1'
//                 ]);

//         // Insert ke tabel appraisal_item dengan menggunakan id dari appraisal_employee
//         foreach ($filteredArray as $key => $value) {
//             AppraisalItem::create([
//                 'id_appraisals_employee' => $appraisalEmployee->id, // Menggunakan id dari appraisal_employee
//                 'id_appraisals_kategori' => $key, // Menggunakan key sebagai id kategori
//                 'pegawai_score' => $value, // Menggunakan value sebagai score
//             ]);
//         }

//         // Commit transaksi
//         DB::commit();
//         // Redirect dengan pesan sukses
//         return redirect()->route('appraisal.index')->with('success', 'Data berhasil ditambahkan!');

//     } catch (\Exception $e) {
//         // Rollback jika terjadi error
//         DB::rollBack();
//     }
//     }