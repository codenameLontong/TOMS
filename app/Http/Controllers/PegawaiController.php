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
            // Create a new Pegawai with calculated fields and default password
            $pegawai = Pegawai::create(array_merge($request->all(), [
                'umur' => $umur,
                'masa_kerja_tn_shn' => $masa_kerja_tn_shn,
                'masa_kerja_vendor' => $masa_kerja_vendor,
                // 'password' => 'password',  // Assign default password as "password", bcrypt will hash automatically
            ]));

            $user = \App\Models\User::create([
                'name' => $pegawai->nama,
                'email' => $pegawai->alamat_email,
                'password' => 'password',  // Default password
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
        return view('dashboard.import');
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
                    'description' => "Pegawai imported with NRP: {$pegawai->nrp}, Name: {$pegawai->nama}",
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
