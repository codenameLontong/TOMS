<?php

namespace App\Imports;

use App\Models\Vendor;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class VendorImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $isFirstRow = true; // To identify the first row (headers)

        foreach ($rows as $row) {
            // Skip the first row (headers)
            if ($isFirstRow) {
                $isFirstRow = false;
                continue;
            }

            // Create a Vendor record
            Vendor::create([
                'kode_vendor' => $row[0],       // Assuming column 0 is 'kode_vendor'
                'nama_vendor' => $row[1],       // Assuming column 1 is 'nama_vendor'
                'astra_non_astra' => $row[2],   // Assuming column 2 is 'astra_non_astra' (e.g., 'Astra', 'Non Astra')
            ]);
        }
    }
}
