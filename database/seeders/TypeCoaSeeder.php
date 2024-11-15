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
            ['type_coa' => 'Cost'],
            ['type_coa' => 'Selling Expense'],
            ['type_coa' => 'General Expense'],
        ];

        // Insert the types into the COA table
        DB::table('coas')->insert($types);
    }
}
