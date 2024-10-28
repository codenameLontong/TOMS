<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Imports\VendorImport; // Assuming you have a similar import class for Vendor
use Excel;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = Vendor::all();
        return view('dashboard.vendor', compact('vendors'));
    }

    public function create()
    {
        return view('dashboard.tambah-vendor');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_vendor' => 'required',
                'kode_vendor' => 'required|unique:vendors',
                'astra_non_astra' => 'required|in:Astra,Non Astra',
            ]);

            Vendor::create($request->all());

            return redirect()->route('vendor.index')->with('success', 'Vendor berhasil dibuat.');
        } catch (\Exception $e) {
            // Dump the error message and stop execution
            dd($e->getMessage());
        }
    }


    public function view(Vendor $vendor)
    {
        return view('dashboard.view-vendor', compact('vendor'));
    }

    public function edit(Vendor $vendor)
    {
        return view('dashboard.edit-vendor', compact('vendor'));
    }

    public function update(Request $request, Vendor $vendor)
    {
        $request->validate([
            'nama_vendor' => 'required',
            'kode_vendor' => 'required|unique:vendors,kode_vendor,'.$vendor->id,
            'astra_non_astra' => 'required|in:Astra,Non Astra',
        ]);

        $vendor->update($request->all());

        return redirect()->route('vendor.index')->with('success', 'Vendor berhasil di-update.');
    }

    public function delete(Vendor $vendor)
    {
        $vendor->delete();

        return redirect()->route('vendor.index')->with('success', 'Vendor berhasil dihapus.');
    }

    public function showimport()
    {
        return view('dashboard.import-vendor');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new VendorImport, $request->file('file'));

        return redirect()->route('vendor.index')->with('success', 'Vendor berhasil di-import!');
    }

    public function checkKodeVendor(Request $request)
    {
        $exists = Vendor::where('kode_vendor', $request->input('kode_vendor'))->exists();
        return response()->json(['exists' => $exists]);
    }
}
