<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\AdvertiseWithUsLibrary;
use App\Http\Controllers\Api\V1\BaseController;

/**
 * @group Advertise With Us Related
 *
 * APIs for managing advertise with us
 */


class AdvertiseWithUsController extends BaseController
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
        $this->advertiseLib = new AdvertiseWithUsLibrary();
        
        
    }
    
      
    
   
    
    /**
     * createAdvertiseWithUs
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     * EX
     *  {
            "first_name":"Abc",
            "last_name":"xyz",
            "email":"you@domain.com",
            "mobile":"98****3212",
            "business_name":"Business Name",
            "wesite_link":"www.website.com",
            "image":"png, jpeg, jpg, gif",
            "message":"this is test message"
     *  }
     *
     * <aside class="notice">basepath/api/v1/create-advertise-with-us</aside>
     * @method POST
     
     * @bodyParam *first_name string required Example: "title text " in JSON BODY
     * @bodyParam *last_name string required Example: "title text " in JSON BODY
     * @bodyParam *message string  required Example: "message text " in JSON BODY
     * @bodyParam *image image required Example: "abc.jpg" in JSON BODY
     * @bodyParam *email string required Example: you@domain.com in JSON BODY
     * @bodyParam *mobile string required Example: 9090654320 in JSON BODY
     * @bodyParam *business_name string required Example: Address in JSON BODY
     * @bodyParam *wesite_link string required Example: www.text.link in JSON BODY
     * @return \Illuminate\Http\Response
     *
     * 
     * @response 200
     *  
     * 
     * {
            "status": true,
            "status_code": 200,
            "message": "Successfully submitted...",
            "data": {
                "first_name": "abc",
                "last_name": "desf",
                "email": "you@domain.com",
                "phone": "909***0000",
                "business": "business name",
                "website": "www.test.com",
                "message": "this is lorem ipsum",
                "image": "PATH/1700675400_user6-128x128.jpg",
                "id": 3
            }
        }
     *
     * @response 500
     *  {
            "status": false,
            "status_code": 500,
            "message": "Oops, something went wrong...",
            "data": []
       }
     * 
     *
     */
    
    
    
    
    public function createAdvertiseWithUs(Request $request)
    {
        $all = $request->all();
        $response = $this->advertiseLib->advertiseWithUsCreate($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    
    
   



}
