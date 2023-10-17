<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\CommonLibrary;
use App\Http\Controllers\Api\V1\BaseController;

/**
 * @group SubscribeNewsletter Related
 *
 * APIs for managing all Search related listing
 */


class SubscribeNewsLetterController extends BaseController
{
    public function __construct()
    {
        $this->num_of_day                       = 1;
        $this->to_day                           = date('d-m-Y');
        
        
        $this->code                             = 'status_code';
        $this->status                           = 'status';
        $this->result                           = 'result';
        $this->message                          = 'message';
        $this->data                             = 'data';
        $this->total                            = 'total_count';
        $this->commonLib                        = new CommonLibrary();
        
        
    }

    
      
    /**
     * subscribeNewsLetter
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     *
     * EX
     *  {
            "email_id":"you@domain.com"
        }
     *
     * <aside class="notice">basepath/api/v1/subscribe-us</aside>
     * @method POST
     * @bodyParam *email_id integer required Example: 1,2,3 in JSON BODY
     
     * @return \Illuminate\Http\Response
     *
     * @response 200
     * {
            "status": true,
            "status_code": 200,
            "message": "Successfully Subscribed...",
            "data": []
        }
     *
     *
     *
     * @response 500
     *  {
            "status": false,
            "status_code": 500,
            "message": "Oops, something went wrong...",
            "data": []
     *  }
     * 
     *
     */
    
    
    
    
    public function subscribeNewsLetter(Request $request)
    {
        $all = $request->all();
        $response = $this->commonLib->newsLetterSubscribe($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    
      
    

    
    


}
