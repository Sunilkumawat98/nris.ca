<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\CarpoolLibrary;
use App\Http\Controllers\Api\V1\BaseController;

/**
 * @group Pool & Cab Related
 *
 * APIs for managing all Pool & Cab listing related Category,  and comments
 */


class CarPoolController extends BaseController
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
        $this->carpoolLib                       = new CarpoolLibrary();
        
        
    }
    
      
    /**
     * getAllCategory
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     * 
     *
     * <aside class="notice">basepath/api/v1/get-all-carpool-category</aside>
     * @method GET
     * @return \Illuminate\Http\Response
     *
     * @response 200
     *  {
            "status": true,
            "status_code": 200,
            "message": "Successfully your list found..",
            "data": [
                {
                    "id": 3,
                    "name": "Intersnational"
                },
                {
                    "id": 2,
                    "name": "Interstate"
                },
                {
                    "id": 1,
                    "name": "Local"
                }
            ]
        }
     *
     *
     * @response 404
     *  {
            "status": false,
            "status_code": 404,
            "message": "List not found...",
            "data": []
     *  }
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
    
    
    
    
    public function getAllCategory()
    {
        $response = $this->carpoolLib->allCategoryGet();

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    


      




      
    /**
    * createCarpool
    * 
    * If everything is okay, you'll get a `200` OK response with data.
    *
    * EX
    *  {
            "user_id":2,
            "category_id":1,
            "from_country_id":1,
            "to_country_id":null,
            "from_state_id": null,
            "to_state_id": null,
            "from_city_id": null,
            "to_city_id": null,
            "category_id": 1,
            "user_id": 2,
            "journey_type": "twoway",
            "contact_name": "test",
            "contact_email": "test@test.com",
            "contact_number": "9876543211",
            "contact_address": "M test address",
            "start_date": "2023-11-12",
            "end_date": "2023-11-25",
            "start_time": "15:12",
            "end_time": "15:00",
            "flex_date": "no",
            "flex_time": "no",
            "flex_location": "no",
        }
    * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
    * @method POST
    * @authenticated
    * @header      Authorization Bearer _token required  

    * @bodyParam from_country_id integer  Example: 1,2,3 in JSON BODY
    * @bodyParam to_country_id integer  Example: 1,2,3 in JSON BODY
    * @bodyParam from_state_id integer  Example: 1,2,3 in JSON BODY
    * @bodyParam to_state_id integer  Example: 1,2,3 in JSON BODY
    * @bodyParam from_city_id integer  Example: 1,2,3 in JSON BODY
    * @bodyParam to_city_id integer  Example: 1,2,3 in JSON BODY
    * @bodyParam *user_id integer required Example: 1,2,3 in JSON BODY
    * @bodyParam *category_id integer required Example: 1,2,3 in JSON BODY
    * @bodyParam *journey_type enum('oneway'/'twoway') require Example: no in JSON BODY
    * @bodyParam *contact_name string require Example: Abc in JSON BODY
    * @bodyParam *contact_email string require Example: you@domain.com in JSON BODY
    * @bodyParam *contact_number integet require Example: 9999****99 in JSON BODY
    * @bodyParam *contact_address string require Example: This is address in JSON BODY
    * @bodyParam *start_date date require Example: (2023-11-12) YYYY-MM-DD in JSON BODY
    * @bodyParam end_date date  Example: (2023-11-12) YYYY-MM-DD in JSON BODY
    * @bodyParam *start_time time require Example: 20:10 in JSON BODY
    * @bodyParam end_time time Example: 20:10 in JSON BODY
    * @bodyParam *flex_date enum('yes'/'no') require Example: no in JSON BODY
    * @bodyParam *flex_time enum('yes'/'no') require Example: no in JSON BODY
    * @bodyParam *flex_location enum('yes'/'no') require Example: no in JSON BODY
    
    *
    * <aside class="notice">basepath/api/v1/review-business-list</aside>

    
    * @return \Illuminate\Http\Response
    * 
    *
    * @response 200
    * {
            "status": true,
            "status_code": 200,
            "message": "Successfully data submitted...",
            "data": {
                "from_country_id": null,
                "to_country_id": null,
                "from_state_id": null,
                "to_state_id": null,
                "from_city_id": null,
                "to_city_id": null,
                "cat_id": 1,
                "user_id": 2,
                "journey_type": "twoway",
                "contact_name": "test",
                "contact_email": "test@test.com",
                "contact_number": "9876543211",
                "contact_address": "M test address",
                "start_date": "2023-11-12",
                "end_date": "2023-11-25",
                "start_time": "15:12",
                "end_time": "15:00",
                "flex_date": "no",
                "flex_time": "no",
                "flex_location": "no",
                "created_at": "27-Nov-2023 04:05 PM",
                "id": 6
            }
        }
    *
    *
    *
    * @response 401
    *  {
            "message": "Token is Invalid",
            "status_code": 401,
            "status": false
        }
    *
    *
    * @response 419
    *  {
            "message": "Token is Expired",
            "status_code": 419,
            "status": false
        }
    *
    *
    *
    * @response 403
    *  {
            "message": "Authorised Token Not Found",
            "status_code": 403,
            "status": false
        }
       
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
    
    
    
    
    public function createCarpool(Request $request)
    {
        $all = $request->all();
        $response = $this->carpoolLib->carpoolCreate($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    
    



      
    /**
    * commentCarpool
    * 
    * If everything is okay, you'll get a `200` OK response with data.
    *
    * EX
    *  {
            "user_id":2,
            "carpool_id":1,
            "comment":"this is comment"
        }
    * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
    * @method POST
    * @authenticated
    * @header      Authorization Bearer _token required  
    * @bodyParam *user_id integer required Example: 1,2,3 in JSON BODY
    * @bodyParam *carpool_id integer required Example: 1,2,3 in JSON BODY
    * @bodyParam *comment string require Example: This is comment in JSON BODY
    *
    * <aside class="notice">basepath/api/v1/comment-carpool</aside>
    * @return \Illuminate\Http\Response
    * 
    *
    * @response 200
    * {
        "status": true,
        "status_code": 200,
        "message": "Successfully comment done...",
        "data": {
            "user_id": 2,
            "carpool_id": 2,
            "comment": "this is test comment",
            "created_at": "27-Nov-2023 04:46 PM",
            "id": 4
        }
    }
    *
    *
    *
    * @response 401
    *  {
            "message": "Token is Invalid",
            "status_code": 401,
            "status": false
        }
    *
    *
    * @response 419
    *  {
            "message": "Token is Expired",
            "status_code": 419,
            "status": false
        }
    *
    *
    *
    * @response 403
    *  {
            "message": "Authorised Token Not Found",
            "status_code": 403,
            "status": false
        }
       
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
    
    
    
    
    public function commentCarpool(Request $request)
    {
        $all = $request->all();
        $response = $this->carpoolLib->carpoolCommentCreate($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    
    


    
    
   



     
    /**
     * getAllCarpoolListByCategoryId
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * EX
     *  {
            
            "category_id":1,
     *  }
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * @method POST
     * @bodyParam *category_id integer required Example: 1,2,3 in JSON BODY
     *
     * <aside class="notice">basepath/api/v1/get-all-carpool-list-by-category-id</aside>
     * @return \Illuminate\Http\Response
     * 
     *
     * @response 200
     * {
            "status": true,
            "status_code": 200,
            "message": "Successfully data list found..",
            "data": {
                "current_page": 1,
                "data": [
                    {
                        "id": 4,
                        "from_country_id": null,
                        "to_country_id": null,
                        "from_state_id": null,
                        "to_state_id": null,
                        "from_city_id": 1,
                        "to_city_id": 2,
                        "journey_type": "twoway",
                        "contact_name": "test",
                        "contact_email": "test@test.com",
                        "contact_number": "9876543211",
                        "contact_address": "M test address",
                        "start_date": "2023-11-12",
                        "end_date": "2023-11-25",
                        "start_time": "15:12",
                        "end_time": "15:00",
                        "flex_date": "no",
                        "flex_time": "no",
                        "flex_location": "no",
                        "total_views": 0,
                        "category": {
                            "id": 1,
                            "name": "Local"
                        }
                    },
                    {
                        "id": 3,
                        "from_country_id": null,
                        "to_country_id": null,
                        "from_state_id": null,
                        "to_state_id": null,
                        "from_city_id": 4,
                        "to_city_id": 6,
                        "journey_type": "oneway",
                        "contact_name": "test",
                        "contact_email": "test@test.com",
                        "contact_number": "9876543211",
                        "contact_address": "M test address",
                        "start_date": "2023-11-12",
                        "end_date": null,
                        "start_time": "15:12",
                        "end_time": null,
                        "flex_date": "no",
                        "flex_time": "no",
                        "flex_location": "no",
                        "total_views": 0,
                        "category": {
                            "id": 1,
                            "name": "Local"
                        }
                    }
                ],
                "first_page_url": "PATH/get-all-carpool-list-by-category-id?page=1",
                "from": 1,
                "next_page_url": null,
                "path": "PATH/get-all-carpool-list-by-category-id",
                "per_page": 10,
                "prev_page_url": null,
                "to": 3
            }
        } 
     * 
     *
     * @response 404
     *  {
            "status": false,
            "status_code": 404,
            "message": "List not found...",
            "data": []
     *  }
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
    
    
    
    
     public function getAllCarpoolListByCategoryId(Request $request)
     {
         $all = $request->all();
         $response = $this->carpoolLib->allCarpoolByCategoryGet($all);
 
         if (!$response[$this->status]) {
             return $this->sendError($response[$this->message], $response[$this->code]);
         }
         
         return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
     }
   



      
    /**
     * getCarpoolById
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * EX
     *  {
            "carpool_id":1
     *  }
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * @method POST
     * @bodyParam *carpool_id integer required Example: 1,2,3 in JSON BODY
     *
     * <aside class="notice">basepath/api/v1/get-carpool-by-id</aside>
     * @return \Illuminate\Http\Response
     * 
     *
     * @response 200
     * {
            "status": true,
            "status_code": 200,
            "message": "Successfully data list found..",
            "data": {
                "id": 2,
                "from_country_id": null,
                "to_country_id": null,
                "from_state_id": null,
                "to_state_id": null,
                "from_city_id": null,
                "to_city_id": null,
                "journey_type": "oneway",
                "contact_name": "test",
                "contact_email": "test@test.com",
                "contact_number": "9876543211",
                "contact_address": "M test address",
                "start_date": "2023-11-12",
                "end_date": null,
                "start_time": "15:12",
                "end_time": null,
                "flex_date": "no",
                "flex_time": "no",
                "flex_location": "no",
                "total_views": 0,
                "created_at": "27-Nov-2023 03:57 PM",
                "category": {
                    "id": 1,
                    "name": "Local"
                },
                "comments": [
                    {
                        "id": 4,
                        "carpool_id": 2,
                        "user_id": 2,
                        "comment": "this is test comment",
                        "user": {
                            "id": 2,
                            "first_name": "ABC"
                        }
                    },
                    {
                        "id": 5,
                        "carpool_id": 2,
                        "user_id": 2,
                        "comment": "this is test comment",
                        "user": {
                            "id": 21,
                            "first_name": "XYZ"
                        }
                    }
                ]
            }
        }
     *
     *
     * @response 404
     *  {
            "status": false,
            "status_code": 404,
            "message": "List not found...",
            "data": []
     *  }
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
    
    
     
    
    public function getCarpoolById(Request $request)
    {
        $all = $request->all();
        $response = $this->carpoolLib->carpoolByIdGet($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    
    
    
   


    
    


}
