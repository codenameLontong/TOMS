<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create Super Admin User
        $superAdmin = User::create([
            'role_id' => 1,
            'dept_id' => 1,
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => bcrypt('password'),
        ]);
        // Assign the superadmin role to this user
        $superAdmin->assignRole('superadmin');

        // Create Admin User
        $admin = User::create([
            'role_id' => 2,
            'dept_id' => 1,
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        // Assign the admin role to this user
        $admin->assignRole('admin');

        // Create Direct Superior User
        $directSuperior = User::create([
            'role_id' => 3,
            'dept_id' => 1,
            'name' => 'Direct Superior',
            'email' => 'directsuperior@example.com',
            'password' => bcrypt('password'),
        ]);
        // Assign the direct_superior role to this user
        $directSuperior->assignRole('direct_superior');

        // Create Superior User
        $superior = User::create([
            'role_id' => 4,
            'dept_id' => 2,
            'name' => 'Superior',
            'email' => 'superior@example.com',
            'password' => bcrypt('password'),
        ]);
        // Assign the superior role to this user
        $superior->assignRole('superior');

        // Create HCS Dept Head User
        $hcsDeptHead = User::create([
            'role_id' => 5,
            'dept_id' => 2,
            'name' => 'HCS Dept Head',
            'email' => 'hcsdepthead@example.com',
            'password' => bcrypt('password'),
        ]);
        // Assign the hcs_dept_head role to this user
        $hcsDeptHead->assignRole('hcs_dept_head');

        // Create HC Div Head User
        $hcDivHead = User::create([
            'role_id' => 6,
            'dept_id' => 2,
            'name' => 'HC Div Head',
            'email' => 'hcdivhead@example.com',
            'password' => bcrypt('password'),
        ]);
        // Assign the hc_div_head role to this user
        $hcDivHead->assignRole('hc_div_head');

        // Create Direct Superior User
        $directSuperior = User::create([
            'role_id' => 3,
            'dept_id' => 4,
            'name' => 'Budi',
            'email' => 'budi@example.com',
            'password' => bcrypt('password'),
        ]);
        // Assign the direct_superior role to this user
        $directSuperior->assignRole('direct_superior');

        // Create Pegawai User
        $pegawai = User::create([
            'role_id' => 7,
            'dept_id' => 4,
            'name' => 'Pegawai',
            'email' => 'pegawai@example.com',
            'password' => bcrypt('password'),
        ]);
        // Assign the pegawai role to this user
        $pegawai->assignRole('pegawai');

        // Create Permissions
        $permissions = [
            'view dashboard',
            'view pegawai',
            'view vendor',
            'view cabang',
            'view overtime',
            'view exception',
            'view appraisal',
            'view struktur_organisasi',
            // Add more permissions as needed
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign permissions to roles
        $superAdmin->givePermissionTo(Permission::all());
        $admin->givePermissionTo([
            'view pegawai',
            'view overtime',
            'view exception',
            'view appraisal',
            'view struktur_organisasi'
        ]);
        $directSuperior->givePermissionTo([
            'view pegawai',
            'view overtime',
            'view exception',
            'view appraisal',
            'view struktur_organisasi'
        ]);

    }


}
