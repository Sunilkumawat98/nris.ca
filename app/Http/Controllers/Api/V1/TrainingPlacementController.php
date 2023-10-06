<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\TrainingPlacementLibrary;
use App\Http\Controllers\Api\V1\BaseController;

/**
 * @group Training & Placement Related 
 *
 * APIs for managing all Training & Placement related listing and its Category
 */


class TrainingPlacementController extends BaseController
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
        $this->traningLib                         = new TrainingPlacementLibrary();
        
        
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
     * <aside class="notice">basepath/api/v1/get-all-training-category</aside>
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
                    "id": 2,
                    "name": "Oracle",
                    "slug": "oracle",
                    "created_at": "28-Sep-2023 05:37 PM"
                },
                {
                    "id": 1,
                    "name": "Java",
                    "slug": "java",
                    "created_at": "28-Sep-2023 05:27 PM"
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
        $response = $this->traningLib->allCategoryGet();

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    


     
   
      
    /**
     * getTraningPlacementListByCat
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * EX
     *  {
            "country_id":1
     *  }
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * @method POST
     * @bodyParam *country_id integer required Example: 1,2,3 in JSON BODY
     *
     * <aside class="notice">basepath/api/v1/get-training-list-by-category</aside>
     * @return \Illuminate\Http\Response
     * 
     *
     * @response 200
     * {
            "status": true,
            "status_code": 200,
            "message": "Successfully data list found..",
            "data": [
                {
                    "id": 2,
                    "name": "Oracle",
                    "slug": "oracle",
                    "created_at": "28-Sep-2023 05:37 PM",
                    "category_data": []
                },
                {
                    "id": 1,
                    "name": "Java",
                    "slug": "java",
                    "created_at": "28-Sep-2023 05:27 PM",
                    "category_data": [
                        {
                            "id": 2,
                            "country_id": 1,
                            "state_id": {
                                "id": 3,
                                "name": "Alabama",
                                "code": "AL",
                                "domain": "alabama",
                                "description": "alabama",
                                "logo": "NA",
                                "s_meta_title": "meta",
                                "s_meta_description": "desc",
                                "s_meta_keywords": "key",
                                "header_image": "NULL",
                                "header_image2": "NULL",
                                "header_image3": "NULL"
                            },
                            "cat_id": 1,
                            "user_id": null,
                            "admin_id": 1,
                            "title": "title",
                            "slug": "title",
                            "description": null,
                            "image": "PATH/1695983823.png",
                            "expire_at": "2023-09-27",
                            "total_views": null,
                            "created_at": "29-Sep-2023 04:23 PM"
                        },
                        {
                            "id": 1,
                            "country_id": 1,
                            "state_id": {
                                "id": 1,
                                "name": "Alaska",
                                "code": "AL",
                                "domain": "alaska",
                                "description": "AL desc",
                                "logo": "NA",
                                "s_meta_title": "Al title",
                                "s_meta_description": "AL META",
                                "s_meta_keywords": "AL key",
                                "header_image": "NULL",
                                "header_image2": "NULL",
                                "header_image3": "NULL"
                            },
                            "cat_id": 1,
                            "user_id": null,
                            "admin_id": null,
                            "title": "Boosting Level",
                            "slug": "boosting-level",
                            "description": null,
                            "image": "PATH/1695982951_Stone.png",
                            "expire_at": "2023-10-05",
                            "total_views": null,
                            "created_at": "29-Sep-2023 03:52 PM"
                        }
                    ]
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
    
    
    
    
    public function getTraningPlacementListByCat(Request $request)
    {
        $all = $request->all();
        $response = $this->traningLib->trainingPlacementListingByCategoryGet($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    
    





     
    /**
     * getAllTrainingPlacementListByCategoryId
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * EX
     *  {
            "country_id":1,
            "state_id":1,
            "category_id":1,
     *  }
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * @method POST
     * @bodyParam *country_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *state_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *category_id integer required Example: 1,2,3 in JSON BODY
     *
     * <aside class="notice">basepath/api/v1/get-all-training-list-by-category-id</aside>
     * @return \Illuminate\Http\Response
     * 
     *
     * @response 200
     *  
     *{
            "status": true,
            "status_code": 200,
            "message": "Successfully data list found..",
            "data": {
                "current_page": 1,
                "data": [
                    {
                        "id": 1,
                        "country_id": 1,
                        "state_id": 1,
                        "city_id": 1,
                        "cat_id": 1,
                        "title": "This is new title",
                        "title_slug": "this-is-new-title",
                        "image": "PATH/EVENTS_IMG/1694082841__turing.png",
                        "url": "https://www.youtube.com/watch?v=L_nN1P297N0&t=19s",
                        "address": "this is address",
                        "start_date": "2023-09-07",
                        "end_date": "2023-09-07",
                        "details": "this is details",
                        "meta_title": "meta title",
                        "meta_description": "mata desc",
                        "meta_keywords": "meta key",
                        "other_details": "this is other infor",
                        "total_views": 0,
                        "created_at": "07-Sep-2023 04:04 PM"
                    }
                ],
                "first_page_url": "PATH/api/v1/get-all-events-list-by-category-id?page=1",
                "from": 1,
                "next_page_url": null,
                "path": "PATH/api/v1/get-all-events-list-by-category-id",
                "per_page": 10,
                "prev_page_url": null,
                "to": 1
            }
        }
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
    
    
    
    
    public function getAllTrainingPlacementListByCategoryId(Request $request)
    {
        $all = $request->all();
        $response = $this->traningLib->allTrainingPlacementListingByCategoryGet($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
   
      
    /**
     * getTrainingPlacementById
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * EX
     *  {
            "country_id":1,
            "state_id":1,
            "training_id":1
     *  }
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * @method POST
     * @bodyParam *country_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *state_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *training_id integer required Example: 1,2,3 in JSON BODY
     *
     * <aside class="notice">basepath/api/v1/get-training-by-id</aside>
     * @return \Illuminate\Http\Response
     * 
     *
     * @response 200
     *  {
            "status": true,
            "status_code": 200,
            "message": "Successfully data list found..",
            "data": {
                "id": 1,
                "country_id": 1,
                "state_id": 1,
                "cat_id": 1,
                "user_id": null,
                "admin_id": 1,
                "title": "Java training",
                "slug": "java-training",
                "description": null,
                "image": "PATH/1695982951_Stone.png",
                "expire_at": "2023-10-05",
                "total_views": null,
                "created_at": "03-Oct-2023 04:08 PM",
                "comments": [
                    {
                        "id": 1,
                        "user_id": 6,
                        "training_list_id": 1,
                        "country_id": 1,
                        "state_id": 1,
                        "comment": "mast",
                        "created_at": null,
                        "user": {
                            "id": 6,
                            "first_name": "Grant Renner",
                            "last_name": "Abelardo Konopelski Sr.",
                            "email": "spredovic@example.org",
                            "dob": "2023-08-31",
                            "mobile": "7702298725"
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
    
    
    
    
    public function getTrainingPlacementById(Request $request)
    {
        $all = $request->all();
        $response = $this->traningLib->trainingPlacementListingByIdGet($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    
    
    
   
      
    /**
    * commentTrainingList
    * 
    * If everything is okay, you'll get a `200` OK response with data.
    *
    * EX
    *  {
            "user_id":1,
            "training_id":1,
            "country_id":1,
            "state_id":1,
            "comment":"Nice.......",
    *  }
    * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
    * @method POST
    * @authenticated
    * @header      Authorization Bearer _token required  
    * @bodyParam *user_id integer required Example: 1,2,3 in JSON BODY
    * @bodyParam *training_id integer required Example: 1,2,3 in JSON BODY
    * @bodyParam *country_id integer required Example: 1,2,3 in JSON BODY
    * @bodyParam *state_id integer required Example: 1,2,3 in JSON BODY
    * @bodyParam *comment string Example: This is good 5in JSON BODY
    *
    * <aside class="notice">basepath/api/v1/comment-training-list</aside>
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
                "training_list_id": 1,
                "country_id": 1,
                "state_id": 1,
                "comment": "this is nice",
                "created_at": "05-Oct-2023 02:20 PM",
                "id": 3
            }
        }
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
    
    
    
    
    public function commentTrainingList(Request $request)
    {
        $all = $request->all();
        $response = $this->traningLib->commentTrainingListing($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    
    

   
      
    /**
    * getTrainingListByUserId
    * 
    * If everything is okay, you'll get a `200` OK response with data.
    *
    * EX
    *  {
            "user_id":1
    *  }
    * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
    * @method POST
    * @authenticated
    * @header      Authorization Bearer _token required  
    * @bodyParam *user_id integer required Example: 1,2,3 in JSON BODY
    *
    * <aside class="notice">basepath/api/v1/get-training-list-by-user-id</aside>
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
                    "id": 1,
                    "country_id": 1,
                    "state_id": 1,
                    "cat_id": {
                        "id": 1,
                        "name": "Java",
                        "slug": "java",
                        "created_at": "28-Sep-2023 05:27 PM"
                    },
                    "user_id": 2,
                    "admin_id": null,
                    "title": "Java training",
                    "slug": "java-training",
                    "description": null,
                    "image": "PATH/1695982951_Stone.png",
                    "expire_at": "2023-10-05",
                    "total_views": null,
                    "created_at": "03-Oct-2023 04:08 PM"
                }
            ],
            "first_page_url": "PATH/api/v1/get-training-list-by-user-id?page=1",
            "from": 1,
            "next_page_url": null,
            "path": "PATH/api/v1/get-training-list-by-user-id",
            "per_page": 10,
            "prev_page_url": null,
            "to": 1
        }
    }
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
    
    
    
    
    public function getTrainingListByUserId(Request $request)
    {
        $all = $request->all();
        $response = $this->traningLib->trainingListGetByUserId($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    
    


    
    


}
