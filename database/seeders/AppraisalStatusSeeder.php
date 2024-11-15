<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AppraisalStatus;

class AppraisalStatusSeeder extends Seeder
{
    public function run()
    {
        AppraisalStatus::insert([
            [
                'id' => 1,
                'status' => 'Need Approval Superior',
            ],
            [
                'id' => 2,
                'status' => 'Approved'
            ],
        ]);
    }
}
