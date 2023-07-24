<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Permission::create(['name' => 'manage_dashboard', 'name_slug'=>'manage-dasboard']);
        Permission::create(['name' => 'manage_roles', 'name_slug'=>'manage-roles']);
        Permission::create(['name' => 'manage_permissions', 'name_slug'=>'manage-permissions']);
        Permission::create(['name' => 'manage_users', 'name_slug'=>'manage-users']);
        Permission::create(['name' => 'manage_location', 'name_slug'=>'manage-location']);
        Permission::create(['name' => 'manage_desi_movies', 'name_slug'=>'manage-desi-movies']);
        Permission::create(['name' => 'manage_movie_review', 'name_slug'=>'manage-movie-review']);
        Permission::create(['name' => 'manage_business_listing', 'name_slug'=>'manage-business_listing']);
        
        Permission::create(['name' => 'create_roles', 'name_slug'=>'create-roles']);
        Permission::create(['name' => 'edit_roles', 'name_slug'=>'edit-roles']);
        Permission::create(['name' => 'delete_roles', 'name_slug'=>'delete-roles']);
        Permission::create(['name' => 'show_roles', 'name_slug'=>'show-roles']);       

        Permission::create(['name' => 'create_permissions', 'name_slug'=>'create-permissions']);
        Permission::create(['name' => 'edit_permissions', 'name_slug'=>'edit-permissions']);
        Permission::create(['name' => 'delete_permissions', 'name_slug'=>'delete-permissions']);
        Permission::create(['name' => 'show_permissions', 'name_slug'=>'show-permissions']);

        Permission::create(['name' => 'create_users', 'name_slug'=>'create-users']);
        Permission::create(['name' => 'edit_users', 'name_slug'=>'edit-users']);
        Permission::create(['name' => 'delete_users', 'name_slug'=>'delete-users']);
        Permission::create(['name' => 'show_users', 'name_slug'=>'show-users']);       

        Permission::create(['name' => 'create_country', 'name_slug'=>'create-country']);
        Permission::create(['name' => 'edit_country', 'name_slug'=>'edit-country']);
        Permission::create(['name' => 'delete_country', 'name_slug'=>'delete-country']);
        Permission::create(['name' => 'show_country', 'name_slug'=>'show-country']);

        Permission::create(['name' => 'create_state', 'name_slug'=>'create-state']);
        Permission::create(['name' => 'edit_state', 'name_slug'=>'edit-state']);
        Permission::create(['name' => 'delete_state', 'name_slug'=>'delete-state']);
        Permission::create(['name' => 'show_state', 'name_slug'=>'show-state']);

        Permission::create(['name' => 'create_city', 'name_slug'=>'create-city']);
        Permission::create(['name' => 'edit_city', 'name_slug'=>'edit-city']);
        Permission::create(['name' => 'delete_city', 'name_slug'=>'delete-city']);
        Permission::create(['name' => 'show_city', 'name_slug'=>'show-city']);

        Permission::create(['name' => 'create_desi_movies', 'name_slug'=>'create-desi-movies']);
        Permission::create(['name' => 'edit_desi_movies', 'name_slug'=>'edit-desi-movies']);
        Permission::create(['name' => 'delete_desi_movies', 'name_slug'=>'delete-desi-movies']);
        Permission::create(['name' => 'show_desi_movies', 'name_slug'=>'show-desi-movies']);

        Permission::create(['name' => 'create_movie_review', 'name_slug'=>'create-movie-review']);
        Permission::create(['name' => 'edit_movie_review', 'name_slug'=>'edit-movie-review']);
        Permission::create(['name' => 'delete_movie_review', 'name_slug'=>'delete-movie-review']);
        Permission::create(['name' => 'show_movie_review', 'name_slug'=>'show-movie-review']);

        Permission::create(['name' => 'create_business_listing', 'name_slug'=>'create-business-listing']);
        Permission::create(['name' => 'edit_business_listing', 'name_slug'=>'edit-business-listing']);
        Permission::create(['name' => 'delete_business_listing', 'name_slug'=>'delete-business-listing']);
        Permission::create(['name' => 'show_business_listing', 'name_slug'=>'show-business-listing']);

    }
}
