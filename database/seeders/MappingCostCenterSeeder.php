<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MappingCostCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mappings = [
            ['cost_center_id' => 118, 'department_id' => 12, 'section_id' =>18],
            ['cost_center_id' => 58, 'department_id' => 12, 'section_id' =>19],
            ['cost_center_id' => 57, 'department_id' => 12, 'section_id' =>20],
            ['cost_center_id' => 57, 'department_id' => 12, 'section_id' =>null],
            ['cost_center_id' => 5, 'department_id' => 12, 'section_id' =>21],
            ['cost_center_id' => 6, 'department_id' => 12, 'section_id' =>22],
            ['cost_center_id' => 119, 'department_id' => 13, 'section_id' =>23],
            ['cost_center_id' => 61, 'department_id' => 13, 'section_id' =>24],
            ['cost_center_id' => 60, 'department_id' => 13, 'section_id' =>null],
            ['cost_center_id' => 60, 'department_id' => 13, 'section_id' =>25],
            ['cost_center_id' => 8, 'department_id' => 13, 'section_id' =>26],
            ['cost_center_id' => 9, 'department_id' => 13, 'section_id' =>27],
            ['cost_center_id' => 117, 'department_id' => 11, 'section_id' =>13],
            ['cost_center_id' => 55, 'department_id' => 11, 'section_id' =>14],
            ['cost_center_id' => 54, 'department_id' => 11, 'section_id' =>null],
            ['cost_center_id' => 54, 'department_id' => 11, 'section_id' =>15],
            ['cost_center_id' => 2, 'department_id' => 11, 'section_id' =>16],
            ['cost_center_id' => 3, 'department_id' => 11, 'section_id' =>17],
            ['cost_center_id' => 65, 'department_id' => 47, 'section_id' =>113],
            ['cost_center_id' => 65, 'department_id' => 49, 'section_id' =>115],
            ['cost_center_id' => 65, 'department_id' => 48, 'section_id' =>114],
            ['cost_center_id' => 66, 'department_id' => 45, 'section_id' =>111],
            ['cost_center_id' => 67, 'department_id' => 59, 'section_id' =>126],
            ['cost_center_id' => 67, 'department_id' => 60, 'section_id' =>127],
            ['cost_center_id' => 68, 'department_id' => 58, 'section_id' =>125],
            ['cost_center_id' => 69, 'department_id' => 51, 'section_id' =>117],
            ['cost_center_id' => 70, 'department_id' => 52, 'section_id' =>null],
            ['cost_center_id' => 131, 'department_id' => 46, 'section_id' =>112],
            ['cost_center_id' => 132, 'department_id' => 56, 'section_id' =>123],
            ['cost_center_id' => 133, 'department_id' => 57, 'section_id' =>124],
            ['cost_center_id' => 134, 'department_id' => 53, 'section_id' =>120],
            ['cost_center_id' => 135, 'department_id' => 54, 'section_id' =>121],
            ['cost_center_id' => 71, 'department_id' => 41, 'section_id' =>107],
            ['cost_center_id' => 71, 'department_id' => 63, 'section_id' =>130],
            ['cost_center_id' => 72, 'department_id' => 62, 'section_id' =>129],
            ['cost_center_id' => 72, 'department_id' => 41, 'section_id' =>107],
            ['cost_center_id' => 64, 'department_id' => 61, 'section_id' =>128],
            ['cost_center_id' => 73, 'department_id' => 63, 'section_id' =>130],
            ['cost_center_id' => 74, 'department_id' => 42, 'section_id' =>108],
            ['cost_center_id' => 75, 'department_id' => 65, 'section_id' =>132],
            ['cost_center_id' => 77, 'department_id' => 64, 'section_id' =>131],
            ['cost_center_id' => 121, 'department_id' => 32, 'section_id' =>98],
            ['cost_center_id' => 120, 'department_id' => 30, 'section_id' =>96],
            ['cost_center_id' => 136, 'department_id' => 31, 'section_id' =>97],
            ['cost_center_id' => 123, 'department_id' => 33, 'section_id' =>99],
            ['cost_center_id' => 126, 'department_id' => 36, 'section_id' =>102],
            ['cost_center_id' => 124, 'department_id' => 34, 'section_id' =>100],
            ['cost_center_id' => 122, 'department_id' => 38, 'section_id' =>104],
            ['cost_center_id' => 137, 'department_id' => 14, 'section_id' =>28],
            ['cost_center_id' => 129, 'department_id' => 28, 'section_id' =>94],
            ['cost_center_id' => 78, 'department_id' => 15, 'section_id' =>null],
            ['cost_center_id' => 78, 'department_id' => 15, 'section_id' =>null],
            ['cost_center_id' => 79, 'department_id' => 15, 'section_id' =>null],
            ['cost_center_id' => 11, 'department_id' => 15, 'section_id' =>29],
            ['cost_center_id' => 12, 'department_id' => 15, 'section_id' =>31],
            ['cost_center_id' => 13, 'department_id' => 15, 'section_id' =>33],
            ['cost_center_id' => 14, 'department_id' => 15, 'section_id' =>null],
            ['cost_center_id' => 14, 'department_id' => 15, 'section_id' =>29],
            ['cost_center_id' => 14, 'department_id' => 15, 'section_id' =>null],
            ['cost_center_id' => 14, 'department_id' => 15, 'section_id' =>null],
            ['cost_center_id' => 14, 'department_id' => 15, 'section_id' =>null],
            ['cost_center_id' => 14, 'department_id' => 15, 'section_id' =>null],
            ['cost_center_id' => 14, 'department_id' => 15, 'section_id' =>32],
            ['cost_center_id' => 14, 'department_id' => 15, 'section_id' =>null],
            ['cost_center_id' => 14, 'department_id' => 15, 'section_id' =>null],
            ['cost_center_id' => 14, 'department_id' => 15, 'section_id' =>30],
            ['cost_center_id' => 15, 'department_id' => 15, 'section_id' =>32],
            ['cost_center_id' => 139, 'department_id' => 16, 'section_id' =>34],
            ['cost_center_id' => 81, 'department_id' => 16, 'section_id' =>35],
            ['cost_center_id' => 80, 'department_id' => 16, 'section_id' =>36],
            ['cost_center_id' => 80, 'department_id' => 16, 'section_id' =>null],
            ['cost_center_id' => 17, 'department_id' => 16, 'section_id' =>37],
            ['cost_center_id' => 18, 'department_id' => 16, 'section_id' =>38],
            ['cost_center_id' => 140, 'department_id' => 17, 'section_id' =>39],
            ['cost_center_id' => 84, 'department_id' => 17, 'section_id' =>40],
            ['cost_center_id' => 83, 'department_id' => 17, 'section_id' =>41],
            ['cost_center_id' => 83, 'department_id' => 17, 'section_id' =>null],
            ['cost_center_id' => 20, 'department_id' => 17, 'section_id' =>42],
            ['cost_center_id' => 21, 'department_id' => 17, 'section_id' =>43],
            ['cost_center_id' => 142, 'department_id' => 19, 'section_id' =>49],
            ['cost_center_id' => 90, 'department_id' => 19, 'section_id' =>50],
            ['cost_center_id' => 89, 'department_id' => 19, 'section_id' =>51],
            ['cost_center_id' => 89, 'department_id' => 19, 'section_id' =>null],
            ['cost_center_id' => 26, 'department_id' => 19, 'section_id' =>52],
            ['cost_center_id' => 27, 'department_id' => 19, 'section_id' =>53],
            ['cost_center_id' => 141, 'department_id' => 18, 'section_id' =>44],
            ['cost_center_id' => 87, 'department_id' => 18, 'section_id' =>45],
            ['cost_center_id' => 86, 'department_id' => 18, 'section_id' =>46],
            ['cost_center_id' => 86, 'department_id' => 18, 'section_id' =>null],
            ['cost_center_id' => 23, 'department_id' => 18, 'section_id' =>47],
            ['cost_center_id' => 24, 'department_id' => 18, 'section_id' =>48],
            ['cost_center_id' => 143, 'department_id' => 20, 'section_id' =>54],
            ['cost_center_id' => 93, 'department_id' => 20, 'section_id' =>55],
            ['cost_center_id' => 92, 'department_id' => 20, 'section_id' =>56],
            ['cost_center_id' => 92, 'department_id' => 20, 'section_id' =>null],
            ['cost_center_id' => 29, 'department_id' => 20, 'section_id' =>57],
            ['cost_center_id' => 30, 'department_id' => 20, 'section_id' =>58],
            ['cost_center_id' => 145, 'department_id' => 22, 'section_id' =>64],
            ['cost_center_id' => 100, 'department_id' => 22, 'section_id' =>65],
            ['cost_center_id' => 99, 'department_id' => 22, 'section_id' =>null],
            ['cost_center_id' => 99, 'department_id' => 22, 'section_id' =>66],
            ['cost_center_id' => 35, 'department_id' => 22, 'section_id' =>67],
            ['cost_center_id' => 36, 'department_id' => 22, 'section_id' =>68],
            ['cost_center_id' => 144, 'department_id' => 21, 'section_id' =>59],
            ['cost_center_id' => 96, 'department_id' => 21, 'section_id' =>60],
            ['cost_center_id' => 95, 'department_id' => 21, 'section_id' =>null],
            ['cost_center_id' => 95, 'department_id' => 21, 'section_id' =>61],
            ['cost_center_id' => 32, 'department_id' => 21, 'section_id' =>62],
            ['cost_center_id' => 33, 'department_id' => 21, 'section_id' =>63],
            ['cost_center_id' => 146, 'department_id' => 23, 'section_id' =>69],
            ['cost_center_id' => 103, 'department_id' => 23, 'section_id' =>70],
            ['cost_center_id' => 102, 'department_id' => 23, 'section_id' =>71],
            ['cost_center_id' => 102, 'department_id' => 23, 'section_id' =>null],
            ['cost_center_id' => 38, 'department_id' => 23, 'section_id' =>72],
            ['cost_center_id' => 39, 'department_id' => 23, 'section_id' =>73],
            ['cost_center_id' => 150, 'department_id' => 27, 'section_id' =>89],
            ['cost_center_id' => 115, 'department_id' => 27, 'section_id' =>90],
            ['cost_center_id' => 114, 'department_id' => 27, 'section_id' =>null],
            ['cost_center_id' => 114, 'department_id' => 27, 'section_id' =>91],
            ['cost_center_id' => 52, 'department_id' => 27, 'section_id' =>92],
            ['cost_center_id' => 53, 'department_id' => 27, 'section_id' =>93],
            ['cost_center_id' => 147, 'department_id' => 24, 'section_id' =>74],
            ['cost_center_id' => 106, 'department_id' => 24, 'section_id' =>75],
            ['cost_center_id' => 105, 'department_id' => 24, 'section_id' =>null],
            ['cost_center_id' => 105, 'department_id' => 24, 'section_id' =>76],
            ['cost_center_id' => 41, 'department_id' => 24, 'section_id' =>77],
            ['cost_center_id' => 42, 'department_id' => 24, 'section_id' =>77],
            ['cost_center_id' => 43, 'department_id' => 24, 'section_id' =>78],
            ['cost_center_id' => 44, 'department_id' => 24, 'section_id' =>78],
            ['cost_center_id' => 149, 'department_id' => 26, 'section_id' =>84],
            ['cost_center_id' => 112, 'department_id' => 26, 'section_id' =>85],
            ['cost_center_id' => 111, 'department_id' => 26, 'section_id' =>86],
            ['cost_center_id' => 111, 'department_id' => 26, 'section_id' =>null],
            ['cost_center_id' => 49, 'department_id' => 26, 'section_id' =>87],
            ['cost_center_id' => 50, 'department_id' => 26, 'section_id' =>88],
            ['cost_center_id' => 148, 'department_id' => 25, 'section_id' =>79],
            ['cost_center_id' => 109, 'department_id' => 25, 'section_id' =>80],
            ['cost_center_id' => 108, 'department_id' => 25, 'section_id' =>null],
            ['cost_center_id' => 108, 'department_id' => 25, 'section_id' =>81],
            ['cost_center_id' => 46, 'department_id' => 25, 'section_id' =>82],
            ['cost_center_id' => 47, 'department_id' => 25, 'section_id' =>83],
        ];

        DB::table('mapping_cost_centers')->insert($mappings);
    }
}
