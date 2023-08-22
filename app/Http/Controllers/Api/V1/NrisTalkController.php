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
            "user_id":1,
            "state_id":1,
            "title":"new this is test title 2",
            "description":"This is test title description again2"
        }
     *
     * <aside class="notice">basepath/api/v1/create-nris-talk</aside>
     * @method POST
     * @authenticated
     * @header      Authorization Bearer _token required  
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
            "user_id":1,
            "state_id":1,
            "talk_id":1,
            "description":"This is test title description again2"
        }
     *
     * <aside class="notice">basepath/api/v1/create-nris-talk-reply</aside>
     * @method POST
     * @authenticated
     * @header      Authorization Bearer _token required  
     * @bodyParam *user_id integer required Example: 1,2,3 in JSON BODY
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
                        "id": 4,
                        "title": "this is test title",
                        "title_slug": "this-is-test-title",
                        "description": "This is test title description",
                        "meta_title": null,
                        "meta_description": null,
                        "meta_keywords": null,
                        "total_views": null,
                        "created_at": "20-Jul-2023 06:50 AM",
                        "its_reply": {
                            "id": 3,
                            "talk_id": 4,
                            "comment": "this is reply of talk 1",
                            "created_at": "20-Jul-2023 07:39 AM"
                        }
                    }
                ],
                "first_page_url": "BASE_URL/get-nris-talk?page=1",
                "from": 1,
                "next_page_url": null,
                "path": "BASE_URL/get-nris-talk",
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
     *       "state_id":1,
     *  }
     *
     * <aside class="notice">basepath/api/v1/get-nris-talk-list</aside>
     * @method POST
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
     *
     * <aside class="notice">basepath/api/v1/get-all-nris-talk</aside>
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
                        "id": 6,
                        "title": "new this is test title 2",
                        "title_slug": "new-this-is-test-title-2",
                        "description": "This is test title description again2",
                        "meta_title": null,
                        "meta_description": null,
                        "meta_keywords": null,
                        "total_views": null,
                        "created_at": "20-Jul-2023 07:18 AM",
                        "its_reply": null
                    },
                    {
                        "id": 4,
                        "title": "this is test title",
                        "title_slug": "this-is-test-title",
                        "description": "This is test title description",
                        "meta_title": null,
                        "meta_description": null,
                        "meta_keywords": null,
                        "total_views": null,
                        "created_at": "20-Jul-2023 06:50 AM",
                        "its_reply": {
                            "id": 3,
                            "talk_id": 4,
                            "comment": "this is reply of talk 1",
                            "created_at": "20-Jul-2023 07:39 AM"
                        }
                    }
                ],
                "first_page_url": "BASE_PATH/get-all-nris-talk?page=1",
                "from": 1,
                "next_page_url": null,
                "path": "BASE_PATH/get-all-nris-talk",
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
      
  
 
 
 


    
    
    
}
