<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\ForumLibrary;
use App\Http\Controllers\Api\V1\BaseController;

/**
 * @group Forum Listing Related
 *
 * APIs for managing all Forum listing related Category,  sub category
 */


class ForumController extends BaseController
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
        $this->forumLib                  = new ForumLibrary();
        
        
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
     * <aside class="notice">basepath/api/v1/get-all-forum-category</aside>
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
                    "name": "Category1",
                    "slug": "category1",
                    "created_at": "01-Nov-2023 01:11 PM"
                },
                {
                    "id": 1,
                    "name": "Category2",
                    "slug": "category2",
                    "created_at": "01-Nov-2023 01:15 PM"
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
        $response = $this->forumLib->allCategoryGet();

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
     * <aside class="notice">basepath/api/v1/get-all-forum-sub-category</aside>
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
                    "name": "Sub Category 1",
                },
                {
                    "id": 2,
                    "category_id": 2,
                    "name": "Sub Category 2",
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
        $response = $this->forumLib->allSubCategoryGet();

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
     * <aside class="notice">basepath/api/v1/get-all-forum-sub-category-by-id</aside>
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
        $response = $this->forumLib->allSubCategoryByIdGet($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    



    
    
   



     
    /**
     * getAllForumListByCategoryId
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * EX
     *  {
            
            "category_id":1,
     *  }
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * @method POST
     * @bodyParam *country_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *state_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *category_id integer required Example: 1,2,3 in JSON BODY
     *
     * <aside class="notice">basepath/api/v1/get-all-forum-list-by-category-id</aside>
     * @return \Illuminate\Http\Response
     * 
     *
     * @response 200
     *  
     * {
            "status": true,
            "status_code": 200,
            "message": "Successfully data list found..",
            "data": {
                "current_page": 1,
                "data": [
                    {
                        "id": 1,
                        "title": "title",
                        "title_slug": "title",
                        "description": "description",
                        "total_views": 0,
                        "category": {
                            "id": 1,
                            "name": "Category1"
                        },
                        "subcategory": {
                            "id": 1,
                            "name": "Sub category 1"
                        }
                    }
                ],
                "first_page_url": "PATH/get-all-forum-list-by-category-id?page=1",
                "from": 1,
                "next_page_url": null,
                "path": "PATH/get-all-forum-list-by-category-id",
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
    
    
    
    
     public function getAllForumListByCategoryId(Request $request)
     {
         $all = $request->all();
         $response = $this->forumLib->allForumByCategoryGet($all);
 
         if (!$response[$this->status]) {
             return $this->sendError($response[$this->message], $response[$this->code]);
         }
         
         return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
     }
   
      
    /**
     * getForumById
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * EX
     *  {
            "forum_id":1
     *  }
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * @method POST
     * @bodyParam *forum_id integer required Example: 1,2,3 in JSON BODY
     *
     * <aside class="notice">basepath/api/v1/get-forum-by-id</aside>
     * @return \Illuminate\Http\Response
     * 
     *
     * @response 200
     * {
            "status": true,
            "status_code": 200,
            "message": "Successfully data list found..",
            "data": {
                "id": 1,
                "title": "title",
                "title_slug": "title",
                "description": "description",
                "meta_title": "meta",
                "meta_description": "meta desc",
                "meta_keywords": "meta key",
                "total_views": 0,
                "created_at": "01-Nov-2023 07:51 PM",
                "category": {
                    "id": 1,
                    "name": "Test 11111"
                },
                "subcategory": {
                    "id": 1,
                    "name": "Sub category 1"
                },
                "comments": [
                {
                    "id": 1,
                    "forum_id": 1,
                    "user_id": 1,
                    "comment": "test1",
                    "user": {
                        "id": 2,
                        "first_name": "User1"
                    }
                },
                {
                    "id": 3,
                    "forum_id": 1,
                    "user_id": 2,
                    "comment": "test2",
                    "user": {
                        "id": 2,
                        "first_name": "User2"
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
    
    
     
    
    public function getForumById(Request $request)
    {
        $all = $request->all();
        $response = $this->forumLib->forumByIdGet($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    
    
    
   
      
    /**
    * createForum
    * 
    * If everything is okay, you'll get a `200` OK response with data.
    *
    * EX
    *  {
            "user_id":2,
            "category_id":1,
            "sub_cat_id":1,
            "title":"title",
            "description":"desc"
        }
    * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
    * @method POST
    * @authenticated
    * @header      Authorization Bearer _token required  
    * @bodyParam *user_id integer required Example: 1,2,3 in JSON BODY
    * @bodyParam *category_id integer required Example: 1,2,3 in JSON BODY
    * @bodyParam *sub_cat_id integer required Example: 1,2,3 in JSON BODY
    * @bodyParam *title string require Example: This is title in JSON BODY
    * @bodyParam *description string require Example: This is description in JSON BODY
    *
    * <aside class="notice">basepath/api/v1/review-business-list</aside>
    * @return \Illuminate\Http\Response
    * 
    *
    * @response 200
    * {
            "status": true,
            "status_code": 200,
            "message": "Successfully forum submitted...",
            "data": {
                "user_id": 2,
                "cat_id": 1,
                "sub_cat_id": 1,
                "title": "title",
                "title_slug": "title",
                "description": "desc",
                "created_at": "03-Nov-2023 06:16 PM",
                "id": 3
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
    
    
    
    
    public function createForum(Request $request)
    {
        $all = $request->all();
        $response = $this->forumLib->forumCreate($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    
    
      
    /**
    * commentForum
    * 
    * If everything is okay, you'll get a `200` OK response with data.
    *
    * EX
    *  {
            "user_id":2,
            "forum_id":1,
            "comment":"this is comment"
        }
    * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
    * @method POST
    * @authenticated
    * @header      Authorization Bearer _token required  
    * @bodyParam *user_id integer required Example: 1,2,3 in JSON BODY
    * @bodyParam *forum_id integer required Example: 1,2,3 in JSON BODY
    * @bodyParam *comment string require Example: This is comment in JSON BODY
    *
    * <aside class="notice">basepath/api/v1/comment-forum</aside>
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
                "forum_id": 1,
                "comment": "this is test comment",
                "created_at": "06-Nov-2023 01:14 PM",
                "id": 3
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
    
    
    
    
    public function commentForum(Request $request)
    {
        $all = $request->all();
        $response = $this->forumLib->forumCommentCreate($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    
    


    
    


}
