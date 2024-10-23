<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use Illuminate\Http\Request;
use App\Imports\CabangImport;
use Excel;

class CabangController extends Controller
{
    public function index()
    {
        $cabangs = Cabang::all();
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
        ]);

        Cabang::create($request->all());

        return redirect()->route('cabang.index')->with('success', 'Cabang berhasil dibuat!.');
    }

    public function view(Cabang $cabang)
    {
        return view('dashboard.view-cabang', compact('cabang'));
    }

    public function edit(Cabang $cabang)
    {
        return view('dashboard.edit-cabang', compact('cabang'));
    }

    public function update(Request $request, Cabang $cabang)
    {
        $request->validate([
            'lokasi_cabang' => 'required',
            'kode_cabang' => 'required|unique:cabangs,kode_cabang,'.$cabang->id,
        ]);

        $cabang->update($request->all());

        return redirect()->route('cabang.index')->with('success', 'Cabang berhasil di-update.');
    }

    public function showdelete(Cabang $cabang)
    {
        return view('dashboard.delete-cabang', compact('cabang'));
    }

    public function delete(Cabang $cabang)
    {
        $cabang->delete();

        return redirect()->route('cabang.index')->with('success', 'Cabang berhasil dihapus.');
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
}
