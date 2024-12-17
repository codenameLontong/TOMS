<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppraisalsScoreSeeder extends Seeder
{
    public function run()
    {
        // Insert predefined values into appraisals_score table
        DB::table('appraisals_score')->insert([
            ['min' => 0, 'max' => 2, 'score_value' => '-'],      // 2. score_value : null
            ['min' => 2, 'max' => 2.4, 'score_value' => 'C'],      // 2.0 - 2.4 score_value : C
            ['min' => 2.5, 'max' => 2.9, 'score_value' => 'C+'],   // 2.5 - 2.9 score_value : C+
            ['min' => 3, 'max' => 3.5, 'score_value' => 'B'],      // 3.0 - 3.5 score_value : B
            ['min' => 3.6, 'max' => 4, 'score_value' => 'B+'],     // 3.6 - 4.0 score_value : B+
            ['min' => 4.1, 'max' => 4.5, 'score_value' => 'BS'],   // 4.1 - 4.5 score_value : BS
            ['min' => 4.6, 'max' => 5.0, 'score_value' => 'BS+'],  // 4.6 - 4.9 score_value : BS+
        ]);
    }
}
