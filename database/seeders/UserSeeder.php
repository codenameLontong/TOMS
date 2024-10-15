<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create Super Admin User
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => bcrypt('password'),
        ]);
        // Assign the superadmin role to this user
        $superAdmin->assignRole('superadmin');

        // Create Admin User
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        // Assign the admin role to this user
        $admin->assignRole('admin');

        // Create Direct Superior User
        $directSuperior = User::create([
            'name' => 'Direct Superior',
            'email' => 'directsuperior@example.com',
            'password' => bcrypt('password'),
        ]);
        // Assign the direct_superior role to this user
        $directSuperior->assignRole('direct_superior');

        // Create Superior User
        $superior = User::create([
            'name' => 'Superior',
            'email' => 'superior@example.com',
            'password' => bcrypt('password'),
        ]);
        // Assign the superior role to this user
        $superior->assignRole('superior');

        // Create HCS Dept Head User
        $hcsDeptHead = User::create([
            'name' => 'HCS Dept Head',
            'email' => 'hcsdepthead@example.com',
            'password' => bcrypt('password'),
        ]);
        // Assign the hcs_dept_head role to this user
        $hcsDeptHead->assignRole('hcs_dept_head');

        // Create HC Div Head User
        $hcDivHead = User::create([
            'name' => 'HC Div Head',
            'email' => 'hcdivhead@example.com',
            'password' => bcrypt('password'),
        ]);
        // Assign the hc_div_head role to this user
        $hcDivHead->assignRole('hc_div_head');

        // Create Pegawai User
        $pegawai = User::create([
            'name' => 'Pegawai',
            'email' => 'pegawai@example.com',
            'password' => bcrypt('password'),
        ]);
        // Assign the pegawai role to this user
        $pegawai->assignRole('pegawai');
    }
}
