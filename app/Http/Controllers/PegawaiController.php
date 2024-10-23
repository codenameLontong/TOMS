<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use App\Models\PegawaiHistory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Excel;
use App\Imports\PegawaiImport;
use Illuminate\Support\Facades\Hash; // Use for password hashing
use Spatie\Permission\Models\Role;
use App\Models\Cabang;
use App\Models\Vendor;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\VendorController;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        // Get the filter option from request, default to 'active'
        $status = $request->get('status', 'active');

        // Remove the global scope here (if needed)
        Pegawai::withoutGlobalScope('active')->get();

        // Fetch pegawai based on the employment status (active/terminated)
        if ($status === 'terminated') {
            $pegawais = Pegawai::where('employment_status', 'terminated')->get();
        } else {
            $pegawais = Pegawai::where('employment_status', 'active')->get();
        }

        return view('dashboard.pegawai', compact('pegawais', 'status'));
    }

    public function create()
    {
        $cabangs = Cabang::all();
        $vendors = Vendor::all();

        return view('dashboard.tambah-pegawai', compact('cabangs', 'vendors'));
    }

    public function store(Request $request)
    {
        // Validate the request (excluding 'nrp' since it will be generated)
        $request->validate([
            'nama' => 'required|string',
            'coy' => 'required|string',
            'cabang' => 'required|string', // This is the lokasi_cabang from the form
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
            'vendor' => 'required|string',
            'lokasi_kerja' => 'required|string',
            'project_site' => 'nullable|string',
            'alamat_email' => 'required|email|unique:pegawais',
            'no_hp' => 'required|string',
        ]);

        // Fetch the kode_cabang from the cabangs table based on the selected lokasi_cabang
        $cabang = Cabang::where('lokasi_cabang', $request->input('cabang'))->first();

        if (!$cabang) {
            return redirect()->back()->withErrors('Cabang not found.');
        }

        $kodeCabang = $cabang->kode_cabang; // Retrieve kode_cabang from the cabangs table
        $tahunMasuk = Carbon::parse($request->input('tanggal_masuk_tn_shn'))->format('y'); // Last 2 digits of the year

        // Find the latest pegawai in this cabang and year (considering both kode_cabang and year in NRP)
        $latestPegawai = Pegawai::where('nrp', 'like', $kodeCabang . $tahunMasuk . '%')  // Ensure it matches both kode_cabang and tahun
                        ->orderBy('nrp', 'desc')
                        ->first();

        // Determine the order number for the new NRP
        if ($latestPegawai) {
            $latestOrder = (int)substr($latestPegawai->nrp, -2); // Get the last 2 digits of the NRP (the order part)
            $newOrder = str_pad($latestOrder + 1, 2, '0', STR_PAD_LEFT); // Increment by 1 and pad with 0s if necessary
        } else {
            $newOrder = '01'; // If no pegawai in this year and cabang, start with '01'
        }

        // Generate the new NRP (S = prefix, kodeCabang, tahunMasuk, newOrder)
        $newNRP = 'S' . $kodeCabang . $tahunMasuk . $newOrder;

        // Now you can use the $newNRP for the new pegawai


        // Generate the NRP
        $nrp = $kodeCabang . $tahunMasuk . $newOrder;

        // Calculate umur, masa kerja TN/SHN, and masa kerja vendor
        $umur = Carbon::parse($request->tanggal_lahir)->diff(Carbon::now())->format('%y years %m months %d days');
        $masa_kerja_tn_shn = Carbon::parse($request->tanggal_masuk_tn_shn)->diff(Carbon::now())->format('%y years %m months %d days');

        $masa_kerja_vendor = null;
        if ($request->tanggal_masuk_vendor) {
            $masa_kerja_vendor = Carbon::parse($request->tanggal_masuk_vendor)->diff(Carbon::now())->format('%y years %m months %d days');
        }

        // Try to create a new Pegawai record
        try {
            // Create a new Pegawai with calculated fields and default password
            $pegawai = Pegawai::create(array_merge($request->all(), [
                'nrp' => $nrp,  // Generated NRP
                'umur' => $umur,
                'masa_kerja_tn_shn' => $masa_kerja_tn_shn,
                'masa_kerja_vendor' => $masa_kerja_vendor,
            ]));

            // Create a corresponding user with default password 'password'
            $user = \App\Models\User::create([
                'name' => $pegawai->nama,
                'email' => $pegawai->alamat_email,
                'password' => bcrypt('password'),  // Default password, hashed
            ]);

            // Assign the 'pegawai' role to the user
            $pegawaiRole = Role::where('name', 'pegawai')->first();
            $user->assignRole($pegawaiRole);

            // Record the creation in PegawaiHistory
            PegawaiHistory::create([
                'pegawai_nrp' => $pegawai->nrp, // Use nrp to connect with pegawai
                'action_type' => 'manual',
                'description' => "Pegawai created with NRP: {$pegawai->nrp}, Name: {$pegawai->nama}",
                'user_id' => auth()->id(), // Record the user who created the pegawai
                'action_date' => now(),    // Record the current date/time of creation
            ]);

            return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil ditambahkan dengan NRP: ' . $nrp);
        } catch (\Exception $e) {
            // Output any errors encountered
            dd($e->getMessage());
        }
    }


    public function view(Pegawai $pegawai)
    {
        return view('dashboard.view-pegawai', compact('pegawai'));
    }

    public function showupdate(Pegawai $pegawai)
    {
        return view('dashboard.edit-pegawai', compact('pegawai'));
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'nama' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'agama' => 'required|string',
            'pendidikan' => 'required|string',
            'status' => 'required|string',
            'tanggal_lahir' => 'required|string',
            'no_hp' => 'required|string',
        ]);

        // Recalculate umur, masa kerja TN/SHN, and masa kerja vendor
        $umur = Carbon::parse($pegawai->tanggal_lahir)->diff(Carbon::now())->format('%y years %m months %d days');
        $masa_kerja_tn_shn = Carbon::parse($pegawai->tanggal_masuk_tn_shn)->diff(Carbon::now())->format('%y years %m months %d days');

        $masa_kerja_vendor = null;
        if ($pegawai->tanggal_masuk_vendor) {
            $masa_kerja_vendor = Carbon::parse($pegawai->tanggal_masuk_vendor)->diff(Carbon::now())->format('%y years %m months %d days');
        }

        // Update Pegawai record
        $pegawai->update(array_merge($request->only('nama', 'jenis_kelamin', 'agama', 'pendidikan', 'status', 'tanggal_lahir', 'no_hp'), [
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
        // Validate the request
        $request->validate([
            'coy' => 'required|string',
            'cabang' => 'required|string',
            'department' => 'required|string',
            'jabatan' => 'required|string',
            'directorate' => 'required|string',
            'division' => 'required|string',
            'project_site' => 'nullable|string',
            'lokasi_kerja' => 'required|string',
        ]);

        // Recalculate umur, masa kerja TN/SHN, and masa kerja vendor during mutasi
        $umur = Carbon::parse($pegawai->tanggal_lahir)->diff(Carbon::now())->format('%y years %m months %d days');
        $masa_kerja_tn_shn = Carbon::parse($pegawai->tanggal_masuk_tn_shn)->diff(Carbon::now())->format('%y years %m months %d days');

        $masa_kerja_vendor = null;
        if ($pegawai->tanggal_masuk_vendor) {
            $masa_kerja_vendor = Carbon::parse($pegawai->tanggal_masuk_vendor)->diff(Carbon::now())->format('%y years %m months %d days');
        }

        // Store the original state before update
        $originalData = $pegawai->getOriginal();

        // Update Pegawai's fields during mutasi
        $pegawai->update([
            'coy' => $request->coy,
            'cabang' => $request->cabang,
            'department' => $request->department,
            'jabatan' => $request->jabatan,
            'directorate' => $request->directorate,
            'division' => $request->division,
            'project_site' => $request->project_site,
            'lokasi_kerja' => $request->lokasi_kerja,
            'umur' => $umur,
            'masa_kerja_tn_shn' => $masa_kerja_tn_shn,
            'masa_kerja_vendor' => $masa_kerja_vendor,
        ]);

        // Detect the changes for logging in the history
        $changedAttributes = [];
        foreach ($pegawai->getChanges() as $key => $newValue) {
            if (isset($originalData[$key]) && $originalData[$key] != $newValue) {
                $changedAttributes[] = ucfirst(str_replace('_', ' ', $key)) . " changed from {$originalData[$key]} to {$newValue}";
            }
        }

        // Build the description based on changed fields
        $description = implode(', ', $changedAttributes);

        if (!empty($description)) {
            // Record the mutation in history
            PegawaiHistory::create([
                'pegawai_nrp' => $pegawai->nrp,  // Use nrp to connect
                'action_type' => 'mutasi',
                'description' => $description,
                'user_id' => auth()->id(),  // Record the user who performed the action
                'action_date' => now(),     // Record the current date/time of action
            ]);
        }

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil dimutasi!');
    }

    public function showimport()
    {
        return view('dashboard.import-pegawai');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        try {
            // Perform the import using PegawaiImport class
            Excel::import(new PegawaiImport, $request->file('file'));

            // Retrieve the recently imported Pegawai records (assumes they are all new)
            $importedPegawai = Pegawai::where('created_at', '>=', Carbon::now()->subMinutes(5))->get();  // Adjust time as needed

            foreach ($importedPegawai as $pegawai) {
                // Log the creation of each Pegawai to PegawaiHistory
                PegawaiHistory::create([
                    'pegawai_nrp' => $pegawai->nrp,  // Use nrp to connect
                    'action_type' => 'import',
                    'description' => "Pegawai berhasil di-import dengan NRP: {$pegawai->nrp}, Nama: {$pegawai->nama}",
                    'user_id' => auth()->id(), // Record the user who performed the import
                    'action_date' => now(),    // Record the current date/time of creation
                ]);

                // Check if a corresponding User already exists for this Pegawai
                $user = User::where('email', $pegawai->alamat_email)->first();

                if (!$user) {
                    // Create a new User for the Pegawai with default password "password"
                    $user = User::create([
                        'name' => $pegawai->nama,
                        'email' => $pegawai->alamat_email,
                        'password' => bcrypt('password'), // Default password
                    ]);

                    // Assign the "pegawai" role to the new User
                    $pegawaiRole = Role::where('name', 'pegawai')->first();
                    if ($pegawaiRole) {
                        $user->assignRole($pegawaiRole);
                    }
                }
            }

            return redirect()->route('pegawai.index')->with('success', 'File berhasil di-import dan pegawai berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Handle import failure
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengimpor file. Silakan coba lagi.');
        }
    }

    public function terminate(Request $request, Pegawai $pegawai)
    {
        try {
            // Store the original state before updating the pegawai
            $originalData = $pegawai->getOriginal();

            // Update the employment status to 'terminated'
            $pegawai->employment_status = 'terminated';
            $pegawai->save();

            // Find the related user by the email of the pegawai, if it exists
            $user = \App\Models\User::where('email', $pegawai->alamat_email)->first();

            // If a user exists in the 'users' table, set 'active' to false
            if ($user) {
                $user->active = false;
                $user->remember_token = null; // Clear remember token
                $user->save();
            }

            // Detect the changes for logging in the history
            $changedAttributes = [];
            foreach ($pegawai->getChanges() as $key => $newValue) {
                if (isset($originalData[$key]) && $originalData[$key] != $newValue) {
                    $changedAttributes[] = ucfirst(str_replace('_', ' ', $key)) . " changed from {$originalData[$key]} to {$newValue}";
                }
            }

            // Build the description based on changed fields
            $description = implode(', ', $changedAttributes);

            if (!empty($description)) {
                // Log the termination action in PegawaiHistory
                PegawaiHistory::create([
                    'pegawai_nrp' => $pegawai->nrp,  // Connect with pegawai using NRP
                    'action_type' => 'termination',
                    'description' => $description,
                    'user_id' => auth()->id(), // Record the user who performed the action
                    'action_date' => now(),    // Record the current date/time of the action
                ]);
            }

            // Redirect back with success message
            return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil dinonaktifkan.');

        } catch (\Exception $e) {
            // Catch any errors and dump the error message for debugging
            dd($e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->with('error', 'Failed to terminate the Pegawai. Please try again.');
        }
    }

    public function checkEmail(Request $request)
    {
        $exists = Pegawai::where('alamat_email', $request->input('alamat_email'))->exists();
        return response()->json(['exists' => $exists]);
    }

    public function showUpdatePassword() {
        return view('dashboard.settings'); // Assuming you have a Blade view named 'settings.password'
    }

    public function updatePassword(Request $request) {
        // Validation of inputs
        $request->validate([
            'old-password' => 'required',
            'new-password' => 'required|confirmed|min:8',
        ]);

        try {
            // Ensure the old password is correct
            if (!Hash::check($request->input('old-password'), auth()->user()->password)) {
                return back()->withErrors(['old-password' => 'Password lama tidak sesuai.']);
            }

            // Update the password
            auth()->user()->update([
                'password' => Hash::make($request->input('new-password')),
            ]);

            return redirect()->back()->with('success', 'Password berhasil diubah.');

        } catch (\Exception $e) {
            // If an exception occurs, we dump the exception details for debugging
            dd($e->getMessage(), $e->getFile(), $e->getLine());
        }
    }



}
