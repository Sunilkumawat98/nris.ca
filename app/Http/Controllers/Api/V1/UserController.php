<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\CommonLibrary;
use App\Http\Controllers\Api\V1\BaseController;

/**
 * @group User Profile Related
 *
 * APIs for managing all user's profile related
 */


class UserController extends BaseController
{
    public function __construct()
    {
        $this->num_of_day = 1;
        $this->to_day = date('d-m-Y');
        
        
        $this->code = 'status_code';
        $this->status = 'status';
        $this->result = 'result';
        $this->message = 'message';
        $this->data = 'data';
        $this->total = 'total_count';
        $this->commonLib = new CommonLibrary();
        
        
    }
    
   
    
    /**
     * getUserProfile
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     * EX
     *  {
            "user_id":1
        }
     *
     * <aside class="notice">basepath/api/v1/get-user-profile</aside>
     * @method POST
     * @authenticated
     * @header      Authorization Bearer _token required  
     * @bodyParam *user_id integer required Example: 1,2,3 in JSON BODY
     * @return \Illuminate\Http\Response
     *
     * 
     * @response 200
     *  {
            "status": true,
            "status_code": 200,
            "message": "Successfully Profile Get...",
            "data": {
                "id": 1,
                "first_name": "Abc",
                "last_name": "Def",
                "email": "you@domain.com",
                "dob": "2023-02-02",
                "mobile": "9899****54"
            }
     *  }
     *
     *
     * @response 404
     *  {
            "status": false,
            "status_code": 404,
            "message": "Profile not found...",
            "data": []
     *   }
     * 
     * 
     * @response 401
     *  {
            "message": "Token is Invalid",
            "status_code": 401,
            "status": false
     *  }
     * 
     *
     * 
     *   
     * @response 419
     *  {
            "message": "Token is Expired",
            "status_code": 419,
            "status": false
     *  }
     * 
     *  
     * 
     * @response 403
     *  {
            "message": "Authorised Token Not Found",
            "status_code": 403,
            "status": false
     *  }
     *
     *
     */
    
    
    
    
    public function getUserProfile(Request $request)
    {
        $all = $request->all();
        $response = $this->commonLib->userProfileGet($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    



    /**
     * changePassword
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Oops, something went wrong...
     *
     * EX
     *  {
            "user_id":1,
            "current_password":"Abc@123456789",
            "new_password":"Abc@12345",
            "retype_password":"Abc@12345"
        }
     * <aside class="notice">basepath/api/v1/change-password</aside>
     * @method POST
     * @authenticated
     * @header      Authorization Bearer _token required .   
     * @bodyParam *user_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *current_password string required Example: 1,2,3 in JSON BODY
     * @bodyParam *new_password string required Example: 1,2,3 in JSON BODY
     * @bodyParam *retype_password string required Example: 1,2,3 in JSON BODY
     * 
     * @return \Illuminate\Http\Response
     *
     * @response 200
     *  {
            "status": true,
            "status_code": 200,
            "message": "Successfully Password Changed...",
            "result": []
        }
     *
     *
     * @response 201
     *  {
            "status": false,
            "status_code": 404,
            "message": "User not found..."
     *  }
     * 
     * 
     * 
     * @response 403
     *  {
            "status": false,
            "status_code": 403,
            "message": "Current password is not being match...",
            "data": []
     *   }
     *  
     * 
     * @response 401
     *  {
            "message": "Token is Invalid",
            "status_code": 401,
            "status": false
     *  }
     * 
     * 
     * @response 419
     *  {
            "message": "Token is Expired",
            "status_code": 419,
            "status": false
     *  }
     * 
     * 
     * @response 403
     *  {
            "message": "Authorised Token Not Found",
            "status_code": 403,
            "status": false
     *  }
     *
     *
     */
    
    
    
    
    public function changePassword(Request $request)
    {
        $all = $request->all();
        $response = $this->commonLib->passwordChange($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    








    
    
    
}
