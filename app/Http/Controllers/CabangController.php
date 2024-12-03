<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use Illuminate\Http\Request;
use App\Imports\CabangImport;
use Excel;
use App\Models\Pegawai;


class CabangController extends Controller
{
    public function index()
    {
        $cabangs = Cabang::active()->get(); // Fetch only active records
        return view('dashboard.cabang', compact('cabangs'));
    }

    public function create()
    {
        return view('dashboard.tambah-cabang');
    }

    public function store(Request $request)
    {
        $request->validate([
            'lokasi_cabang' => 'required',
            'kode_cabang' => 'required|unique:cabangs',
            'alamat_cabang' => 'required',
        ]);

        Cabang::create($request->all());

        return redirect()->route('cabang.index')->with('success', 'Cabang berhasil dibuat!.');
    }

    public function view(Cabang $cabang)
    {
        // Example: Replace these calculations with your actual logic
        $jumlahPegawai = $cabang->pegawai()->count(); // Assuming `pegawai` is a relationship
        $jumlahLakiLaki = $cabang->pegawai()->where('jenis_kelamin', 'MALE')->count();
        $jumlahPerempuan = $cabang->pegawai()->where('jenis_kelamin', 'FEMALE')->count();

        return view('dashboard.view-cabang', compact('cabang', 'jumlahPegawai', 'jumlahLakiLaki', 'jumlahPerempuan'));
    }

    public function edit(Cabang $cabang)
    {
        return view('dashboard.edit-cabang', compact('cabang'));
    }

    public function update(Request $request, Cabang $cabang)
    {
        try {
            $request->validate([
                'lokasi_cabang' => 'required',
                'kode_cabang' => 'required|unique:cabangs,kode_cabang,' . $cabang->id,
                'alamat_cabang' => 'required',
            ]);

            $cabang->update($request->all());

            return redirect()->route('cabang.index')->with('success', 'Cabang berhasil di-update.');
        } catch (\Exception $e) {
            // Debugging: Dump the exception message and stop execution
            dd($e->getMessage());
        }
    }


    public function delete(Cabang $cabang)
    {
        $cabang->delete();

        return redirect()->route('cabang.index')->with('success', 'Cabang berhasil dihapus.');
    }

    public function terminate(Cabang $cabang)
    {
        try {
            // Set is_active to 0 (soft delete)
            $cabang->update(['is_active' => false]);

            return redirect()->route('cabang.index')->with('success', 'Cabang berhasil dinonaktifkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menonaktifkan cabang: ' . $e->getMessage());
        }
    }

    public function showimport()
    {
        return view('dashboard.import-cabang');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new CabangImport, $request->file('file'));

        return redirect()->route('cabang.index')->with('success', 'Cabang berhasil di-import!');
    }

    public function checkKodeCabang(Request $request)
    {
        $exists = Cabang::where('kode_cabang', $request->input('kode_cabang'))->exists();
        return response()->json(['exists' => $exists]);
    }

    public function downloadTemplate()
    {
        $filePath = public_path('Template Cabang Import.xlsx'); // Ensure the file is placed in the public folder
        if (!file_exists($filePath)) {
            abort(404, 'Template file not found.');
        }

        return response()->download($filePath, 'Template Cabang Import.xlsx');
    }
}
