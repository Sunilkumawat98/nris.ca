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

            ['name' => 'manage_nris_talk', 'name_slug'=>'manage-nris-talk'],
            ['name' => 'create_nris_talk', 'name_slug'=>'create-nris-talk'],
            ['name' => 'edit_nris_talk', 'name_slug'=>'edit-nris-talk'],
            ['name' => 'show_nris_talk', 'name_slug'=>'show-nris-talk'],
            ['name' => 'delete_nris_talk', 'name_slug'=>'delete-nris-talk'],

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



            ['name' => 'manage_national_event', 'name_slug'=>'manage-national-event'],
            ['name' => 'create_events_category', 'name_slug'=>'create-events-category'],
            ['name' => 'edit_events_category', 'name_slug'=>'edit-events-category'],
            ['name' => 'show_events_category', 'name_slug'=>'show-events-category'],
            ['name' => 'delete_events_category', 'name_slug'=>'delete-events-category'],
            ['name' => 'create_national_events', 'name_slug'=>'create-national-events'],
            ['name' => 'edit_national_events', 'name_slug'=>'edit-national-events'],
            ['name' => 'show_national_events', 'name_slug'=>'show-national-events'],
            ['name' => 'delete_national_events', 'name_slug'=>'delete-national-events'],

            ['name' => 'dashboard_total_admin_user', 'name_slug'=>'dashboard-total-admin-user'],
            ['name' => 'dashboard_total_user', 'name_slug'=>'dashboard-total-user'],


            ['name' => 'manage_student_talk', 'name_slug'=>'manage-student-talk'],
            ['name' => 'create_student_talk_category', 'name_slug'=>'create-student-talk-category'],
            ['name' => 'edit_student_talk_category', 'name_slug'=>'edit-student-talk-category'],
            ['name' => 'show_student_talk_category', 'name_slug'=>'show-student-talk-category'],
            ['name' => 'delete_student_talk_category', 'name_slug'=>'delete-student-talk-category'],

            ['name' => 'create_university', 'name_slug'=>'create-university'],
            ['name' => 'edit_university', 'name_slug'=>'edit-university'],
            ['name' => 'show_university', 'name_slug'=>'show-university'],
            ['name' => 'delete_university', 'name_slug'=>'delete-university'],

            ['name' => 'create_student_talk', 'name_slug'=>'create-student-talk'],
            ['name' => 'edit_student_talk', 'name_slug'=>'edit-student-talk'],
            ['name' => 'show_student_talk', 'name_slug'=>'show-student-talk'],
            ['name' => 'delete_student_talk', 'name_slug'=>'delete-student-talk'],

            ['name' => 'manage_training_placement', 'name_slug'=>'manage-training-placement'],
            ['name' => 'create_training_placement_category', 'name_slug'=>'create-training-placement-category'],
            ['name' => 'edit_training_placement_category', 'name_slug'=>'edit-training-placement-category'],
            ['name' => 'show_training_placement_category', 'name_slug'=>'show-training-placement-category'],
            ['name' => 'delete_training_placement_category', 'name_slug'=>'delete-training-placement-category'],

            ['name' => 'create_training_placement', 'name_slug'=>'create-training-placement'],
            ['name' => 'edit_training_placement', 'name_slug'=>'edit-training-placement'],
            ['name' => 'show_training_placement', 'name_slug'=>'show-training-placement'],
            ['name' => 'delete_training_placement', 'name_slug'=>'delete-training-placement'],

            ['name' => 'manage_news_letter', 'name_slug'=>'manage-news-letter'],

            ['name' => 'manage_blog', 'name_slug'=>'manage-blog'],
            ['name' => 'create_blog_category', 'name_slug'=>'create-blog-category'],
            ['name' => 'edit_blog_category', 'name_slug'=>'edit-blog-category'],
            ['name' => 'show_blog_category', 'name_slug'=>'show-blog-category'],
            ['name' => 'delete_blog_category', 'name_slug'=>'delete-blog-category'],
            ['name' => 'create_blog', 'name_slug'=>'create-blog'],
            ['name' => 'edit_blog', 'name_slug'=>'edit-blog'],
            ['name' => 'show_blog', 'name_slug'=>'show-blog'],
            ['name' => 'delete_blog', 'name_slug'=>'delete-blog'],

            ['name' => 'manage_forum', 'name_slug'=>'manage-forum'],
            ['name' => 'create_forum_category', 'name_slug'=>'create-forum-category'],
            ['name' => 'edit_forum_category', 'name_slug'=>'edit-forum-category'],
            ['name' => 'show_forum_category', 'name_slug'=>'show-forum-category'],
            ['name' => 'delete_forum_category', 'name_slug'=>'delete-forum-category'],
            ['name' => 'create_forum_subcategory', 'name_slug'=>'create-forum-subcategory'],
            ['name' => 'edit_forum_subcategory', 'name_slug'=>'edit-forum-subcategory'],
            ['name' => 'show_forum_subcategory', 'name_slug'=>'show-forum-subcategory'],
            ['name' => 'delete_forum_subcategory', 'name_slug'=>'delete-forum-subcategory'],
            ['name' => 'create_forum', 'name_slug'=>'create-forum'],
            ['name' => 'edit_forum', 'name_slug'=>'edit-forum'],
            ['name' => 'show_forum', 'name_slug'=>'show-forum'],
            ['name' => 'delete_forum', 'name_slug'=>'delete-forum'],

            ['name' => 'manage_movie_videos', 'name_slug'=>'manage-movie-videos'],
            ['name' => 'create_movie_videos_category', 'name_slug'=>'create-movie-videos-category'],
            ['name' => 'edit_movie_videos_category', 'name_slug'=>'edit-movie-videos-category'],
            ['name' => 'show_movie_videos_category', 'name_slug'=>'show-movie-videos-category'],
            ['name' => 'delete_movie_videos_category', 'name_slug'=>'delete-movie-videos-category'],


            ['name' => 'create_movie_videos_language', 'name_slug'=>'create-movie-videos-language'],
            ['name' => 'edit_movie_videos_language', 'name_slug'=>'edit-movie-videos-language'],
            ['name' => 'show_movie_videos_language', 'name_slug'=>'show-movie-videos-language'],
            ['name' => 'delete_movie_videos_language', 'name_slug'=>'delete-movie-videos-language'],

            ['name' => 'create_movie_videos', 'name_slug'=>'create-movie-videos'],
            ['name' => 'edit_movie_videos', 'name_slug'=>'edit-movie-videos'],
            ['name' => 'show_movie_videos', 'name_slug'=>'show-movie-videos'],
            ['name' => 'delete_movie_videos', 'name_slug'=>'delete-movie-videos'],

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
