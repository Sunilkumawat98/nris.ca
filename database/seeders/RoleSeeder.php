<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Role::create(['name' => 'Super Admin', 'name_slug'=>'super-admin']);
        Role::create(['name' => 'admin','name_slug'=>'admin']);
        Role::create(['name' => 'Hr','name_slug'=>'hr']);
        Role::create(['name' => 'Accounts','name_slug'=>'accounts']);
        Role::create(['name' => 'Manager','name_slug'=>'manager']);
        Role::create(['name' => 'Php Developer','name_slug'=>'php-developer']);
    }
}
