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


        $insertsData = [
            ['name' => 'manage_dashboard', 'name_slug'=>'manage-dasboard'],
            
            
            ['name' => 'manage_roles', 'name_slug'=>'manage-roles'],
            ['name' => 'create_roles', 'name_slug'=>'create-roles'],
            ['name' => 'edit_roles', 'name_slug'=>'edit-roles'],
            ['name' => 'delete_roles', 'name_slug'=>'delete-roles'],
            ['name' => 'show_roles', 'name_slug'=>'show-roles'],

            ['name' => 'manage_permissions', 'name_slug'=>'manage-permissions'],
            ['name' => 'create_permissions', 'name_slug'=>'create-permissions'],
            ['name' => 'edit_permissions', 'name_slug'=>'edit-permissions'],
            ['name' => 'delete_permissions', 'name_slug'=>'delete-permissions'],
            ['name' => 'show_permissions', 'name_slug'=>'show-permissions'],

            ['name' => 'manage_users', 'name_slug'=>'manage-users'],
            ['name' => 'create_users', 'name_slug'=>'create-users'],
            ['name' => 'edit_users', 'name_slug'=>'edit-users'],
            ['name' => 'delete_users', 'name_slug'=>'delete-users'],
            ['name' => 'show_users', 'name_slug'=>'show-users'],

            ['name' => 'manage_location', 'name_slug'=>'manage-location'],
            ['name' => 'create_country', 'name_slug'=>'create-country'],
            ['name' => 'edit_country', 'name_slug'=>'edit-country'],
            ['name' => 'delete_country', 'name_slug'=>'delete-country'],
            ['name' => 'show_country', 'name_slug'=>'show-country'],
            ['name' => 'create_state', 'name_slug'=>'create-state'],
            ['name' => 'edit_state', 'name_slug'=>'edit-state'],
            ['name' => 'delete_state', 'name_slug'=>'delete-state'],
            ['name' => 'show_state', 'name_slug'=>'show-state'],
            ['name' => 'create_city', 'name_slug'=>'create-city'],
            ['name' => 'edit_city', 'name_slug'=>'edit-city'],
            ['name' => 'delete_city', 'name_slug'=>'delete-city'],
            ['name' => 'show_city', 'name_slug'=>'show-city'],

            ['name' => 'manage_desi_movies', 'name_slug'=>'manage-desi-movies'],
            ['name' => 'create_desi_movies', 'name_slug'=>'create-desi-movies'],
            ['name' => 'edit_desi_movies', 'name_slug'=>'edit-desi-movies'],
            ['name' => 'delete_desi_movies', 'name_slug'=>'delete-desi-movies'],
            ['name' => 'show_desi_movies', 'name_slug'=>'show-desi-movies'],

            ['name' => 'manage_movie_review', 'name_slug'=>'manage-movie-review'],
            ['name' => 'create_movie_review', 'name_slug'=>'create-movie-review'],
            ['name' => 'edit_movie_review', 'name_slug'=>'edit-movie-review'],
            ['name' => 'delete_movie_review', 'name_slug'=>'delete-movie-review'],
            ['name' => 'show_movie_review', 'name_slug'=>'show-movie-review'],

            ['name' => 'manage_business_listing', 'name_slug'=>'manage-business_listing'],
            ['name' => 'create_business_category', 'name_slug'=>'create-business-category'],
            ['name' => 'edit_business_category', 'name_slug'=>'edit-business-category'],
            ['name' => 'show_business_category', 'name_slug'=>'show-business-category'],
            ['name' => 'delete_business_category', 'name_slug'=>'delete-business-category'],
            ['name' => 'create_business_sub_category', 'name_slug'=>'create-business-sub-category'],
            ['name' => 'edit_business_sub_category', 'name_slug'=>'edit-business-sub-category'],
            ['name' => 'show_business_sub_category', 'name_slug'=>'show-business-sub-category'],
            ['name' => 'delete_business_sub_category', 'name_slug'=>'delete-business-sub-category'],
            ['name' => 'create_business_listing', 'name_slug'=>'create-business-listing'],
            ['name' => 'edit_business_listing', 'name_slug'=>'edit-business-listing'],
            ['name' => 'show_business_listing', 'name_slug'=>'show-business-listing'],
            ['name' => 'delete_business_listing', 'name_slug'=>'delete-business-listing'],            

            ['name' => 'manage_free_classifieds', 'name_slug'=>'manage-free-classifieds'],            
            ['name' => 'create_classified_category', 'name_slug'=>'create-classified-category'],
            ['name' => 'edit_classified_category', 'name_slug'=>'edit-classified-category'],
            ['name' => 'show_classified_category', 'name_slug'=>'show-classified-category'],
            ['name' => 'delete_classified_category', 'name_slug'=>'delete-classified-category'],

            ['name' => 'create_classified_subcategory', 'name_slug'=>'create-classified-subcategory'],
            ['name' => 'edit_classified_subcategory', 'name_slug'=>'edit-classified-subcategory'],
            ['name' => 'show_classified_subcategory', 'name_slug'=>'show-classified-subcategory'],
            ['name' => 'delete_classified_subcategory', 'name_slug'=>'delete-classified-subcategory'],

            ['name' => 'manage_movie_ratings', 'name_slug'=>'manage-movie-ratings'],
            ['name' => 'create_movie_ratings', 'name_slug'=>'create-movie-ratings'],
            ['name' => 'edit_movie_ratings', 'name_slug'=>'edit-movie-ratings'],
            ['name' => 'show_movie_ratings', 'name_slug'=>'show-movie-ratings'],
            ['name' => 'delete_movie_ratings', 'name_slug'=>'delete-movie-ratings'],

            ['name' => 'manage_rating_source', 'name_slug'=>'manage-rating-source'],
            ['name' => 'create_rating_source', 'name_slug'=>'create-rating-source'],
            ['name' => 'edit_rating_source', 'name_slug'=>'edit-rating-source'],
            ['name' => 'show_rating_source', 'name_slug'=>'show-rating-source'],
            ['name' => 'delete_rating_source', 'name_slug'=>'delete-rating-source'],



            // Add more user data entries as needed
        ];


        

        foreach ($insertsData as $insertData) {
            $existingData = Permission::where('name', $insertData['name'])->first();

            if (!$existingData) {
                Permission::create($insertData);
                $this->command->info("Permission '{$insertData['name']}' inserted successfully.");
            } else {
                $this->command->info("Permission '{$insertData['name']}' already exists. Skipping insertion.");
            }
        }
    }
}
