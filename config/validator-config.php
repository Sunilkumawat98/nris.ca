<?php

return [
    "rules" => [
        'id'                    => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'user_id'               => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'country_id'            => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'university_id'         => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'state_id'              => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'city_id'               => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'event_id'              => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'carpool_id'            => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'talk_id'               => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'category_id'           => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'language_id'           => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'sub_cat_id'            => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'forum_id'              => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'contact_name'          => "bail|required|regex:/^[a-z A-Z\.]*$/|min:3|max:120",
        'first_name'            => "bail|required|regex:/^[a-z A-Z\.]*$/|min:3|max:120",
        'last_name'             => "bail|required|regex:/^[a-z A-Z\.]*$/|min:3|max:120",
        'name'                  => "bail|required|regex:/^[a-z A-Z\.]*$/|min:3|max:120",
        'address'               => "bail|required|regex:/^[a-z A-Z\.]*$/|min:3|max:120",
        'contact_address'       => "bail|required|regex:/^[a-z A-Z\.]*$/|min:3|max:120",
        'keyword'               => "bail|required|regex:/^[a-z A-Z\.]*$/|min:3|max:120",
        'email_id'              => "bail|required|email",
        'contact_email'         => "bail|required|email",
        'email'                 => "bail|required|email|unique:users",
        'email_key'             => "bail|required|string",
        'mobile'                => "required|numeric|regex:/^[6-9]\d{9}$/",
        'contact_number'        => "required|numeric|regex:/^[6-9]\d{9}$/",
        'mobile_no'             => "required|numeric|regex:/^[6-9]\d{9}$/",
        'interest'              => "bail|required|regex:/^[a-z A-Z\.]*$/|max:255",
        'dob'                   => "required|date|date_format:Y-m-d",
        'from_date'             => "required|date|date_format:Y-m-d",
        'to_date'               => "required|date|date_format:Y-m-d",
        
        'journey_type'          => "bail|required|string|in:oneway,twoway",
        'ad_position'           => "bail|required|string|in:top,left,right",
        'flex_date'             => "bail|required|string|in:no,yes",
        'flex_time'             => "bail|required|string|in:no,yes",
        'flex_location'         => "bail|required|string|in:no,yes",

        'start_date'            => "required|date|date_format:Y-m-d",
        'end_date'              => "required_if:journey_type,twoway|date|date_format:Y-m-d",

        'start_time'            => "required|date_format:H:i",
        'end_time'              => "required_if:journey_type,twoway|date_format:H:i",
        

        'end_at'                => "required|date|date_format:Y-m-d",
        'cookie_session'        => "bail|required|numeric",
        'password'              => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        'current_password'      => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        'new_password'          => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        'retype_password'       => 'required|same:new_password',
        'title'                 => "bail|required|string",
        'description'           => "bail|required|string",
        'show_email'            => "required|boolean",
        'use_address_map'       => "required|boolean",
        'image'                 => 'required|image|mimes:jpeg,png,jpg,gif',
        'classified_id'         => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'business_list_id'      => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'training_id'           => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'blog_id'               => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'news_id'               => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'video_id'              => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'rating'                => "required|integer|min:1|max:5",
        'amount'                => 'required|numeric|regex:/^\d{1,6}(\.\d{1,2})?$/',
        'comment'               => "bail|required|string",
        'message'               => "bail|required|string",
        'website'               => "bail|required|string",
        'education_field'       => "bail|required|string",
        'business_name'         => "bail|required|string",
        'website_link'          => "bail|required|string",
        
    ],


    "api_validations" =>[
        
         



        /*
            Country, State & City
        */

        "allStateByCountry" => [
            "required" => [
                 "country_id"
            ],
            "optional" => [
            ]
        ], 
        "allCityByStateCountry" => [
            "required" => [
                "country_id", "state_id"
            ],
            "optional" => [
            ]
        ], 



        "register" => [
            "required" => [
                "first_name", "last_name",  "email", "dob", "mobile", "password", "country_id", "state_id"
            ],
            "optional" => [
            ]
        ], 

        "userLogin" => [
            "required" => [
                "email_id",
                "password"
            ],
            "optional" => [
            ]
        ], 

        "forgotPass" => [
            "required" => [
                "email_id",
            ],
            "optional" => [
            ]
        ], 

        "changeforgotPass" => [
            "required" => [
                "email_id", "new_password", "retype_password"
            ],
            "optional" => [
            ]
        ],


        /**
         * 
         * 
         * newsLetterSubscribe
         */

        "newsLetterSubscribe" => [
            "required" => [
                "email_id"
            ],
            "optional" => [
            ]
        ],





        /*
            User Profile
        */
        "userProfileGet" => [
            "required" => [
                "user_id"
            ],
            "optional" => [
            ]
        ], 
        "passwordChange" => [
            "required" => [
                "user_id", 'current_password', 'new_password', 'retype_password'
            ],
            "optional" => [
            ]
        ],
        
        

        /*
            Create Nris talk and Its Reply
        
        */
        "createNrisTalk" => [
            "required" => [
                "user_id", 'country_id', 'state_id', 'title', 'description'
            ],
            "optional" => [
            ]
        ],

        "replyNrisTalkCreate" => [
            "required" => [
                "user_id", 'country_id', 'state_id', 'talk_id', 'description'
            ],
            "optional" => [
            ]
        ],

        "nrisTalkFetch" => [
            "required" => [
                "user_id",  'talk_id'
            ],
            "optional" => [
            ]
        ],

        "allNrisTalkFetch" => [
            "required" => [
                'country_id','state_id'
            ],
            "optional" => [
            ]
        ],

        "allNrisTalkListFetch" => [
            "required" => [
                'country_id','state_id'
            ],
            "optional" => [
            ]
        ],

        "nrisTalkListFetch" => [
            "required" => [
                'country_id','state_id'
            ],
            "optional" => [
            ]
        ],

        "getAllNrisTalkReplyById" => [
            "required" => [
                'talk_id'
            ],
            "optional" => [
            ]
        ],

        "likeNrisTalkById" => [
            "required" => [
                "user_id", 'country_id', 'state_id', 'talk_id'
            ],
            "optional" => [
            ]
        ],




        /*
            Create University, Student talk and Its Reply
        
        */
        "allUniversityGet" => [
            "required" => [
                'country_id', 'state_id'
            ],
            "optional" => [
            ]
        ],
        "studentUniversityCreate" => [
            "required" => [
                "user_id", 'country_id', 'state_id', 'category_id', 'name', 
                'website', 'education_field', 'message'
            ],
            "optional" => [
            ]
        ],
        "studentTalkCreate" => [
            "required" => [
                "user_id", 'country_id', 'state_id', 'category_id', 'university_id','title', 
                'email', 'mobile', 'address'
            ],
            "optional" => [
            ]
        ],

        "allStudentTalkFetch" => [
            "required" => [
                'country_id', 'state_id'
            ],
            "optional" => [
            ]
        ],
        "studentTalkFetchByCategory" => [
            "required" => [
                'country_id', 'state_id'
            ],
            "optional" => [
            ]
        ],




        /*
        
            Business Listing, Its category and Sub category
        
        */


        "businessListingByCategoryGet" => [
            "required" => [
                'country_id'
            ],
            "optional" => [
            ]
        ],

        "allBusinessListingByCategoryGet" => [
            "required" => [
                'country_id', 'state_id', 'category_id'
            ],
            "optional" => [
            ]
        ],

        "reviewBusinessListing" => [
            "required" => [
                'country_id', 'state_id', 'user_id', 'business_list_id', 'rating'
            ],
            "optional" => [
            ]
        ],

        "businessListingByIdGet" => [
            "required" => [
                'country_id', 'state_id', 'business_list_id'
            ],
            "optional" => [
            ]
        ],





        /*
        
            Events Listing & Its category
        
        */


        "eventListingByCategoryGet" => [
            "required" => [
                'country_id'
            ],
            "optional" => [
            ]
        ],


        "allEventListingByCategoryGet" => [
            "required" => [
                'country_id', 'state_id', 'category_id'
            ],
            "optional" => [
            ]
        ],


        "eventListingByIdGet" => [
            "required" => [
                'country_id', 'state_id', 'event_id'
            ],
            "optional" => [
            ]
        ],


        "commentEventListing" => [
            "required" => [
                'country_id', 'state_id', 'user_id', 'event_id', 'comment'
            ],
            "optional" => [
            ]
        ],


        /**
         * 
         * 
         * News Videos
         */

         "newsByIdGet" => [
            "required" => [
                'news_id'
            ],
            "optional" => [
            ]
        ],


        /**
         * 
         * 
         * Carpool
         */

        "carpoolCreate" => [        
            "required" => [
                'category_id', 'journey_type', 'user_id', 'contact_name', 'contact_email', 'contact_number', 'contact_address',
                'start_date', 'end_date',  'start_time', 'end_time', 'flex_date', 'flex_time', 'flex_location', 
            ],

            "optional" => [
                
            ]
        ],

        "carpoolCommentCreate" => [
            "required" => [
                'user_id', "carpool_id", "comment"
            ],
            "optional" => [
            ]
        ],


        "allCarpoolByCategoryGet" => [
            "required" => [
                'category_id'
            ],
            "optional" => [
            ]
        ],

        "carpoolByIdGet" => [
            "required" => [
                'carpool_id'
            ],
            "optional" => [
            ]
        ],

        /**
         * 
         * 
         * Blog
         */

        "blogByIdGet" => [
            "required" => [
                'blog_id'
            ],
            "optional" => [
            ]
        ],

        "blogByCategoryGet" => [
            "required" => [
                'category_id'
            ],
            "optional" => [
            ]
        ],

        "likeBlog" => [
            "required" => [
                'blog_id', 'user_id'
            ],
            "optional" => [
            ]
        ],

        "dislikeBlog" => [
            "required" => [
                'blog_id', 'user_id'
            ],
            "optional" => [
            ]
        ],









        /**
         * MovieVideo
         * 
         * */        


        "movieVideoByCategoryGet" => [
            "required" => [
                'category_id'
            ],
            "optional" => [
            ]
        ],

        "movieVideoByLanguageGet" => [
            "required" => [
                'language_id'
            ],
            "optional" => [
            ]
        ],

        "movieVideoByLanguageCategoryGet" => [
            "required" => [
                'language_id', 'category_id'
            ],
            "optional" => [
            ]
        ],

        "movieVideoSearch" => [
            "required" => [
                'keyword'
            ],
            "optional" => [
            ]
        ],


        "likeVideoMovie" => [
            "required" => [
                'video_id', 'user_id'
            ],
            "optional" => [
            ]
        ],

        "disLikeVideoMovie" => [
            "required" => [
                'video_id', 'user_id'
            ],
            "optional" => [
            ]
        ],


        /*
        
            Traning & Placement Listing & Its category
        
        */


        "trainingPlacementListingByCategoryGet" => [
            "required" => [
                'country_id'
            ],
            "optional" => [
            ]
        ],
        "allTrainingPlacementListingByCategoryGet" => [
            "required" => [
                'country_id', 'state_id', 'category_id'
            ],
            "optional" => [
            ]
        ],
        "trainingPlacementListingByIdGet" => [
            "required" => [
                'country_id', 'state_id', 'training_id'
            ],
            "optional" => [
            ]
        ],
        "commentTrainingListing" => [
            "required" => [
                'country_id', 'state_id', 'user_id', 'training_id', 'comment'
            ],
            "optional" => [
            ]
        ],

        "trainingListGetByUserId" => [
            "required" => [
                'user_id'
            ],
            "optional" => [
            ]
        ],




        /***
         * 
         * Advertise with us
         */


        "advertiseWithUsCreate" => [
           
            "required" => [
                'first_name','last_name', 'email', 'mobile', 'business_name',  'website_link',
                'image', 'message'
            ],
            "optional" => [
                
            ]
        ],


        "homePageGifAdsGet" => [
            "required" => [
                'country_id', "ad_position"
            ],
            "optional" => [
            ]
        ],



        /*
        
            search
        
        */

        
        "searchCountry" => [
            "required" => [
                'country_id',"keyword"
            ],
            "optional" => [
            ]
        ],
        "searchState" => [
            "required" => [
                'country_id', 'state_id', "keyword"
            ],
            "optional" => [
            ]
        ],


        /*
            Category And Sub Category
        */

        "allCategoryByIdGet" => [
            "required" => [
                'category_id'
            ],
            "optional" => [
            ]
        ],

        "freeClasifiedCreate" => [
           
            "required" => [
                'user_id', 'country_id', 'state_id', 'city_id', 'contact_name', 'contact_email', 'contact_number', 'contact_address',  'show_email',
                'use_address_map', 'end_at'
            ],
            "optional" => [
                
            ]
        ],

        "recentAdsGet" => [
           
            "required" => [
                'country_id'
            ],
            "optional" => [
                
            ]
        ],
        "recentAdsListGet" => [
           
            "required" => [
                'country_id', 'state_id'
            ],
            "optional" => [
                
            ]
        ],
        "freeAdsSearch" => [
           
            "required" => [
                'country_id', 'state_id', 'category_id', 'keyword'
            ],
            "optional" => [
                
            ]
        ],
        "freeAdsGetByCategory" => [
           
            "required" => [
                'country_id', 'state_id', 'category_id'
            ],
            "optional" => [
                
            ]
        ],

        "freeClasifiedBidCreate" => [
           
            "required" => [
                'user_id', 'classified_id', 'amount', 'comment'
            ],
            "optional" => [
                
            ]
        ],

        "freeClasifiedCommentCreate" => [
           
            "required" => [
                'user_id', 'classified_id', 'comment'
            ],
            "optional" => [
                
            ]
        ],

        "getFreeClasifiedById" => [
           
            "required" => [
                'id'
            ],
            "optional" => [
                
            ]
        ],

        "getAllSubSubCategoryUnderSubCategory" => [
           
            "required" => [
                'category_id'
            ],
            "optional" => [
                
            ]
        ],


        /**
         * 
         * Forum, Category & sub category
         * allForumSubCategoryByIdGet
         * 
         */


        "allForumSubCategoryByIdGet" => [
            "required" => [
                'category_id'
            ],
            "optional" => [
            ]
        ],

        "allForumByCategoryGet" => [
            "required" => [
                'category_id'
            ],
            "optional" => [
            ]
        ],


        "forumByIdGet" => [
            "required" => [
                'forum_id'
            ],
            "optional" => [
            ]
        ],


        "forumCreate" => [
            "required" => [
                'user_id', "category_id", "sub_cat_id", "title", "description"
            ],
            "optional" => [
            ]
        ],

        "forumCommentCreate" => [
            "required" => [
                'user_id', "forum_id", "comment"
            ],
            "optional" => [
            ]
        ],

        /* 
        
            Movie Related
        */
        "allDesiMoviesGet" => [
           
            "required" => [
                'country_id', 'state_id'
            ],
            "optional" => [
                
            ]
        ],
        "latestDesiMoviesGet" => [
           
            "required" => [
                'country_id', 'state_id'
            ],
            "optional" => [
                
            ]
        ],


    ],
];
