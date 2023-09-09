<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\NationaEventLibrary;
use App\Http\Controllers\Api\V1\BaseController;

/**
 * @group Business Listing Related
 *
 * APIs for managing all Business listing related Category,  sub category
 */


class NationalEventController extends BaseController
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
        $this->eventLib                         = new NationaEventLibrary();
        
        
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
     * <aside class="notice">basepath/api/v1/get-all-events-category</aside>
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
                    "id": 5,
                    "name": "Movie",
                    "slug": "movie",
                    "color": "#F7EDED",
                    "created_at": "04-Sep-2023 04:45 PM"
                },
                {
                    "id": 4,
                    "name": "Cultural",
                    "slug": "cultural",
                    "color": "#240808",
                    "created_at": "04-Sep-2023 04:44 PM"
                },
                {
                    "id": 3,
                    "name": "Religious",
                    "slug": "religious",
                    "color": "#E3D4D4",
                    "created_at": "04-Sep-2023 04:44 PM"
                },
                {
                    "id": 2,
                    "name": "Community",
                    "slug": "community",
                    "color": "#DD3636",
                    "created_at": "04-Sep-2023 04:44 PM"
                },
                {
                    "id": 1,
                    "name": "Personal",
                    "slug": "personal",
                    "color": "#E9C7C7",
                    "created_at": "04-Sep-2023 04:37 PM"
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
        // $all = $request->all();
        $response = $this->eventLib->allCategoryGet();

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    


     
   
      
    /**
     * getEventListByCat
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
     * <aside class="notice">basepath/api/v1/get-business-list-by-category</aside>
     * @return \Illuminate\Http\Response
     * 
     *
     * @response 200
     *  {
            "status": true,
            "status_code": 200,
            "message": "Successfully data list found..",
            "data": [
                {
                    "id": 5,
                    "name": "Movie",
                    "slug": "movie",
                    "color": "#F7EDED",
                    "created_at": "04-Sep-2023 04:45 PM",
                    "category_data": []
                },
                {
                    "id": 3,
                    "name": "Religious",
                    "slug": "religious",
                    "color": "#E3D4D4",
                    "created_at": "04-Sep-2023 04:44 PM",
                    "category_data": [
                        {
                            "id": 2,
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
                            "city_id": {
                                "id": 1,
                                "name": "New City",
                                "state_code": "AL"
                            },
                            "cat_id": 3,
                            "title": "Boosting Level",
                            "title_slug": "boosting-level",
                            "image": "http://localhost/upload/image-data/EVENTS_IMG/1694082997__turing.png",
                            "url": "https://www.youtube.com/watch?v=L_nN1P297N0&t=19s",
                            "address": "addresssssss",
                            "start_date": "2023-09-07",
                            "end_date": "2023-09-07",
                            "details": "detaoils of newwwwww",
                            "meta_title": "meta titlleeeeeeee",
                            "meta_description": "meta descriptionnnnnnnn",
                            "meta_keywords": "meta keyworddddddddd",
                            "other_details": "other inforrrrrr",
                            "total_views": 0,
                            "created_at": "07-Sep-2023 05:00 PM"
                        }
                    ]
                },
                {
                    "id": 2,
                    "name": "Community",
                    "slug": "community",
                    "color": "#DD3636",
                    "created_at": "04-Sep-2023 04:44 PM",
                    "category_data": []
                },
                {
                    "id": 1,
                    "name": "Personal",
                    "slug": "personal",
                    "color": "#E9C7C7",
                    "created_at": "04-Sep-2023 04:37 PM",
                    "category_data": [
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
                            "city_id": {
                                "id": 1,
                                "name": "New City",
                                "state_code": "AL"
                            },
                            "cat_id": 1,
                            "title": "This is new title",
                            "title_slug": "this-is-new-title",
                            "image": "http://localhost/upload/image-data/EVENTS_IMG/1694082841__turing.png",
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
    
    
    
    
    public function getEventListByCat(Request $request)
    {
        $all = $request->all();
        $response = $this->eventLib->eventListingByCategoryGet($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    
    





     
    /**
     * getAllEventListByCategoryId
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
     * <aside class="notice">basepath/api/v1/get-all-events-list-by-category-id</aside>
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
    
    
    
    
    public function getAllEventListByCategoryId(Request $request)
    {
        $all = $request->all();
        $response = $this->eventLib->allEventListingByCategoryGet($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
   
      
    /**
     * geteventById
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * EX
     *  {
            "country_id":1,
            "state_id":1,
            "event_id":1
     *  }
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * @method POST
     * @bodyParam *country_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *state_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *event_id integer required Example: 1,2,3 in JSON BODY
     *
     * <aside class="notice">basepath/api/v1/get-business-by-id</aside>
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
                "city_id": 1,
                "cat_id": 1,
                "title": "Title",
                "title_slug": "title",
                "image": "PATH/EVENTS_IMG/1694262538_Screenshot_from_2023-08-02_15-19-33.png",
                "url": "https://www.youtube.com/watch?v=L_nN1P297N0&t=19s",
                "address": "address",
                "start_date": "2023-09-09",
                "end_date": "2023-09-09",
                "details": "detauils",
                "meta_title": "meta title",
                "meta_description": "meta desc",
                "meta_keywords": "meta keyword",
                "other_details": "oitehr detail",
                "total_views": 0,
                "created_at": "09-Sep-2023 05:58 PM",
                "comments": [
                    {
                        "id": 2,
                        "user_id": 2,
                        "event_list_id": 1,
                        "country_id": 1,
                        "state_id": 1,
                        "comment": "Nice....",
                        "created_at": "09-Sep-2023 06:28 PM",
                        "user": {
                            "id": 2,
                            "first_name": "Md Saddam",
                            "last_name": "Hussain",
                            "email": "mdsaddamhussain595@gmail.com",
                            "dob": "2023-02-02",
                            "mobile": "9899899854"
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
    
    
    
    
    public function geteventById(Request $request)
    {
        $all = $request->all();
        $response = $this->eventLib->eventListingByIdGet($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    
    
    
   
      
    /**
    * reviewEventList
    * 
    * If everything is okay, you'll get a `200` OK response with data.
    *
    * EX
    *  {
            "user_id":1,
            "business_list_id":1,
            "country_id":1,
            "state_id":1,
            "comment":"Nice.......",
    *  }
    * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
    * @method POST
    * @authenticated
    * @header      Authorization Bearer _token required  
    * @bodyParam *user_id integer required Example: 1,2,3 in JSON BODY
    * @bodyParam *event_id integer required Example: 1,2,3 in JSON BODY
    * @bodyParam *country_id integer required Example: 1,2,3 in JSON BODY
    * @bodyParam *state_id integer required Example: 1,2,3 in JSON BODY
    * @bodyParam *comment string Example: This is good 5in JSON BODY
    *
    * <aside class="notice">basepath/api/v1/comment-event-list</aside>
    * @return \Illuminate\Http\Response
    * 
    *
    * @response 200
    *  
    *{
        "status": true,
        "status_code": 200,
        "message": "Successfully comment done...",
        "data": {
            "user_id": 2,
            "event_list_id": 1,
            "country_id": 1,
            "state_id": 1,
            "comment": "Nice....",
            "created_at": "09-Sep-2023 06:28 PM",
            "id": 2
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
    
    
    
    
    public function commentEventList(Request $request)
    {
        $all = $request->all();
        $response = $this->eventLib->commentEventListing($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    
    


    
    


}
