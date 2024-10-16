<?php

namespace App\Imports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class PegawaiImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $isFirstRow = true; // To identify the first row

        foreach ($rows as $row) {
            // Skip the first row (headers)
            if ($isFirstRow) {
                $isFirstRow = false;
                continue;
            }

            // Convert Excel serial dates to proper Carbon dates
            $tanggal_lahir = $this->convertExcelDate($row[13] ?? null);
            $tanggal_masuk_tn_shn = $this->convertExcelDate($row[14] ?? null);
            $tanggal_masuk_vendor = $this->convertExcelDate($row[15] ?? null);

            // Calculate umur (age) and work durations (masa kerja) using the converted dates
            $umur = $tanggal_lahir ? $tanggal_lahir->diff(Carbon::now())->format('%y years %m months %d days') : null;
            $masa_kerja_tn_shn = $tanggal_masuk_tn_shn ? $tanggal_masuk_tn_shn->diff(Carbon::now())->format('%y years %m months %d days') : null;

            $masa_kerja_vendor = null;
            if (!empty($tanggal_masuk_vendor)) {
                $masa_kerja_vendor = $tanggal_masuk_vendor->diff(Carbon::now())->format('%y years %m months %d days');
            }

            // Create a Pegawai record
            $pegawai = Pegawai::create([
                'nrp' => $row[0],
                'nrp_vendor' => $row[1],
                'nama' => $row[2],
                'coy' => $row[3],
                'cabang' => $row[4],
                'jabatan' => $row[5],
                'directorate' => $row[6],
                'division' => $row[7],
                'department' => $row[8],
                'jenis_kelamin' => $row[9],
                'agama' => $row[10],
                'pendidikan' => $row[11],
                'status' => $row[12],
                'tanggal_lahir' => $tanggal_lahir,
                'tanggal_masuk_tn_shn' => $tanggal_masuk_tn_shn,
                'tanggal_masuk_vendor' => $tanggal_masuk_vendor,
                'jenis_kontrak_kerjasama' => $row[16],
                'implementasi_kontrak_kerjasama' => $row[17],
                'lokasi_kerja' => $row[18],
                'project_site' => $row[19],
                'alamat_email' => $row[20],
                'no_hp' => $row[21],
                'astra_non_astra' => $row[22],
                'umur' => $umur,
                'masa_kerja_tn_shn' => $masa_kerja_tn_shn,
                'masa_kerja_vendor' => $masa_kerja_vendor,
            ]);

            // Create a corresponding User with default password
            $user = User::create([
                'name' => $pegawai->nama,
                'email' => $pegawai->alamat_email,
                'password' => bcrypt('password'),  // Default password
            ]);

            // Assign the "pegawai" role to the user
            $pegawaiRole = Role::where('name', 'pegawai')->first();
            $user->assignRole($pegawaiRole);
        }
    }

    // Helper function to convert Excel serial date to Carbon date
    private function convertExcelDate($date)
    {
        // Excel dates are numeric, we assume they are serial numbers
        if (is_numeric($date)) {
            return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date));
        }

        // If it's already in a valid date format, return it as is
        if (strtotime($date)) {
            return Carbon::parse($date);
        }

        return null; // return null if it's not a valid date
    }
}
