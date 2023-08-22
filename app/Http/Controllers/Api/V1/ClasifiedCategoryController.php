<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\ClasifiedCategoryLibrary;
use App\Http\Controllers\Api\V1\BaseController;

/**
 * @group ClasifiedCategory Related
 *
 * APIs for managing all Clasified Category related
 */


class ClasifiedCategoryController extends BaseController
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
        $this->clasifiedCatLib = new ClasifiedCategoryLibrary();
        
        
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
     * <aside class="notice">basepath/api/v1/get-all-category</aside>
     * @method GET
     * @bodyParam *user_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *state_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *title string required Example: 'This is test title' in JSON BODY
     * @bodyParam *description string required Example: 'This is test description' in JSON BODY
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
                    "name": "Baby Sitting",
                    "slug": "baby-sitting",
                    "color": "#C41414",
                    "created_at": "27-Jul-2023 12:52 PM"
                },
                {
                    "id": 1,
                    "name": "Auto",
                    "slug": "auto",
                    "color": "#846A6A",
                    "created_at": "27-Jul-2023 11:35 AM"
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
        $response = $this->clasifiedCatLib->allCategoryGet();

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
     * <aside class="notice">basepath/api/v1/get-all-sub-category</aside>
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
                    "id": 1,
                    "category_id": 1,
                    "name": "Audis",
                    "slug": "audis",
                    "color": "#846A6A",
                    "created_at": "28-Jul-2023 07:03 AM"
                },
                {
                    "id": 2,
                    "category_id": 1,
                    "name": "Bmw",
                    "slug": "bmw",
                    "color": "#846CCA",
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
    
    
    
    
    public function getAllSubCategory()
    {
        $response = $this->clasifiedCatLib->allSubCategoryGet();

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
     * <aside class="notice">basepath/api/v1/get-all-sub-category-by-id</aside>
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
        $response = $this->clasifiedCatLib->allCategoryByIdGet($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    



    
    
   
    
    /**
     * createFreeClasified
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     * EX
     *  {
            "user_id":1,
            "country_id":1,
            "state_id":1,
            "category_id":1,
            "sub_cat_id":1,
            "contact_name":"Abc",
            "contact_email":"you@domain.com",
            "contact_number":"98****3212",
            "contact_address":"Address",
            "show_email":false,
            "use_address_map":true,
            "title":"this is test ads",
            "message":"this is test message",
            "image":"abc.jpg"
            "other_details":"[{"make":"audi"},{"color":"red"}, {"condition": "1st hand"}, {"Transmission":"Automatic"},{"Type": "Van"} ]",
            "end_at":"2023-08-01",
     *  }
     *
     * <aside class="notice">basepath/api/v1/create-free-clasified</aside>
     * @method POST
     * @authenticated
     * @header      Authorization Bearer _token required  
     * @bodyParam *user_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *country_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *state_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam category_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam sub_cat_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam title string  Example: "title text " in JSON BODY
     * @bodyParam message string  Example: "message text " in JSON BODY
     * @bodyParam image image  Example: "abc.jpg" in JSON BODY
     * @bodyParam *contact_name string required Example: Abc in JSON BODY
     * @bodyParam *contact_email string required Example: you@domain.com in JSON BODY
     * @bodyParam *contact_number string required Example: 9090654320 in JSON BODY
     * @bodyParam *contact_address string required Example: Address in JSON BODY
     * @bodyParam *show_email boolean required Example: 0 & 1 in JSON BODY
     * @bodyParam *use_address_map boolean required Example: 0 & 1 in JSON BODY
     * @bodyParam other_details json  Example: [{"Make":"audi"},{"Color":"red"}, {"Condition": "1st hand"}, {"Transmission":"Automatic"},{"Type": "Van"} ] JSON BODY
     * @bodyParam *end_at date required Example: YYYY-MM-DD JSON BODY
     
     * <aside class="note">Make sure "other_details" Key's First Charecter should be in CAPITAL LETTER </aside>
     * @return \Illuminate\Http\Response
     *
     * 
     * @response 200
     *  {
            "status": true,
            "status_code": 200,
            "message": "Successfully free clasified created...",
            "data": {
                "user_id": "1",
                "country_id": "1",
                "state_id": "1",
                "cat_id": "1",
                "sub_cat_id": "1",
                "title": "this is simple test title",
                "title_slug": "this-is-simple-test-title",
                "message": null,
                "image": "1690973959_Ridge_post_2-1.jpg",
                "contact_name": "MdSaddam",
                "contact_email": "hussainmd@gmail.com",
                "contact_number": "9088123678",
                "contact_address": "address",
                "show_email": "1",
                "use_address_map": "0",
                "other_details": "[{\"make\":\"audi\"},{\"color\":\"red\"}, {\"condition\": \"1st hand\"}, {\"Transmission\":\"Automatic\"},{\"Type\": \"Van\"} ]",
                "end_at": "02/08/2023",
                "created_at": "02-Aug-2023 10:59 AM",
                "id": 7
            }
       }
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
    
    
    
    
    public function createFreeClasified(Request $request)
    {
        $all = $request->all();
        $response = $this->clasifiedCatLib->freeClasifiedCreate($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    
    
   
    
    /**
     * createFreeClasifiedBid
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     * EX
     *  {
            "user_id":1,
            "classified_id":1,
            "amount":123,
            "comment":"Only 123 dollar"
     *  }
     *
     * <aside class="notice">basepath/api/v1/create-free-clasified-bid</aside>
     * @method POST
     * @authenticated
     * @header      Authorization Bearer _token required  
     * @bodyParam *user_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *classified_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *comment string required Example: comment text in JSON BODY
     * @bodyParam *amount float required Example: 10.00 in JSON BODY
     * @return \Illuminate\Http\Response
     *
     * 
     * @response 200
     *  {
            "status": true,
            "status_code": 200,
            "message": "Successfully free clasified bid created...",
            "data": {
                "user_id": 1,
                "classified_id": 1,
                "comments": "Only 123 dollar",
                "amount": 123,
                "created_at": "03-Aug-2023 06:48 AM",
                "id": 3
            }
     *  }
     *
     *
     * @response 500
     *  {
            "status": false,
            "status_code": 500,
            "message": "Oops, something went wrong...",
            "data": []
        }
     * 
     * @response 401
     *  {
            "message": "Token is Invalid",
            "status_code": 401,
            "status": false
        }


     * @response 419
     *  {
            "message": "Token is Expired",
            "status_code": 419,
            "status": false
        }


     * @response 403
     *  {
            "message": "Authorised Token Not Found",
            "status_code": 403,
            "status": false
        }
     *
     *
     */
    
    
    
    
    public function createFreeClasifiedBid(Request $request)
    {
        $all = $request->all();
        $response = $this->clasifiedCatLib->freeClasifiedBidCreate($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    
    


    /**
     * createFreeClasifiedComment
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     * EX
     *  {
            "user_id":1,
            "classified_id":1,
            "comment":"Only 123 dollar"
     *  }
     *
     * <aside class="notice">basepath/api/v1/create-free-clasified-comment</aside>
     * @method POST
     * @authenticated
     * @header      Authorization Bearer _token required  
     * @bodyParam *user_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *classified_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *comment string required Example: comment text in JSON BODY
     * @return \Illuminate\Http\Response
     *
     * 
     * @response 200
     *  {
            "status": true,
            "status_code": 200,
            "message": "Successfully free clasified bid created...",
            "data": {
                "user_id": 1,
                "classified_id": 1,
                "comments": "Great items....",
                "created_at": "03-Aug-2023 06:48 AM",
                "id": 3
            }
     *  }
     *
     *
     * @response 500
     *  {
            "status": false,
            "status_code": 500,
            "message": "Oops, something went wrong...",
            "data": []
        }
     * 
     * @response 401
     *  {
            "message": "Token is Invalid",
            "status_code": 401,
            "status": false
        }


     * @response 419
     * {
            "message": "Token is Expired",
            "status_code": 419,
            "status": false
        }


     * @response 403
     *  {
            "message": "Authorised Token Not Found",
            "status_code": 403,
            "status": false
        }
     *
     *
     */
    
    
    
    
     public function createFreeClasifiedComment(Request $request)
     {
         $all = $request->all();
         $response = $this->clasifiedCatLib->freeClasifiedCommentCreate($all);
 
         if (!$response[$this->status]) {
             return $this->sendError($response[$this->message], $response[$this->code]);
         }
         
         return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
     }
     
     
    


      
    /**
     * getFreeClasifiedById
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     * 
     *
     * <aside class="notice">basepath/api/v1/get-free-clasified-by-id</aside>
     * @method POST
     * @bodyParam *id integer required Example: 1,2,3 in JSON BODY
     * @return \Illuminate\Http\Response
     * 
     * EX
     *  {
            "id":6
        }
     *
     * @response 200
     *  {
            "status": true,
            "status_code": 200,
            "message": "Successfully clasified found..",
            "data": {
                "id": 1,
                "user_id": 1,
                "country_id": {
                    "id": 1,
                    "name": "USA",
                    "color": "#16b19f",
                    "code": "us",
                    "domain": "usa",
                    "image": "152194054262639fda95ac05.12411768.jpg",
                    "c_meta_title": "Indian Website for Nris in USA",
                    "c_meta_description": "An Indian community website for all NRIS residing in United States. Get information on local real estate, Indian movies, restaurants, visiting spots etc.",
                    "c_meta_keywords": "Indian websites in USA, NRI websites, Indian community websites, classified website for NRIS in USA, free ads website",
                    "created_at": "20-Jan-2022 05:18 AM"
                },
                "state_id": {
                    "id": 1,
                    "name": "Alberta",
                    "code": "AB",
                    "domain": "alberta",
                    "description": "Alberta",
                    "logo": "196066989625087bd37a4c2.18410119.jpg",
                    "s_meta_title": "Indian Website for Nris in || Alberta",
                    "s_meta_description": "An Indian community website for all NRIS residing in Alberta United States. Get information on local real estate, Indian movies, restaurants, visiting spots etc",
                    "s_meta_keywords": "Indian websites in USA, NRI websites, Indian community websites, classified website for NRIS in USA, free ads website, alberta nris, nris in alberta",
                    "header_image": "1522842913625087eb594b47.13394636.jpg",
                    "header_image2": "1522842913625087eb594b47.13394636.jpg",
                    "header_image3": "1522842913625087eb594b47.13394636.jpg"
                },
                "cat_id": {
                    "id": 1,
                    "name": "Auto",
                    "slug": "auto",
                    "color": "#846A6A",
                    "created_at": "27-Jul-2023 11:35 AM"
                },
                "sub_cat_id": {
                    "id": 1,
                    "category_id": 1,
                    "name": "Audis",
                    "slug": "audis",
                    "color": "#846A6A",
                    "created_at": "28-Jul-2023 07:03 AM"
                },
                "title": "this is simple test title",
                "title_slug": "this-is-simple-test-title",
                "message": null,
                "image": "IMAGE_BASE_PATH/1691044108_photo1.png",
                "contact_name": "MdSaddam",
                "contact_email": "hussainmd@gmail.com",
                "contact_number": "9088123678",
                "contact_address": "address",
                "show_email": 1,
                "use_address_map": 0,
                "meta_title": null,
                "meta_description": null,
                "meta_keywords": null,
                "other_details": "[{\"make\":\"audi\"},{\"color\":\"red\"}, {\"condition\": \"1st hand\"}, {\"Transmission\":\"Automatic\"},{\"Type\": \"Van\"} ]",
                "end_at": "02/08/2023",
                "total_views": 0,
                "created_at": "03-Aug-2023 06:28 AM",
                "bids": [
                    {
                        "id": 3,
                        "user_id": 1,
                        "comments": "Only 123 dollar",
                        "amount": 123,
                        "created_at": "03-Aug-2023 06:48 AM"
                    },
                    {
                        "id": 5,
                        "user_id": 1,
                        "comments": "Only 130 dollar",
                        "amount": 130,
                        "created_at": "03-Aug-2023 07:30 AM"
                    }
                ],
                "comments": [
                    {
                        "id": 1,
                        "user_id": 1,
                        "comments": "Mast Product",
                        "created_at": "03-Aug-2023 07:43 AM"
                    },
                    {
                        "id": 2,
                        "user_id": 1,
                        "comments": "Great and nice.....",
                        "created_at": "03-Aug-2023 07:45 AM"
                    },
                    {
                        "id": 5,
                        "user_id": 1,
                        "comments": "awesome and nice.....",
                        "created_at": "03-Aug-2023 07:45 AM"
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
            "message": "Clasified not found...",
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
    
    
    
    
    public function getFreeClasifiedById(Request $request)
    {
        $all = $request->all();
        $response = $this->clasifiedCatLib->getFreeClasifiedById($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    


      
    /**
     * getRecentAds
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     * 
     *
     * <aside class="notice">basepath/api/v1/get-recent-ads</aside>
     * @return \Illuminate\Http\Response
     * 
     *
     * @response 200
     *  {
            "status": true,
            "status_code": 200,
            "message": "Successfully your list found..",
            "data": {
                "current_page": 1,
                "data": [
                    {
                        "id": 2,
                        "user_id": 1,
                        "country_id": {
                            "id": 1,
                            "name": "USA",
                            "color": "#16b19f",
                            "code": "us",
                            "domain": "usa",
                            "image": "152194054262639fda95ac05.12411768.jpg",
                            "c_meta_title": "Indian Website for Nris in USA",
                            "c_meta_description": "An Indian community website for all NRIS residing in United States. Get information on local real estate, Indian movies, restaurants, visiting spots etc.",
                            "c_meta_keywords": "Indian websites in USA, NRI websites, Indian community websites, classified website for NRIS in USA, free ads website",
                            "created_at": "20-Jan-2022 05:18 AM"
                        },
                        "state_id": {
                            "id": 1,
                            "name": "Alberta",
                            "code": "AB",
                            "domain": "alberta",
                            "description": "Alberta",
                            "logo": "196066989625087bd37a4c2.18410119.jpg",
                            "s_meta_title": "Indian Website for Nris in || Alberta",
                            "s_meta_description": "An Indian community website for all NRIS residing in Alberta United States. Get information on local real estate, Indian movies, restaurants, visiting spots etc",
                            "s_meta_keywords": "Indian websites in USA, NRI websites, Indian community websites, classified website for NRIS in USA, free ads website, alberta nris, nris in alberta",
                            "header_image": "1522842913625087eb594b47.13394636.jpg",
                            "header_image2": "1522842913625087eb594b47.13394636.jpg",
                            "header_image3": "1522842913625087eb594b47.13394636.jpg"
                        },
                        "cat_id": {
                            "id": 1,
                            "name": "Auto",
                            "slug": "auto",
                            "color": "#846A6A",
                            "created_at": "27-Jul-2023 11:35 AM"
                        },
                        "sub_cat_id": {
                            "id": 1,
                            "category_id": 1,
                            "name": "Audis",
                            "slug": "audis",
                            "color": "#846A6A",
                            "created_at": "28-Jul-2023 07:03 AM"
                        },
                        "title": "this is simple test title",
                        "title_slug": "this-is-simple-test-title",
                        "message": null,
                        "image": "PATH/ADS_IMAGE/1691047686_photo1.png",
                        "contact_name": "MdSaddam",
                        "contact_email": "hussainmd@gmail.com",
                        "contact_number": "9088123678",
                        "contact_address": "address",
                        "show_email": 1,
                        "use_address_map": 0,
                        "meta_title": null,
                        "meta_description": null,
                        "meta_keywords": null,
                        "other_details": "[{\"make\":\"audi\"},{\"color\":\"red\"}, {\"condition\": \"1st hand\"}, {\"Transmission\":\"Automatic\"},{\"Type\": \"Van\"} ]",
                        "end_at": "02/08/2023",
                        "total_views": 0,
                        "created_at": "03-Aug-2023 07:28 AM"
                    },
                    {
                        "id": 1,
                        "user_id": 1,
                        "country_id": {
                            "id": 1,
                            "name": "USA",
                            "color": "#16b19f",
                            "code": "us",
                            "domain": "usa",
                            "image": "152194054262639fda95ac05.12411768.jpg",
                            "c_meta_title": "Indian Website for Nris in USA",
                            "c_meta_description": "An Indian community website for all NRIS residing in United States. Get information on local real estate, Indian movies, restaurants, visiting spots etc.",
                            "c_meta_keywords": "Indian websites in USA, NRI websites, Indian community websites, classified website for NRIS in USA, free ads website",
                            "created_at": "20-Jan-2022 05:18 AM"
                        },
                        "state_id": {
                            "id": 1,
                            "name": "Alberta",
                            "code": "AB",
                            "domain": "alberta",
                            "description": "Alberta",
                            "logo": "196066989625087bd37a4c2.18410119.jpg",
                            "s_meta_title": "Indian Website for Nris in || Alberta",
                            "s_meta_description": "An Indian community website for all NRIS residing in Alberta United States. Get information on local real estate, Indian movies, restaurants, visiting spots etc",
                            "s_meta_keywords": "Indian websites in USA, NRI websites, Indian community websites, classified website for NRIS in USA, free ads website, alberta nris, nris in alberta",
                            "header_image": "1522842913625087eb594b47.13394636.jpg",
                            "header_image2": "1522842913625087eb594b47.13394636.jpg",
                            "header_image3": "1522842913625087eb594b47.13394636.jpg"
                        },
                        "cat_id": {
                            "id": 1,
                            "name": "Auto",
                            "slug": "auto",
                            "color": "#846A6A",
                            "created_at": "27-Jul-2023 11:35 AM"
                        },
                        "sub_cat_id": {
                            "id": 1,
                            "category_id": 1,
                            "name": "Audis",
                            "slug": "audis",
                            "color": "#846A6A",
                            "created_at": "28-Jul-2023 07:03 AM"
                        },
                        "title": "this is simple test title",
                        "title_slug": "this-is-simple-test-title",
                        "message": null,
                        "image": "PATH/ADS_IMAGE/1691044108_photo1.png",
                        "contact_name": "MdSaddam",
                        "contact_email": "hussainmd@gmail.com",
                        "contact_number": "9088123678",
                        "contact_address": "address",
                        "show_email": 1,
                        "use_address_map": 0,
                        "meta_title": null,
                        "meta_description": null,
                        "meta_keywords": null,
                        "other_details": "[{\"make\":\"audi\"},{\"color\":\"red\"}, {\"condition\": \"1st hand\"}, {\"Transmission\":\"Automatic\"},{\"Type\": \"Van\"} ]",
                        "end_at": "02/08/2023",
                        "total_views": 0,
                        "created_at": "03-Aug-2023 06:28 AM"
                    }
                ],
                "first_page_url": "PATH/api/v1/get-recent-ads?page=1",
                "from": 1,
                "next_page_url": null,
                "path": "PATH/api/v1/get-recent-ads",
                "per_page": 4,
                "prev_page_url": null,
                "to": 2
            }
        }
     *
     *
     * @response 404
     *  {
            "status": false,
            "status_code": 404,
            "message": "Clasified not found...",
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
    
    
    
    
    public function getRecentAds(Request $request)
    {
        $all = $request->all();
        $response = $this->clasifiedCatLib->recentAdsGet($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    
    


      
    /**
     * getRecentAdsList
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     * 
     *
     * <aside class="notice">basepath/api/v1/get-recent-ads-list</aside>
     * @return \Illuminate\Http\Response
     * 
     *
     * @response 200
     *  {
            "status": true,
            "status_code": 200,
            "message": "Successfully clasified found..",
            "data": [
                {
                    "id": 7,
                    "user_id": 1,
                    "country_id": {
                        "id": 1,
                        "name": "USA",
                        "color": "#16b19f",
                        "code": "us",
                        "domain": "usa",
                        "image": "152194054262639fda95ac05.12411768.jpg",
                        "c_meta_title": "Indian Website for Nris in USA",
                        "c_meta_description": "An Indian community website for all NRIS residing in United States. Get information on local real estate, Indian movies, restaurants, visiting spots etc.",
                        "c_meta_keywords": "Indian websites in USA, NRI websites, Indian community websites, classified website for NRIS in USA, free ads website",
                        "created_at": "20-Jan-2022 05:18 AM"
                    },
                    "state_id": {
                        "id": 1,
                        "name": "Alberta",
                        "code": "AB",
                        "domain": "alberta",
                        "description": "Alberta",
                        "logo": "196066989625087bd37a4c2.18410119.jpg",
                        "s_meta_title": "Indian Website for Nris in || Alberta",
                        "s_meta_description": "An Indian community website for all NRIS residing in Alberta United States. Get information on local real estate, Indian movies, restaurants, visiting spots etc",
                        "s_meta_keywords": "Indian websites in USA, NRI websites, Indian community websites, classified website for NRIS in USA, free ads website, alberta nris, nris in alberta",
                        "header_image": "1522842913625087eb594b47.13394636.jpg",
                        "header_image2": "1522842913625087eb594b47.13394636.jpg",
                        "header_image3": "1522842913625087eb594b47.13394636.jpg"
                    },
                    "cat_id": {
                        "id": 1,
                        "name": "Auto",
                        "slug": "auto",
                        "color": "#846A6A",
                        "created_at": "27-Jul-2023 11:35 AM"
                    },
                    "sub_cat_id": {
                        "id": 1,
                        "category_id": 1,
                        "name": "Audis",
                        "slug": "audis",
                        "color": "#846A6A",
                        "created_at": "28-Jul-2023 07:03 AM"
                    },
                    "title": "this is simple test title",
                    "title_slug": "this-is-simple-test-title",
                    "message": null,
                    "image": "1690973959_Ridge_post_2-1.jpg",
                    "contact_name": "MdSaddam",
                    "contact_email": "hussainmd@gmail.com",
                    "contact_number": "9088123678",
                    "contact_address": "address",
                    "show_email": 1,
                    "use_address_map": 0,
                    "meta_title": null,
                    "meta_description": null,
                    "meta_keywords": null,
                    "other_details": "[{\"make\":\"audi\"},{\"color\":\"red\"}, {\"condition\": \"1st hand\"}, {\"Transmission\":\"Automatic\"},{\"Type\": \"Van\"} ]",
                    "end_at": "02/08/2023",
                    "total_views": 0,
                    "created_at": "02-Aug-2023 10:59 AM"
                },
                {
                    "id": 6,
                    "user_id": 1,
                    "country_id": {
                        "id": 1,
                        "name": "USA",
                        "color": "#16b19f",
                        "code": "us",
                        "domain": "usa",
                        "image": "152194054262639fda95ac05.12411768.jpg",
                        "c_meta_title": "Indian Website for Nris in USA",
                        "c_meta_description": "An Indian community website for all NRIS residing in United States. Get information on local real estate, Indian movies, restaurants, visiting spots etc.",
                        "c_meta_keywords": "Indian websites in USA, NRI websites, Indian community websites, classified website for NRIS in USA, free ads website",
                        "created_at": "20-Jan-2022 05:18 AM"
                    },
                    "state_id": {
                        "id": 1,
                        "name": "Alberta",
                        "code": "AB",
                        "domain": "alberta",
                        "description": "Alberta",
                        "logo": "196066989625087bd37a4c2.18410119.jpg",
                        "s_meta_title": "Indian Website for Nris in || Alberta",
                        "s_meta_description": "An Indian community website for all NRIS residing in Alberta United States. Get information on local real estate, Indian movies, restaurants, visiting spots etc",
                        "s_meta_keywords": "Indian websites in USA, NRI websites, Indian community websites, classified website for NRIS in USA, free ads website, alberta nris, nris in alberta",
                        "header_image": "1522842913625087eb594b47.13394636.jpg",
                        "header_image2": "1522842913625087eb594b47.13394636.jpg",
                        "header_image3": "1522842913625087eb594b47.13394636.jpg"
                    },
                    "cat_id": {
                        "id": 1,
                        "name": "Auto",
                        "slug": "auto",
                        "color": "#846A6A",
                        "created_at": "27-Jul-2023 11:35 AM"
                    },
                    "sub_cat_id": {
                        "id": 1,
                        "category_id": 1,
                        "name": "Audis",
                        "slug": "audis",
                        "color": "#846A6A",
                        "created_at": "28-Jul-2023 07:03 AM"
                    },
                    "title": "this is simple test title",
                    "title_slug": "this-is-simple-test-title",
                    "message": null,
                    "image": "1690971434_Ridge_post_2-1.jpg",
                    "contact_name": "MdSaddam",
                    "contact_email": "hussainmd@gmail.com",
                    "contact_number": "9088123678",
                    "contact_address": "address",
                    "show_email": 1,
                    "use_address_map": 0,
                    "meta_title": null,
                    "meta_description": null,
                    "meta_keywords": null,
                    "other_details": "[{\"make\":\"audi\"},{\"color\":\"red\"}, {\"condition\": \"1st hand\"}, {\"Transmission\":\"Automatic\"},{\"Type\": \"Van\"} ]",
                    "end_at": "02/08/2023",
                    "total_views": 0,
                    "created_at": "02-Aug-2023 10:17 AM"
                }
            ]
        }
     *
     *
     * @response 404
     *  {
            "status": false,
            "status_code": 404,
            "message": "Clasified not found...",
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
    
    
    
    
    public function getRecentAdsList(Request $request)
    {
        $all = $request->all();
        $response = $this->clasifiedCatLib->recentAdsListGet($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    
    

}
