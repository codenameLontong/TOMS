<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeCoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['type_name' => 'Cost'],
            ['type_name' => 'Selling'],
            ['type_name' => 'General'],
        ];

        DB::table('type_coa')->insert($types);
    }
}
