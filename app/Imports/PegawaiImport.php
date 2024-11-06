<?php

namespace App\Imports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\Department;
use App\Models\Division;
use App\Models\Directorate;
use App\Models\Company;
use App\Models\Section;

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

        // Validate the hierarchy
        $company = Company::where('coy', $row[3])->first();
        if (!$company) {
            throw new \Exception("Company '{$row[3]}' tidak ditemukan untuk Pegawai '{$row[2]}'.");
        }

        $directorate = Directorate::where('nama_directorate', $row[6])
            ->where('company_id', $company->id)
            ->first();
        if (!$directorate) {
            throw new \Exception("Directorate '{$row[6]}' tidak ditemukan atau tidak ada di Company '{$row[3]}' untuk Pegawai '{$row[2]}'.");
        }

        $division = Division::where('nama_division', $row[7])
            ->where('directorate_id', $directorate->id)
            ->first();
        if (!$division) {
            throw new \Exception("Division '{$row[7]}' tidak ditemukan atau tidak ada di Directorate '{$row[6]}' untuk Pegawai '{$row[2]}'.");
        }

        $department = Department::where('nama_department', $row[8])
            ->where('division_id', $division->id)
            ->first();
        if (!$department) {
            throw new \Exception("Department '{$row[8]}' tidak ditemukan atau tidak ada di Division '{$row[7]}' untuk Pegawai '{$row[2]}'.");
        }

        if (!empty($row[9])) {
            $section = Section::where('nama_section', $row[9])
                ->where('department_id', $department->id)
                ->first();
            if (!$section) {
                throw new \Exception("Section '{$row[9]}' tidak ditemukan atau tidak ada di Department '{$row[8]}' untuk Pegawai '{$row[2]}'.");
            }
        }

        $department = Department::where('nama_department', $row[8])->first();

        // Convert Excel serial dates to proper Carbon dates
        $tanggal_lahir = $this->convertExcelDate($row[14] ?? null);
        $tanggal_masuk_tn_shn = $this->convertExcelDate($row[15] ?? null);
        $tanggal_masuk_vendor = $this->convertExcelDate($row[16] ?? null);

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
            'section' => $row[9],
            'jenis_kelamin' => $row[10],
            'agama' => $row[11],
            'pendidikan' => $row[12],
            'status' => $row[13],
            'tanggal_lahir' => $tanggal_lahir,
            'tanggal_masuk_tn_shn' => $tanggal_masuk_tn_shn,
            'tanggal_masuk_vendor' => $tanggal_masuk_vendor,
            'jenis_kontrak_kerjasama' => $row[17],
            'implementasi_kontrak_kerjasama' => $row[18],
            'vendor' => $row[19],
            'lokasi_kerja' => $row[20],
            'project_site' => $row[21],
            'alamat_email' => $row[22],
            'no_hp' => $row[23],
            'umur' => $umur,
            'masa_kerja_tn_shn' => $masa_kerja_tn_shn,
            'masa_kerja_vendor' => $masa_kerja_vendor,
        ]);

        // Create a corresponding User with default password and dept_id
        $user = User::create([
            'name' => $pegawai->nama,
            'email' => $pegawai->alamat_email,
            'password' => bcrypt('password'),  // Default password
            'dept_id' => $department->id, // Set dept_id based on the retrieved department ID
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
