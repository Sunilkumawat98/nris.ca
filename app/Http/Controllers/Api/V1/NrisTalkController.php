<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\NrisTalkLibrary;
use App\Http\Controllers\Api\V1\BaseController;

/**
 * @group NrisTalk Related
 *
 * APIs for managing all nris talk and its reply related
 */


class NrisTalkController extends BaseController
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
        $this->nrisLibrary = new NrisTalkLibrary();
        
        
    }
    
   
    
    /**
     * createNrisTalk
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     * EX
     *  {
            "user_id":2,
            "country_id":1,
            "state_id":1,
            "title":"---------------------------",
            "description":"----------------------"
        }
     *
     * <aside class="notice">basepath/api/v1/create-nris-talk</aside>
     * @method POST
     * @authenticated
     * @header      Authorization Bearer _token required  
     * @bodyParam *user_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *country_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *state_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *title string required Example: 'This is test title' in JSON BODY
     * @bodyParam *description string required Example: 'This is test description' in JSON BODY
     * @return \Illuminate\Http\Response
     *
     * @response 200
     *  {
            "status": true,
            "status_code": 200,
            "message": "Successfully Nris talk created...",
            "data": {
                "title": "new this is test title 2",
                "title_slug": "new-this-is-test-title-2",
                "description": "This is test title description again2",
                "created_at": "20-Jul-2023 07:18 AM",
                "id": 6
            }
        }
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
    
    
    
    
    public function createNrisTalk(Request $request)
    {
        $all = $request->all();
        $response = $this->nrisLibrary->nrisTalkCreate($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    



    
    
   
    
    /**
     * createNrisTalkReply
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     * EX
     *  {
            "user_id":2,
            "country_id":1,
            "state_id":1,
            "talk_id":3,
            "description":"----------------------------"
        }
     *
     * <aside class="notice">basepath/api/v1/create-nris-talk-reply</aside>
     * @method POST
     * @authenticated
     * @header      Authorization Bearer _token required  
     * @bodyParam *user_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *country_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *state_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *talk_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *description string required Example: 'This is test description' in JSON BODY
     * @return \Illuminate\Http\Response
     *
     * @response 200
     *  {
            "status": true,
            "status_code": 200,
            "message": "Successfully Nris talk reply created...",
            "data": {
                "comment": "this is reply of talk 1",
                "created_at": "20-Jul-2023 07:39 AM",
                "id": 3
            }
        }
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
    
    
    
    
    public function createNrisTalkReply(Request $request)
    {
        $all = $request->all();
        $response = $this->nrisLibrary->replyNrisTalkCreate($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    



    
    
    /**
     * getNrisTalk
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     * EX
     *  {
            "user_id":1,
            "talk_id":1,
        }
     *
     * <aside class="notice">basepath/api/v1/get-nris-talk</aside>
     * @method POST
     * @authenticated
     * @header      Authorization Bearer _token required  
     * @bodyParam *user_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *talk_id integer required Example: 1,2,3 in JSON BODY
     * @return \Illuminate\Http\Response
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
                        "title": "new this is test title 1",
                        "title_slug": "new-this-is-test-title-1",
                        "description": "This is test title description again1",
                        "meta_title": null,
                        "meta_description": null,
                        "meta_keywords": null,
                        "total_views": null,
                        "created_at": "31-Aug-2023 04:59 PM",
                        "comments_count": 5,
                        "likes_count": 1,
                        "comments": [
                            {
                                "id": 3,
                                "talk_id": 2,
                                "comment": "this is reply of talk 2",
                                "created_at": "31-Aug-2023 05:01 PM"
                            },
                            {
                                "id": 4,
                                "talk_id": 2,
                                "comment": "this is reply of again talk 2",
                                "created_at": "31-Aug-2023 05:01 PM"
                            },
                            {
                                "id": 5,
                                "talk_id": 2,
                                "comment": "this is reply of again 2 talk 2",
                                "created_at": "31-Aug-2023 05:01 PM"
                            },
                            {
                                "id": 6,
                                "talk_id": 2,
                                "comment": "this is reply of again 3 talk 2",
                                "created_at": "31-Aug-2023 05:01 PM"
                            },
                            {
                                "id": 7,
                                "talk_id": 2,
                                "comment": "Mast talks",
                                "created_at": "31-Aug-2023 05:07 PM"
                            }
                        ]
                    }
                ],
                "first_page_url": "http://local-nris.ca/api/v1/get-nris-talk?page=1",
                "from": 1,
                "next_page_url": null,
                "path": "http://local-nris.ca/api/v1/get-nris-talk",
                "per_page": 15,
                "prev_page_url": null,
                "to": 1
            }
        }
     *
     *
     * @response 500
     *  {
            "status": false,
            "status_code": 500,
            "message": "Oops, something went wrong...",
            "data": []
        }
     * @response 404
     *  {
            "status": false,
            "status_code": 404,
            "message": "List not found...",
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
    
    
    
    
    public function getNrisTalk(Request $request)
    {
        $all = $request->all();
        $response = $this->nrisLibrary->nrisTalkFetch($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    


    
    /**
     * getNrisTalkList
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     * EX
     *  {
            "country_id":1,
            "state_id":1
        }
     *
     * <aside class="notice">basepath/api/v1/get-nris-talk-list</aside>
     * @method POST
     * @bodyParam *country_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *state_id integer required Example: 1,2,3 in JSON BODY
     * 
     * @return \Illuminate\Http\Response
     *
     * @response 200
     *  {
            "status": true,
            "status_code": 200,
            "message": "Successfully your list found..",
            "data": [
                {
                    "id": 6,
                    "title": "Title",
                    "title_slug": "title-slug",
                    "description": "Nris talk decription",
                    "meta_title": null,
                    "meta_description": null,
                    "meta_keywords": null,
                    "total_views": null,
                    "created_at": "20-Jul-2023 07:18 AM"
                }
            ]
        }
     *
     *
     * @response 500
     *  {
            "status": false,
            "status_code": 500,
            "message": "Oops, something went wrong...",
            "data": []
        }
     * @response 404
     *  {
            "status": false,
            "status_code": 404,
            "message": "List not found...",
            "data": []
        }
     * 
     *
     *
     */
    
    
    
    
     public function getNrisTalkList(Request $request)
     {
         $all = $request->all();
         $response = $this->nrisLibrary->nrisTalkListFetch($all);
 
         if (!$response[$this->status]) {
             return $this->sendError($response[$this->message], $response[$this->code]);
         }
         
         return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
     }



    
    /**
     * getAllNrisTalk
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     * EX
     * {
            "country_id":1,
            "state_id":1
        }
     *
     * @method POST
     * <aside class="notice">basepath/api/v1/get-all-nris-talk</aside>
     * @bodyParam *country_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *state_id integer required Example: 1,2,3 in JSON BODY
     * 
     * @return \Illuminate\Http\Response
     *
     * @response 200
     *  {
            "status": true,
            "status_code": 200,
            "message": "Successfully your list found..",
            "data": [
                {
                    "id": 4,
                    "title": "new this is test title 3",
                    "title_slug": "new-this-is-test-title-3",
                    "description": "This is test title description again 3",
                    "country_id": 1,
                    "meta_title": null,
                    "meta_description": null,
                    "meta_keywords": null,
                    "total_views": null,
                    "created_at": "31-Aug-2023 04:59 PM",
                    "comments_count": 0,
                    "likes_count": 1
                },
                {
                    "id": 3,
                    "title": "new this is test title 2",
                    "title_slug": "new-this-is-test-title-2",
                    "description": "This is test title description again 2",
                    "country_id": 1,
                    "meta_title": null,
                    "meta_description": null,
                    "meta_keywords": null,
                    "total_views": null,
                    "created_at": "31-Aug-2023 04:59 PM",
                    "comments_count": 1,
                    "likes_count": 0
                },
                {
                    "id": 2,
                    "title": "new this is test title 1",
                    "title_slug": "new-this-is-test-title-1",
                    "description": "This is test title description again1",
                    "country_id": 1,
                    "meta_title": null,
                    "meta_description": null,
                    "meta_keywords": null,
                    "total_views": null,
                    "created_at": "31-Aug-2023 04:59 PM",
                    "comments_count": 5,
                    "likes_count": 1
                }
            ]
        }
     *
     *
     * @response 500
     *  {
            "status": false,
            "status_code": 500,
            "message": "Oops, something went wrong...",
            "data": []
        }
     * @response 404
     *  {
            "status": false,
            "status_code": 404,
            "message": "List not found...",
            "data": []
        }
     * 
     * 
     *
     */
    
    
    
    
     public function getAllNrisTalk(Request $request)
     {
         $all = $request->all();
         $response = $this->nrisLibrary->allNrisTalkFetch($all);
 
         if (!$response[$this->status]) {
             return $this->sendError($response[$this->message], $response[$this->code]);
         }
         
         return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
     }
      


    
    /**
     * getAllNrisTalkList
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     * EX
     * {
            "country_id":1,
            "state_id":1
        }
     *
     * @method POST
     * <aside class="notice">basepath/api/v1/get-all-nris-talk-list</aside>
     * @bodyParam *country_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *state_id integer required Example: 1,2,3 in JSON BODY
     * 
     * @return \Illuminate\Http\Response
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
                        "id": 4,
                        "title": "title",
                        "title_slug": "title",
                        "description": "description",
                        "meta_title": null,
                        "meta_description": null,
                        "meta_keywords": null,
                        "total_views": null,
                        "created_at": "31-Aug-2023 04:59 PM",
                        "comments_count": 0,
                        "likes_count": 1
                    },
                    {
                        "id": 3,
                        "title": "title",
                        "title_slug": "title",
                        "description": "description",
                        "meta_title": null,
                        "meta_description": null,
                        "meta_keywords": null,
                        "total_views": null,
                        "created_at": "31-Aug-2023 04:59 PM",
                        "comments_count": 1,
                        "likes_count": 0
                    }
                ],
                "first_page_url": "PATH/get-all-nris-talk-list?page=1",
                "from": 1,
                "next_page_url": null,
                "path": "PATh/get-all-nris-talk-list",
                "per_page": 25,
                "prev_page_url": null,
                "to": 3
            }
        }
     *
     *
     * @response 500
     *  {
            "status": false,
            "status_code": 500,
            "message": "Oops, something went wrong...",
            "data": []
        }
     * @response 404
     *  {
            "status": false,
            "status_code": 404,
            "message": "List not found...",
            "data": []
        }
     * 
     * 
     *
     */
    
    
    
    
    public function getAllNrisTalkList(Request $request)
    {
        $all = $request->all();
        $response = $this->nrisLibrary->allNrisTalkListFetch($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
     
 





    /**
     * getNrisTalkReplyById
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     *  EX
     *  {
            "talk_id":4
        }
     *
     * <aside class="notice">basepath/api/v1/get-nris-talk-reply-by-id</aside>
     * @bodyParam *talk_id integer required Example: 1,2,3 in JSON BODY
     * @return \Illuminate\Http\Response
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
                        "id": 5,
                        "talk_id": 4,
                        "comment": "testing again",
                        "created_at": 20-Jul-2023 07:39 AM
                    },
                    {
                        "id": 3,
                        "talk_id": 4,
                        "comment": "this is reply of talk 1",
                        "created_at": "20-Jul-2023 07:39 AM"
                    }
                ],
                "first_page_url": "BASE_PATH/get-nris-talk-reply-by-id?page=1",
                "from": 1,
                "next_page_url": null,
                "path": "BASE_PATH/get-nris-talk-reply-by-id",
                "per_page": 15,
                "prev_page_url": null,
                "to": 3
            }
        }
     *
     *
     * @response 500
     *  {
            "status": false,
            "status_code": 500,
            "message": "Oops, something went wrong...",
            "data": []
        }
     * @response 404
     *  {
            "status": false,
            "status_code": 404,
            "message": "List not found...",
            "data": []
        }
     * 
     *
     *
     */
    
    
    
    
     public function getNrisTalkReplyById(Request $request)
     {
         $all = $request->all();
         $response = $this->nrisLibrary->getAllNrisTalkReplyById($all);
 
         if (!$response[$this->status]) {
             return $this->sendError($response[$this->message], $response[$this->code]);
         }
         
         return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
     }
      
  
 
 
 




    /**
     * likeNrisTalkById
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     *  EX
     *  {
            "talk_id":4,
            "user_id":1,
            "country_id":1,
            "state_id":1,
        }
     *
     * <aside class="notice">basepath/api/v1/like-nris-talk-by-id</aside>
     * @bodyParam *talk_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *user_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *country_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *state_id integer required Example: 1,2,3 in JSON BODY
     * @return \Illuminate\Http\Response
     *
     * @response 200
     *  {
            "status": true,
            "status_code": 200,
            "message": "Successfully Nris talk reply created...",
            "data": {
                "talk_id": 4,
                "created_at": "31-Aug-2023 05:10 PM",
                "id": 2
            }
        }
     *
     *
     * @response 500
     *  {
            "status": false,
            "status_code": 500,
            "message": "Oops, something went wrong...",
            "data": []
        }
     * @response 404
     *  {
            "status": false,
            "status_code": 404,
            "message": "List not found...",
            "data": []
        }
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
    
    
    
    
     public function likeNrisTalkById(Request $request)
     {
         $all = $request->all();
         $response = $this->nrisLibrary->likeNrisTalkById($all);
 
         if (!$response[$this->status]) {
             return $this->sendError($response[$this->message], $response[$this->code]);
         }
         
         return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
     }
      
  
 
 
 


    
    
    
}
