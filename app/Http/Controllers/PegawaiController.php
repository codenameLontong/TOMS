<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\PegawaiHistory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Excel;
use App\Imports\PegawaiImport;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawais = Pegawai::all();
        return view('dashboard.pegawai', compact('pegawais'));
    }

    public function create()
    {
        return view('dashboard.tambah-pegawai');
    }

    // public function store(Request $request)
    // {
    //     // Validate the request
    //     $request->validate([
    //         'nrp' => 'required|unique:pegawais',
    //         'nama' => 'required|string',
    //         'coy' => 'required|string',
    //         'cabang' => 'required|string',
    //         'jabatan' => 'required|string',
    //         'directorate' => 'required|string',
    //         'division' => 'required|string',
    //         'department' => 'required|string',
    //         'jenis_kelamin' => 'required|string',
    //         'agama' => 'required|string',
    //         'pendidikan' => 'required|string',
    //         'status' => 'required|string',
    //         'tanggal_lahir' => 'required|date',
    //         'tanggal_masuk_tn_shn' => 'required|date',
    //         'tanggal_masuk_vendor' => 'nullable|date',
    //         'jenis_kontrak_kerjasama' => 'required|string',
    //         'implementasi_kontrak_kerjasama' => 'required|string',
    //         'lokasi_kerja' => 'required|string',
    //         'alamat_email' => 'required|email|unique:pegawais',
    //         'no_hp' => 'required|string',
    //         'astra_non_astra' => 'required|string',
    //     ]);

    //     // Format umur, masa kerja TN/SHN, and masa kerja vendor as "X years Y months Z days"
    //     $pegawai = new Pegawai();

    //     $umur = $pegawai->formatDateDifference($request->tanggal_lahir);
    //     $masaKerjaTnShn = $pegawai->formatDateDifference($request->tanggal_masuk_tn_shn);
    //     $masaKerjaVendor = $request->tanggal_masuk_vendor ? $pegawai->formatDateDifference($request->tanggal_masuk_vendor) : null;

    //     // Create the Pegawai record with formatted strings
    //     try {
    //         Pegawai::create([
    //             'nrp' => $request->nrp,
    //             'nrp_vendor' => $request->nrp_vendor,
    //             'nama' => $request->nama,
    //             'coy' => $request->coy,
    //             'cabang' => $request->cabang,
    //             'jabatan' => $request->jabatan,
    //             'directorate' => $request->directorate,
    //             'division' => $request->division,
    //             'department' => $request->department,
    //             'jenis_kelamin' => $request->jenis_kelamin,
    //             'agama' => $request->agama,
    //             'pendidikan' => $request->pendidikan,
    //             'status' => $request->status,
    //             'tanggal_lahir' => $request->tanggal_lahir,
    //             'tanggal_masuk_tn_shn' => $request->tanggal_masuk_tn_shn,
    //             'tanggal_masuk_vendor' => $request->tanggal_masuk_vendor,
    //             'jenis_kontrak_kerjasama' => $request->jenis_kontrak_kerjasama,
    //             'implementasi_kontrak_kerjasama' => $request->implementasi_kontrak_kerjasama,
    //             'lokasi_kerja' => $request->lokasi_kerja,
    //             'project_site' => $request->project_site,
    //             'alamat_email' => $request->alamat_email,
    //             'no_hp' => $request->no_hp,
    //             'astra_non_astra' => $request->astra_non_astra,
    //             'umur' => $umur, // Store as string
    //             'masa_kerja_tn_shn' => $masaKerjaTnShn, // Store as string
    //             'masa_kerja_vendor' => $masaKerjaVendor, // Store as string
    //         ]);

    //         return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil ditambahkan!.');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan pegawai.');
    //     }
    // }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'nrp' => 'required|unique:pegawais',
            'nama' => 'required|string',
            'coy' => 'required|string',
            'cabang' => 'required|string',
            'jabatan' => 'required|string',
            'directorate' => 'required|string',
            'division' => 'required|string',
            'department' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'agama' => 'required|string',
            'pendidikan' => 'required|string',
            'status' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'tanggal_masuk_tn_shn' => 'required|date',
            'tanggal_masuk_vendor' => 'nullable|date',
            'jenis_kontrak_kerjasama' => 'required|string',
            'implementasi_kontrak_kerjasama' => 'required|string',
            'lokasi_kerja' => 'required|string',
            'project_site' => 'nullable|string',
            'alamat_email' => 'required|email|unique:pegawais',
            'no_hp' => 'required|string',
            'astra_non_astra' => 'required|string',
        ]);

        // Calculate umur, masa kerja TN/SHN, and masa kerja vendor
        $umur = Carbon::parse($request->tanggal_lahir)->diff(Carbon::now())->format('%y years %m months %d days');
        $masa_kerja_tn_shn = Carbon::parse($request->tanggal_masuk_tn_shn)->diff(Carbon::now())->format('%y years %m months %d days');

        $masa_kerja_vendor = null;
        if ($request->tanggal_masuk_vendor) {
            $masa_kerja_vendor = Carbon::parse($request->tanggal_masuk_vendor)->diff(Carbon::now())->format('%y years %m months %d days');
        }

        // Try to create a new Pegawai record
        try {
            // Create a new Pegawai with calculated fields
            $pegawai = Pegawai::create(array_merge($request->all(), [
                'umur' => $umur,
                'masa_kerja_tn_shn' => $masa_kerja_tn_shn,
                'masa_kerja_vendor' => $masa_kerja_vendor,
            ]));

            return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Output any errors encountered
            dd($e->getMessage());
        }
    }

    public function view(Pegawai $pegawai)
    {
        return view('dashboard.view-pegawai', compact('pegawai'));
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'division' => 'required|string',
            'cabang' => 'required|string',
        ]);

        // Recalculate umur, masa kerja TN/SHN, and masa kerja vendor
        $umur = Carbon::parse($pegawai->tanggal_lahir)->diff(Carbon::now())->format('%y years %m months %d days');
        $masa_kerja_tn_shn = Carbon::parse($pegawai->tanggal_masuk_tn_shn)->diff(Carbon::now())->format('%y years %m months %d days');

        $masa_kerja_vendor = null;
        if ($pegawai->tanggal_masuk_vendor) {
            $masa_kerja_vendor = Carbon::parse($pegawai->tanggal_masuk_vendor)->diff(Carbon::now())->format('%y years %m months %d days');
        }

        // Update Pegawai record
        $pegawai->update(array_merge($request->only('division', 'cabang'), [
            'umur' => $umur,
            'masa_kerja_tn_shn' => $masa_kerja_tn_shn,
            'masa_kerja_vendor' => $masa_kerja_vendor,
        ]));

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil diupdate!');
    }

    public function mutasi(Pegawai $pegawai)
    {
        return view('dashboard.mutasi-pegawai', compact('pegawai'));
    }

    public function updateMutasi(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'division' => 'required|string',
            'cabang' => 'required|string',
        ]);

        // Recalculate umur, masa kerja TN/SHN, and masa kerja vendor during mutasi
        $umur = Carbon::parse($pegawai->tanggal_lahir)->diff(Carbon::now())->format('%y years %m months %d days');
        $masa_kerja_tn_shn = Carbon::parse($pegawai->tanggal_masuk_tn_shn)->diff(Carbon::now())->format('%y years %m months %d days');

        $masa_kerja_vendor = null;
        if ($pegawai->tanggal_masuk_vendor) {
            $masa_kerja_vendor = Carbon::parse($pegawai->tanggal_masuk_vendor)->diff(Carbon::now())->format('%y years %m months %d days');
        }

        // Update Pegawai during mutasi
        $pegawai->update(array_merge($request->only('division', 'cabang'), [
            'umur' => $umur,
            'masa_kerja_tn_shn' => $masa_kerja_tn_shn,
            'masa_kerja_vendor' => $masa_kerja_vendor,
        ]));

        // Record the mutation in history
        PegawaiHistory::create([
            'pegawai_nrp' => $pegawai->nrp,  // Use nrp to connect
            'action_type' => 'mutasi',
            'description' => "Mutasi to division: {$request->division}, cabang: {$request->cabang}",
            'user_id' => auth()->id(), // Record the user who performed the action
            'action_date' => now(),    // Record the current date/time of action
        ]);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil dimutasi!');
    }


    public function showimport()
    {
        return view('dashboard.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        try {
            Excel::import(new PegawaiImport, $request->file('file'));

            return redirect()->route('pegawai.index')->with('success', 'File berhasil di-import!');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengimpor file. Silakan coba lagi.');
        }
    }

    public function terminate($nrp)
    {
        $pegawai = Pegawai::where('nrp', $nrp)->firstOrFail();

        // Update status to 'terminated'
        $pegawai->status = 'terminated';
        $pegawai->save();

        // Record the termination in history
        PegawaiHistory::create([
            'pegawai_nrp' => $pegawai->nrp,  // Use nrp to connect
            'action_type' => 'termination',
            'description' => 'Pegawai was terminated.',
            'user_id' => auth()->id(), // Record the user who performed the action
            'action_date' => now(),    // Record the current date/time of action
        ]);

        return redirect()->route('pegawai.view', $pegawai->nrp)->with('success', 'Pegawai successfully terminated.');
    }
}
