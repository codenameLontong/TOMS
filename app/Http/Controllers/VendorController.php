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
        $request->validate([
            'nama_vendor' => 'required',
            'kode_vendor' => 'required|unique:vendors',
            'astra_non_astra' => 'required|in:Astra,Non Astra',
            'pics.*.nama' => 'required|string',
            'pics.*.no_hp' => 'required|string',
            'pics.*.email' => 'required|email|',
            'pics.*.jabatan' => 'required|string',
        ]);

        try {
            // Create the vendor
            $vendor = Vendor::create($request->only('nama_vendor', 'kode_vendor', 'astra_non_astra'));

            // Create the PICs
            foreach ($request->input('pics', []) as $picData) {
                $vendor->pics()->create($picData);
            }

            return redirect()->route('vendor.index')->with('success', 'Vendor berhasil dibuat.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat vendor: ' . $e->getMessage());
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
        try {
            // Validate general vendor data
            $validatedData = $request->validate([
                'nama_vendor' => 'required|string|max:255',
                'kode_vendor' => 'required|string|unique:vendors,kode_vendor,' . $vendor->id,
                'astra_non_astra' => 'required|in:Astra,Non Astra',
                'pics.*.id' => 'nullable|exists:pics,id', // Ensure existing PICs have valid IDs
                'pics.*.nama' => 'required|string|max:255',
                'pics.*.no_hp' => 'required|string|max:20',
                'pics.*.email' => 'required|email',
                'pics.*.jabatan' => 'required|string|max:255',
            ]);

            // Update the vendor
            $vendor->update([
                'nama_vendor' => $validatedData['nama_vendor'],
                'kode_vendor' => $validatedData['kode_vendor'],
                'astra_non_astra' => $validatedData['astra_non_astra'],
            ]);

            $existingPicIds = $vendor->pics()->pluck('id')->toArray(); // Get all existing PIC IDs for the vendor
            $incomingPicIds = array_column($validatedData['pics'], 'id'); // Get all incoming PIC IDs from the request

            // Loop through all incoming PICs
            foreach ($validatedData['pics'] as $picData) {
                if (isset($picData['id'])) {
                    // Update existing PICs
                    $pic = $vendor->pics()->find($picData['id']);

                    if ($pic) {
                        // Only validate email uniqueness if it's being changed
                        if ($pic->email !== $picData['email']) {
                            $request->validate([
                                "pics.*.email" => "unique:pics,email," . $picData['id'],
                            ]);
                        }

                        // Update PIC
                        $pic->update([
                            'nama' => $picData['nama'],
                            'no_hp' => $picData['no_hp'],
                            'email' => $picData['email'],
                            'jabatan' => $picData['jabatan'],
                        ]);
                    }
                } else {
                    // Create new PIC if no ID is provided
                    $vendor->pics()->create([
                        'nama' => $picData['nama'],
                        'no_hp' => $picData['no_hp'],
                        'email' => $picData['email'],
                        'jabatan' => $picData['jabatan'],
                    ]);
                }
            }

            // Delete removed PICs
            $deletedPicIds = array_diff($existingPicIds, $incomingPicIds);
            if (!empty($deletedPicIds)) {
                $vendor->pics()->whereIn('id', $deletedPicIds)->delete();
            }

            return redirect()->route('vendor.index')->with('success', 'Vendor successfully updated!');
        } catch (\Exception $e) {
            // Log the error for debugging
            dd($e->getMessage());

            // Return to the previous page with an error message
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
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

    public function downloadTemplate()
    {
        $filePath = public_path('Template Vendor Import.xlsx'); // Ensure the file is placed in the public folder
        if (!file_exists($filePath)) {
            abort(404, 'Template file not found.');
        }

        return response()->download($filePath, 'Template Vendor Import.xlsx');
    }
}
