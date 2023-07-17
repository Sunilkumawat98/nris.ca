<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Http\Exceptions\HttpResponseException;
use Log;

class BaseController extends Controller
{


    public function __construct()
    {   
        $this->code                     = 'status_code';
        $this->status                   = 'status';
        $this->result                   = 'result';
        $this->message                  = 'message';
        $this->data                     = 'data';
        $this->total                    = 'total_count';
        
        
    }



    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($data, $message, $code)
    {
    	$response = [
            $this->status => true,
            $this->code => $code,
            $this->message => $message,                
            $this->data    => $data
        ];
        $status_code = 200;
        if(!empty($status_code)){
            $response['status_code'] = $status_code;
        }
        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $code)
    {
    	$response = [
            'status' => false,
            'status_code' => $code,
            'message' => $error,
            'data' => []
        ];
//        Log::info(json_encode($response));
        return response()->json($response);
    }
    public function throwValidationException($errorMessages)
    {
        // $response = [           
        //     'status' => 'failed',
        //     'message' => 'Validatoin Failed',
        // ];
        // $response['error'] = $errorMessages['error'];
        throw new HttpResponseException(response()->json($errorMessages, 200));        
    }
}