<?php

return [
    "rules" => [
        'id'                    => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'user_id'               => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'country_id'            => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'state_id'              => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'city_id'               => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'talk_id'               => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'category_id'           => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'sub_cat_id'            => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'contact_name'          => "bail|required|regex:/^[a-z A-Z\.]*$/|min:3|max:120",
        'first_name'            => "bail|required|regex:/^[a-z A-Z\.]*$/|min:3|max:120",
        'last_name'             => "bail|required|regex:/^[a-z A-Z\.]*$/|min:3|max:120",
        'address'               => "bail|required|regex:/^[a-z A-Z\.]*$/|min:3|max:120",
        'contact_address'       => "bail|required|regex:/^[a-z A-Z\.]*$/|min:3|max:120",
        'keyword'               => "bail|required|regex:/^[a-z A-Z\.]*$/|min:3|max:120",
        'email_id'              => "bail|required|email|unique:users",
        'contact_email'         => "bail|required|email",
        'email'                 => "bail|required|email",
        'email_key'             => "bail|required|string",
        'mobile'                => "required|numeric|regex:/^[6-9]\d{9}$/",
        'contact_number'        => "required|numeric|regex:/^[6-9]\d{9}$/",
        'mobile_no'             => "required|numeric|regex:/^[6-9]\d{9}$/",
        'interest'              => "bail|required|regex:/^[a-z A-Z\.]*$/|max:255",
        'dob'                   => "required|date|date_format:Y-m-d",
        'from_date'             => "required|date|date_format:Y-m-d",
        'to_date'               => "required|date|date_format:Y-m-d",
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
        'amount'                => 'required|numeric|regex:/^\d{1,6}(\.\d{1,2})?$/',
        'comment'               => "bail|required|string",
        
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
                "first_name",
                "last_name",
                "email_id",
                "dob",
                "mobile",
                "password",
                "country_id", 
                "state_id"
            ],
            "optional" => [
            ]
        ], 

        "userLogin" => [
            "required" => [
                "email",
                "password"
            ],
            "optional" => [
            ]
        ], 

        "forgotPass" => [
            "required" => [
                "email",
            ],
            "optional" => [
            ]
        ], 

        "changeforgotPass" => [
            "required" => [
                "email", "new_password", "retype_password"
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
                "user_id", 'state_id', 'title', 'description'
            ],
            "optional" => [
            ]
        ],

        "replyNrisTalkCreate" => [
            "required" => [
                "user_id", 'state_id', 'talk_id', 'description'
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

        "getAllNrisTalkReplyById" => [
            "required" => [
                'talk_id'
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
                'user_id', 'country_id', 'state_id', 'contact_name', 'contact_email', 'contact_number', 'contact_address',  'show_email',
                'use_address_map', 'end_at'
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


    ],
];
