<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\BlogLibrary;
use App\Http\Controllers\Api\V1\BaseController;

/**
 * @group Blog Related 
 *
 * APIs for managing all Blog related listing and its Category
 */


class BlogController extends BaseController
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
        $this->blogLib                          = new BlogLibrary();
        
        
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
     * <aside class="notice">basepath/api/v1/get-all-blog-category</aside>
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
                    "created_at": "21-Oct-2023 10:51 AM"
                },
                {
                    "id": 1,
                    "name": "Category2",
                    "slug": "category2",
                    "created_at": "21-Oct-2023 10:49 AM"
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
        $response = $this->blogLib->allCategoryGet();

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    


     
   





     
    /**
     * getHomepageBlog
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * 
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * @method GET
     *
     * <aside class="notice">basepath/api/v1/get-all-training-list-by-category-id</aside>
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
                        "id": 2,
                        "title": "Excepturi non tempor",
                        "slug": "excepturi-non-tempor",
                        "description": "Eaque dolor duis eni",
                        "image": "PATH/1697881979_WhatsApp_Image_2023-10-03_at_7.20.49_PM.jpeg",
                        "created_at": "21-Oct-2023 03:22 PM"
                    }
                ],
                "first_page_url": "PATH/get-homepage-blog?page=1",
                "from": 1,
                "next_page_url": "PATH/get-homepage-blog?page=2",
                "path": "PATH/get-homepage-blog",
                "per_page": 1,
                "prev_page_url": null,
                "to": 1
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
    
    
    
    
    public function getHomepageBlog(Request $request)
    {
        $all = $request->all();
        $response = $this->blogLib->homepageBlogGet($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
   





      
    /**
     * getBlogById
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * EX
     *  {
            "blog_id":1
     *  }
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * @method POST
     * @bodyParam *blog_id integer required Example: 1,2,3 in JSON BODY
     *
     * <aside class="notice">basepath/api/v1/get-blog-by-id</aside>
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
                "title": "Natus eos possimus",
                "slug": "natus-eos-possimus",
                "description": "Eos natus non verita",
                "image": "PATH/1697881025_WhatsApp_Image_done(17).jpeg",
                "meta_title": null,
                "meta_description": null,
                "meta_keywords": null,
                "admin_id": 1,
                "created_at": "21-Oct-2023 03:07 PM",
                "category": {
                    "id": 2,
                    "name": "New Blog"
                },
                "admin": {
                    "id": 1,
                    "name": "Super Admin"
                },
                "likes_count": 3,
                "dislikes_count": 1
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
    
    
    
    
    public function getBlogById(Request $request)
    {
        $all = $request->all();
        $response = $this->blogLib->blogByIdGet($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    
    



      
    /**
     * getAllBlog
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * @method GET
     * <aside class="notice">basepath/api/v1/get-all-blog</aside>
     * @return \Illuminate\Http\Response
     * 
     *
     * @response 200
     *  {
            "status": true,
            "status_code": 200,
            "message": "Successfully data list found..",
            "data": {
                "current_page": 1,
                "data": [
                    {
                        "id": 2,
                        "title": "Excepturi non tempor",
                        "slug": "excepturi-non-tempor",
                        "description": "Eaque dolor duis eni",
                        "image": "PATH/1697881979_WhatsApp_Image_2023-10-03_at_7.20.49_PM.jpeg",
                        "created_at": "21-Oct-2023 03:22 PM",
                        "category": {
                            "id": 1,
                            "name": "Category1"
                        }
                    },
                    {
                        "id": 1,
                        "title": "Natus eos possimus",
                        "slug": "natus-eos-possimus",
                        "description": "Eos natus non verita",
                        "image": "PATH/1697881025_WhatsApp_Image_done(17).jpeg",
                        "created_at": "21-Oct-2023 03:07 PM",
                        "category": {
                            "id": 2,
                            "name": "Category2"
                        }
                    }
                ],
                "first_page_url": "PATH/get-all-blog?page=1",
                "from": 1,
                "next_page_url": null,
                "path": "PATH/get-all-blog",
                "per_page": 15,
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
    
    
    
    
    public function getAllBlog()
    {
        // $all = $request->all();
        $response = $this->blogLib->allBlogGet();

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    
    
    
   


/**
     * getBlogByCategory
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * EX
     *  {
            "category_id":1
     *  }
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * @method POST
     * @bodyParam *category_id integer required Example: 1,2,3 in JSON BODY
     *
     * <aside class="notice">basepath/api/v1/get-blog-by-category</aside>
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
                    "id": 2,
                    "title": "Excepturi non tempor",
                    "slug": "excepturi-non-tempor",
                    "description": "Eaque dolor duis eni",
                    "image": "PATH/1697881979_WhatsApp_Image_2023-10-03_at_7.20.49_PM.jpeg",
                    "created_at": "21-Oct-2023 03:22 PM",
                    "category": {
                        "id": 1,
                        "name": "Category1"
                    }
                },
                {
                    "id": 1,
                    "title": "Natus eos possimus",
                    "slug": "natus-eos-possimus",
                    "description": "Eos natus non verita",
                    "image": "PATH/1697881025_WhatsApp_Image_done(17).jpeg",
                    "created_at": "21-Oct-2023 03:07 PM",
                    "category": {
                        "id": 1,
                        "name": "Category1"
                    }
                }
            ],
            "first_page_url": "PATH/get-blog-by-category?page=1",
            "from": 1,
            "next_page_url": null,
            "path": "PATH/v1/get-blog-by-category",
            "per_page": 15,
            "prev_page_url": null,
            "to": 2
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
    
    
    
    
     public function getBlogByCategory(Request $request)
     {
         $all = $request->all();
         $response = $this->blogLib->blogByCategoryGet($all);
 
         if (!$response[$this->status]) {
             return $this->sendError($response[$this->message], $response[$this->code]);
         }
         
         return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
     }
     





      
/**
 * blogLike
 * 
 * If everything is okay, you'll get a `200` OK response with data.
 *
 * EX
 *  {
        "blog_id":1,
        "user_id:1
    *  }
    * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
    * @method POST
    * @authenticated
    * @header      Authorization Bearer _token required  
    * @bodyParam *blog_id integer required Example: 1,2,3 in JSON BODY
    * @bodyParam *user_id integer required Example: 1,2,3 in JSON BODY
    *
    * <aside class="notice">basepath/api/v1/blog-like</aside>
    * @return \Illuminate\Http\Response
    * 
    *
    * @response 200
    * {
            "status": true,
            "status_code": 200,
            "message": "Successfully liked...",
            "data": []
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




    public function blogLike(Request $request)
    {
        $all = $request->all();
        $response = $this->blogLib->likeBlog($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }


    
/**
 * blogDisLike
 * 
 * If everything is okay, you'll get a `200` OK response with data.
 *
 *  EX
 *  {
        "blog_id":1,
        "user_id:1
    }
    * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
    * @method POST
    * @authenticated
    * @header      Authorization Bearer _token required  
    * @bodyParam *blog_id integer required Example: 1,2,3 in JSON BODY
    * @bodyParam *user_id integer required Example: 1,2,3 in JSON BODY
    *
    * <aside class="notice">basepath/api/v1/blog-dislike</aside>
    * @return \Illuminate\Http\Response
    * 
    *
    * @response 200
    * {
            "status": true,
            "status_code": 200,
            "message": "Successfully disliked...",
            "data": []
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




    public function blogDisLike(Request $request)
    {
        $all = $request->all();
        $response = $this->blogLib->dislikeBlog($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    


}
