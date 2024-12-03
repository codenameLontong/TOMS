<?php

namespace App\Imports;

use App\Models\Cabang;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class CabangImport implements ToCollection
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

            // Create a Cabang record
            Cabang::create([
                'kode_cabang' => $row[0],  // Assuming column 0 is 'kode_cabang'
                'lokasi_cabang' => $row[1],  // Assuming column 1 is 'lokasi_cabang'
                'alamat_cabang' => $row[2],  // Assuming column 2 is 'alamat_cabang'
            ]);
        }
    }
}

