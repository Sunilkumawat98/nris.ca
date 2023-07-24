<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@nris.ca',
            'username' => 'superadmin123',
            'password' => Hash::make('Admin@@001233'), // Replace 'password' with the desired password
            'role_id' => 1, // ID of the 'superadmin' role from the roles table
        ]);
        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@nris.ca',
            'username' => 'admin123',
            'password' => Hash::make('Admin@@123'), // Replace 'password' with the desired password
            'role_id' => 2, // ID of the 'superadmin' role from the roles table
        ]);

        
    }
}
