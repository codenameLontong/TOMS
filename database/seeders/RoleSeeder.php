<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use App\Models\Role;
use Spatie\Permission\Models\Role;


class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['name' => 'superadmin', 'guard_name' => 'web'],
            ['name' => 'admin', 'guard_name' => 'web'],
            ['name' => 'direct_superior', 'guard_name' => 'web'],
            ['name' => 'superior', 'guard_name' => 'web'],
            ['name' => 'hcs_dept_head', 'guard_name' => 'web'],
            ['name' => 'hc_div_head', 'guard_name' => 'web'],
            ['name' => 'pegawai', 'guard_name' => 'web'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
