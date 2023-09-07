<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\BusinessListingLibrary;
use App\Http\Controllers\Api\V1\BaseController;

/**
 * @group Business Listing Related
 *
 * APIs for managing all Business listing related Category,  sub category
 */


class BusinessListingController extends BaseController
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
        $this->businessListLib                  = new BusinessListingLibrary();
        
        
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
     * <aside class="notice">basepath/api/v1/get-all-business-category</aside>
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
                    "name": "Resturant",
                    "slug": "resturant",
                    "icon": "PATH/1693300257_WhatsApp_Image_2023-08-29_at_9.46.17_AM.jpeg",
                    "color": "#652F2F",
                    "created_at": "21-Aug-2023 01:53 PM"
                },
                {
                    "id": 1,
                    "name": "Casino",
                    "slug": "casino",
                    "icon": "PATH/1987654357_2023-08-29_at_9.46.17_AM.jpeg",
                    "color": "#654F4F",
                    "created_at": "21-Aug-2023 01:59 PM"
                }
            ]
     *  }
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
        $response = $this->businessListLib->allCategoryGet();

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    


      
    /**
     * getAllSubCategory
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     * 
     *
     * <aside class="notice">basepath/api/v1/gget-all-business-sub-category</aside>
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
                    "category_id": 1,
                    "name": "Halal resturants",
                    "slug": "halal-resturants",
                    "color": "#908989",
                    "created_at": "23-Aug-2023 09:19 AM"
                },
                {
                    "id": 2,
                    "category_id": 1,
                    "name": "halal cuisine of india 1",
                    "slug": "halal-cuisine-of-india-1",
                    "color": "#9FF989",
                    "created_at": "23-Aug-2023 09:30 AM"
                }
            ]
        }

     *  }
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
    
    
    
    
    public function getAllSubCategory()
    {
        $response = $this->businessListLib->allSubCategoryGet();

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    


      
    /**
     * getAllSubCategoryById
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     * 
     *
     * <aside class="notice">basepath/api/v1/get-all-business-sub-category-by-id</aside>
     * @method POST
     * @bodyParam *category_id integer required Example: 1,2,3 in JSON BODY
     * @return \Illuminate\Http\Response
     *
     * @response 200
     *  {
            "status": true,
            "status_code": 200,
            "message": "Successfully your list found..",
            "data": [
                {
                    "id": 1,
                    "category_id": 1,
                    "name": "Audis",
                    "slug": "audis",
                    "color": "#846A6A",
                    "created_at": "28-Jul-2023 07:03 AM"
                }
            ]
     *  }
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
    
    
    
    
    public function getAllSubCategoryById(Request $request)
    {
        $all = $request->all();
        $response = $this->businessListLib->allCategoryByIdGet($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    



    
    
   
      
    /**
     * getBusinessListByCat
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
                    "id": 2,
                    "name": "Temple",
                    "slug": "temple",
                    "icon": "PATH/1693300257_WhatsApp_Image_2023-08-29_at_9.46.17_AM.jpeg",
                    "color": "#DD9595",
                    "created_at": "29-Aug-2023 02:23 PM",
                    "category_data": []
                },
                {
                    "id": 1,
                    "name": "Resturants",
                    "slug": "resturants",
                    "icon": "PATH/1693306855_food.180746ff7fac730c1893528fcac8f3e2.svg",
                    "color": "#652F2F",
                    "created_at": "21-Aug-2023 01:53 PM",
                    "category_data": [
                        {
                            "id": 5,
                            "country_id": 1,
                            "state_id": 1,
                            "cat_id": 1,
                            "sub_cat_id": null,
                            "name": "Sultan's",
                            "name_slug": "sultans",
                            "image": "PATH/1693308422_mailnris.png",
                            "contact_name": "saddam hussain",
                            "contact_email": "saddam@gmail.com",
                            "contact_number": "898989899",
                            "contact_address": "complete address",
                            "meta_title": "title wala meta",
                            "meta_description": "desction of meta",
                            "meta_keywords": "keyyyyy",
                            "other_details": "otehr ifno",
                            "total_views": 0,
                            "created_at": "29-Aug-2023 04:57 PM"
                        },
                        {
                            "id": 4,
                            "country_id": 1,
                            "state_id": 1,
                            "cat_id": 1,
                            "sub_cat_id": null,
                            "name": "Curry Masala",
                            "name_slug": "curry-masala",
                            "image": "PATH/1693308319_videoJs.png",
                            "contact_name": "saddam hussain",
                            "contact_email": "saddam@gmail.com",
                            "contact_number": "898989899",
                            "contact_address": "adress complete",
                            "meta_title": "meta title",
                            "meta_description": "meta desc",
                            "meta_keywords": "meta key",
                            "other_details": "otehrinfo",
                            "total_views": 0,
                            "created_at": "29-Aug-2023 04:55 PM"
                        },
                        {
                            "id": 3,
                            "country_id": 1,
                            "state_id": 1,
                            "cat_id": 1,
                            "sub_cat_id": null,
                            "name": "China King Buffet",
                            "name_slug": "china-king-buffet",
                            "image": "PATH/1693307771__turing.png",
                            "contact_name": "saddam hussain",
                            "contact_email": "saddam@gmail.com",
                            "contact_number": "898989899",
                            "contact_address": "Address",
                            "meta_title": "meta",
                            "meta_description": "desc",
                            "meta_keywords": "keyword",
                            "other_details": "info",
                            "total_views": 0,
                            "created_at": "29-Aug-2023 04:46 PM"
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
    
    
    
    
    public function getBusinessListByCat(Request $request)
    {
        $all = $request->all();
        $response = $this->businessListLib->businessListingByCategoryGet($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    
    





     
    /**
     * getAllBusinessListByCategoryId
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
     * <aside class="notice">basepath/api/v1/get-business-list-by-category</aside>
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
                        "cat_id": 1,
                        "sub_cat_id": 1,
                        "name": "Halal chiken shop",
                        "name_slug": "halal-chiken-shop",
                        "image": "PATH/1693550779__turing.png",
                        "contact_name": "saddam hussain",
                        "contact_email": "saddam@gmail.com",
                        "contact_number": "898989899",
                        "contact_address": "Address",
                        "meta_title": "meta title",
                        "meta_description": "meta desc",
                        "meta_keywords": "meta key",
                        "other_details": "other info",
                        "total_views": 0,
                        "created_at": "01-Sep-2023 12:16 PM"
                    }
                ],
                "first_page_url": "PATH/api/v1/get-all-business-list-by-category-id?page=1",
                "from": 1,
                "next_page_url": null,
                "path": "PATH/api/v1/get-all-business-list-by-category-id",
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
    
    
    
    
     public function getAllBusinessListByCategoryId(Request $request)
     {
         $all = $request->all();
         $response = $this->businessListLib->allBusinessListingByCategoryGet($all);
 
         if (!$response[$this->status]) {
             return $this->sendError($response[$this->message], $response[$this->code]);
         }
         
         return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
     }
   
      
    /**
     * getBusinessById
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * EX
     *  {
            "country_id":1,
            "state_id":1,
            "business_list_id":1
     *  }
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * @method POST
     * @bodyParam *country_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *state_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *business_list_id integer required Example: 1,2,3 in JSON BODY
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
                "listing": {
                    "id": 1,
                    "country_id": 1,
                    "state_id": 1,
                    "cat_id": 1,
                    "sub_cat_id": 1,
                    "name": "Halal chiken shop",
                    "name_slug": "halal-chiken-shop",
                    "image": "PATH/1693550779__turing.png",
                    "contact_name": "saddam hussain",
                    "contact_email": "saddam@gmail.com",
                    "contact_number": "898989899",
                    "contact_address": "Address",
                    "meta_title": "meta title",
                    "meta_description": "meta desc",
                    "meta_keywords": "meta key",
                    "other_details": "other info",
                    "total_views": 0,
                    "created_at": "01-Sep-2023 12:16 PM",
                    "total_rating": 8,
                    "total_comments": 6,
                    "reviews": [
                        {
                            "id": 4,
                            "user_id": 2,
                            "business_list_id": 1,
                            "country_id": 1,
                            "state_id": 1,
                            "rating": 1,
                            "comment": "Nice.......",
                            "created_at": "01-Sep-2023 12:18 PM",
                            "name": "User 2"
                        },
                        {
                            "id": 5,
                            "user_id": 6,
                            "business_list_id": 1,
                            "country_id": 1,
                            "state_id": 1,
                            "rating": 5,
                            "comment": "Awesome resturants.......",
                            "created_at": "01-Sep-2023 12:18 PM",
                            "name": "User 6"
                        },
                        {
                            "id": 6,
                            "user_id": 17,
                            "business_list_id": 1,
                            "country_id": 1,
                            "state_id": 1,
                            "rating": 4,
                            "comment": "fantastic resturants.......",
                            "created_at": "01-Sep-2023 12:18 PM",
                            "name": "User 17"
                        },
                        {
                            "id": 7,
                            "user_id": 16,
                            "business_list_id": 1,
                            "country_id": 1,
                            "state_id": 1,
                            "rating": 3,
                            "comment": "great resturants.......",
                            "created_at": "01-Sep-2023 12:18 PM",
                            "name": "User 16"
                        },
                        {
                            "id": 8,
                            "user_id": 18,
                            "business_list_id": 1,
                            "country_id": 1,
                            "state_id": 1,
                            "rating": 2,
                            "comment": "gooood service.......",
                            "created_at": "01-Sep-2023 12:19 PM",
                            "name": "User 18"
                        },
                        {
                            "id": 9,
                            "user_id": 3,
                            "business_list_id": 1,
                            "country_id": 1,
                            "state_id": 1,
                            "rating": 2,
                            "comment": "awesome service.......",
                            "created_at": "01-Sep-2023 12:19 PM",
                            "name": "User 3"
                        },
                        {
                            "id": 10,
                            "user_id": 4,
                            "business_list_id": 1,
                            "country_id": 1,
                            "state_id": 1,
                            "rating": 4,
                            "comment": null,
                            "created_at": "01-Sep-2023 12:19 PM",
                            "name": "User 4"
                        },
                        {
                            "id": 11,
                            "user_id": 5,
                            "business_list_id": 1,
                            "country_id": 1,
                            "state_id": 1,
                            "rating": 4,
                            "comment": null,
                            "created_at": "01-Sep-2023 12:19 PM",
                            "name": "User 5"
                        }
                    ]
                },
                "average_rating": 3.125,
                "reviews_by_rating": {
                    "5": 1,
                    "4": 3,
                    "3": 1,
                    "2": 2,
                    "1": 1
                }
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
    
    
    
    
    public function getBusinessById(Request $request)
    {
        $all = $request->all();
        $response = $this->businessListLib->businessListingByIdGet($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    
    
    
   
      
    /**
    * reviewBusinessList
    * 
    * If everything is okay, you'll get a `200` OK response with data.
    *
    * EX
    *  {
            "user_id":1,
            "business_list_id":1,
            "country_id":1,
            "state_id":1,
            "rating":1,
            "comment":"Nice.......",
    *  }
    * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
    * @method POST
    * @authenticated
    * @header      Authorization Bearer _token required  
    * @bodyParam *user_id integer required Example: 1,2,3 in JSON BODY
    * @bodyParam *business_list_id integer required Example: 1,2,3 in JSON BODY
    * @bodyParam *country_id integer required Example: 1,2,3 in JSON BODY
    * @bodyParam *state_id integer required Example: 1,2,3 in JSON BODY
    * @bodyParam *rating integer required Example: Min 1 & MAX 5in JSON BODY
    * @bodyParam comment string Example: This is good 5in JSON BODY
    *
    * <aside class="notice">basepath/api/v1/review-business-list</aside>
    * @return \Illuminate\Http\Response
    * 
    *
    * @response 200
    *  
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
    
    
    
    
    public function reviewBusinessList(Request $request)
    {
        $all = $request->all();
        $response = $this->businessListLib->reviewBusinessListing($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    
    


    
    


}
