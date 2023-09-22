<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\LoginRegisterLibrary;
use App\Http\Controllers\Api\V1\BaseController;


/**
 * @group Login, Register
 *
 * APIs for managing all Auth Related
 */

class LoginRegisterController extends BaseController
{
    
    public function __construct()
    {
        
        $this->status                   = 'status';
        $this->message                  = 'message';
        $this->code                     = 'status_code';
        $this->error                    = 'error';
        $this->error_code               = 'error_code';
        $this->data                     = 'data';

        $this->loginRegLib              = new LoginRegisterLibrary();

    }

    /**
     * register 
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and a response not found!
     *
     * EX
     *  {
            "first_name":"Abc",
            "last_name":"Def",
            "email":"You@domain.com",
            "dob":"2023-02-02",
            "mobile":"9899****54",
            "password":"Abc@12345",
            "country_id":1,
            "state_id":1
        }
     * <aside class="notice">basepath/api/v1/register</aside>
     *
     * @method POST
     * @bodyParam *first_name     required String     Ex ('Abc')
     * @bodyParam *last_name      required String     Ex ('def')
     * @bodyParam *email          required Email      Ex ('you@domain.com')
     * @bodyParam *dob            required Date       Ex ('YYYY-MM-DD')
     * @bodyParam *mobile         required String     Ex ('9876****09')
     * @bodyParam *password       required String     Ex ('Abc')
     * @bodyParam *country_id     required Number     Ex ('1/2/3/4')
     * @bodyParam *state_id       required Number     Ex ('1/2/3/4')
     * 
     * @return \Illuminate\Http\Response
     *
     * @response 200
     *  
        {
            "status": true,
            "status_code": 200,
            "message": "Successfully Registered...",
            "data": {
                "user_id": 1,
                "email": "you@domain.com"
            }
        }
     *
     * @response  409
     * 
        {
            "status": false,
            "status_code": 409,
            "message": "Email Id already exist..."
        }
     *
     * @response 202
     * 
        {
            "status": false,
            "status_code": 202,
            "message": "Oops, please try again..."
        }
     *
     *
     */






    public function register(Request $request)
    {
        
        $all = $request->all();
        // $all['email_id'] = $all['email'];
        $response = $this->loginRegLib->register($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);        
        
    }


    /**
     * login 
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and a response not found!
     *
     * EX
     *  {
            "email_id":"You@domain.com",
            "password":"Abc@12345",
        }
     *  <aside class="notice">basepath/api/v1/login</aside>
     *
     * @method POST
     
     * @bodyParam *email_id                   required        Number     Ex ('you@domain.com')
     * @bodyParam *password                   required        String     Ex ('********')
     * 
     * @return \Illuminate\Http\Response
     *
     * @response 200
     *  {
     *      "status": true,
     *      "status_code": 200,
     *      "message": "Successfully login..",
     *      "data": {
     *          "user_data": {
     *              "user_id": 1,
     *              "name": "Md Saddam Hussain",
     *              "email": "Hussain@gmail.com"
     *          },
     *          "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWwtbnJpcy5jYS9hcGkvdjEvbG9naW4iLCJpYXQiOjE2ODk2Nzk3ODYsImV4cCI6MTY4OTY4MzM4NiwibmJmIjoxNjg5Njc5Nzg2LCJqdGkiOiJUeXFsTU95MlA0WXpibXFsIiwic3ViIjoiMSIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.xSMoCqyWexiUAmnCNmC6xJZjvOWbQM9GMRZuQUYpSfc",
     *          "token_type": "bearer",
     *          "expires_in": 60
     *      }
     *  }
     *
     * @response 404
     *  {
     *      "status": false,
     *      "status_code": 404,
     *      "message": "Eamil id not found...",
     *      "data": []
     *  }
     *
     *
     * @response 401
     *  {
     *      "status": false,
     *      "status_code": 401,
     *      "message": "Incorrect Password...",
     *      "data": []
     *  }
     *
     *  
     */


    public function login(Request $request)
    {
        
        $all = $request->all();
        $response = $this->loginRegLib->userLogin($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);        
        
    }








     
    /**
     * forgotPass 
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and a response not found!
     *
     *
     * <aside class="notice">basepath/api/v1/forgot-pass</aside>
     *
     * @method POST
     * @bodyParam *email_id                       required        Number     Ex ('you@domain.com')
     * @return \Illuminate\Http\Response
     *
     * @response 200
     *  
        {
            "status": true,
            "status_code": 200,
            "message": "Successfully email send...",
            "data": []
        }
     *
     * @response  201
     * 
        {
            "status": false,
            "status_code": 201,
            "message": "Oops, something went wrong..."
        }
     *
     * @response 202
     * 
        {
            "status": false,
            "status_code": 202,
            "message": "Oops, please try again..."
        }
     *
     *
     */





     public function forgotPass(Request $request)
     {
         
         $all = $request->all();
         $response = $this->loginRegLib->forgotPass($all);
 
         if (!$response[$this->status]) {
             return $this->sendError($response[$this->message], $response[$this->code]);
         }
         
         return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);        
         
     }
    
    
    



     
    /**
     * changeForgotPassword 
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and a response not found!
     *
     *
     * <aside class="notice">basepath/api/v1/forgot-password-change</aside>
     *
     * @method POST
     * @bodyParam *email                       required        Number     Ex ('you@domain.com')
     * @bodyParam *new_password                required        String     Ex ('Abc@123')
     * @bodyParam *retype_password             required        String     Ex ('Abc@123')
     * @return \Illuminate\Http\Response
     *
     * @response 200
     *  
        {
            "status": true,
            "status_code": 200,
            "message": "Successfully password updated...",
            "data": []
        }
     *
     * @response  201
     * 
        {
            "status": false,
            "status_code": 201,
            "message": "Oops, some problem occure, Please try again..."
        }
     *
   
     *
     *
     */

     public function changeForgotPassword(Request $request)
     {
         
         $all = $request->all();
         $response = $this->loginRegLib->forgotPassUpdate($all);
 
         if (!$response[$this->status]) {
             return $this->sendError($response[$this->message], $response[$this->code]);
         }
         
         return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);        
         
     }
    
    
    


    
    



}
