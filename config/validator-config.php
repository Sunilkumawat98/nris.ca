<?php

return [
    "rules" => [
        'user_id'               => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'country_id'            => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'state_id'              => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'city_id'               => "bail|required|numeric|regex:/^\d{1,15}?$/",
        'name'                  => "bail|required|regex:/^[a-z A-Z\.]*$/|min:3|max:120",
        'address'               => "bail|required|regex:/^[a-z A-Z\.]*$/|min:3|max:120",
        'keyword'               => "bail|required|regex:/^[a-z A-Z\.]*$/|min:3|max:120",
        'email'                 => "bail|required|email|unique:user_master",
        'email_id'              => "bail|required|email",
        'email_key'             => "bail|required|string",
        'mobile'                => "required|numeric|digits:10|regex:/^[6-9]\d{9}$/",
        'mobile_no'             => "required|numeric|digits:10|regex:/^[6-9]\d{9}$/",
        'interest'              => "bail|required|regex:/^[a-z A-Z\.]*$/|max:255",
        'from_date'             => "required|date|date_format:Y-m-d",
        'to_date'               => "required|date|date_format:Y-m-d",
        'cookie_session'        => "bail|required|numeric",
        'password'              => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        'current_password'      => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        'new_password'          => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        'retype_password'           => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        
        

        
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


    ],
];
