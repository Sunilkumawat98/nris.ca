<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\MovieVideoLibrary;
use App\Http\Controllers\Api\V1\BaseController;

/**
 * @group MovieVideo Related 
 *
 * APIs for managing all MovieVideo related listing and its Category & Language
 */


class MovieVideoController extends BaseController
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
        $this->movieVideoLib                    = new MovieVideoLibrary();
        
        
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
     * <aside class="notice">basepath/api/v1/get-all-movie-video-category</aside>
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
                    "name": "Action"
                },
                {
                    "id": 2,
                    "name": "Horror"
                },
                {
                    "id": 1,
                    "name": "Comedy"
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
        $response = $this->movieVideoLib->allCategoryGet();

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    


     
   
    
      
    /**
     * getAllLanguage
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     * 
     *
     * <aside class="notice">basepath/api/v1/get-all-movie-video-language</aside>
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
                    "name": "Telugu"
                },
                {
                    "id": 2,
                    "name": "English"
                },
                {
                    "id": 1,
                    "name": "Hindi"
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
    
    
    
    
    public function getAllLanguage()
    {
        $response = $this->movieVideoLib->allLanguageGet();

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    


     
   








      
    /**
     * getAllMovieVideo
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * @method GET
     * <aside class="notice">basepath/api/v1/get-all-movie-video</aside>
     * @return \Illuminate\Http\Response
     * 
     *
     * @response 200
     *  {
            "status": true,
            "status_code": 200,
            "message": "Successfully data list found..",
            "data": {
                "total": 4,
                "result": {
                    "current_page": 1,
                    "data": [
                        {
                            "id": 4,
                            "name": "WARCRAFT",
                            "link": "https://www.youtube.com/watch?v=RhFMIRuHAL4",
                            "total_likes": 0,
                            "total_dislikes": 0,
                            "category": {
                                "id": 2,
                                "name": "Horror"
                            }
                        },
                        {
                            "id": 3,
                            "name": "Jai Gangaajal",
                            "link": "https://www.youtube.com/watch?v=pnSqqTrqQFE",
                            "total_likes": 0,
                            "total_dislikes": 0,
                            "category": {
                                "id": 3,
                                "name": "Action"
                            }
                        },
                        {
                            "id": 2,
                            "name": "X-Men: Apocalypse",
                            "link": "https://www.youtube.com/watch?v=COvnHv42T-A",
                            "total_likes": 0,
                            "total_dislikes": 1,
                            "category": {
                                "id": 3,
                                "name": "Action"
                            }
                        },
                        {
                            "id": 1,
                            "name": "Captain America",
                            "link": "https://www.youtube.com/watch?v=FkTybqcX-Yo",
                            "total_likes": 2,
                            "total_dislikes": 2,
                            "category": {
                                "id": 2,
                                "name": "Horror"
                            }
                        }
                    ],
                    "first_page_url": "PATH/get-all-movie-video?page=1",
                    "from": 1,
                    "next_page_url": null,
                    "path": "PATH/get-all-movie-video",
                    "per_page": 10,
                    "prev_page_url": null,
                    "to": 4
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
    
    
    
    
    public function getAllMovieVideo()
    {
        $response = $this->movieVideoLib->allMovieVideoGet();

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    
    
    
   


/**
     * getMovieVideoByCategory
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
     * <aside class="notice">basepath/api/v1/get-movie-video-by-category</aside>
     * @return \Illuminate\Http\Response
     * 
     *
     * @response 200
     * {
            "status": true,
            "status_code": 200,
            "message": "Successfully data list found..",
            "data": {
                "total": 2,
                "result": {
                    "current_page": 1,
                    "data": [
                        {
                            "id": 4,
                            "name": "WARCRAFT",
                            "link": "https://www.youtube.com/watch?v=RhFMIRuHAL4",
                            "total_likes": 0,
                            "total_dislikes": 0,
                            "category": {
                                "id": 2,
                                "name": "Horror"
                            }
                        },
                        {
                            "id": 1,
                            "name": "Captain America",
                            "link": "https://www.youtube.com/watch?v=FkTybqcX-Yo",
                            "total_likes": 2,
                            "total_dislikes": 1,
                            "category": {
                                "id": 2,
                                "name": "Horror"
                            }
                        }
                    ],
                    "first_page_url": "PATH/get-movie-video-by-category?page=1",
                    "from": 1,
                    "next_page_url": null,
                    "path": "PATH/get-movie-video-by-category",
                    "per_page": 10,
                    "prev_page_url": null,
                    "to": 2
                }
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
    
    
    
    
     public function getMovieVideoByCategory(Request $request)
     {
         $all = $request->all();
         $response = $this->movieVideoLib->movieVideoByCategoryGet($all);
 
         if (!$response[$this->status]) {
             return $this->sendError($response[$this->message], $response[$this->code]);
         }
         
         return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
     }
     


/**
     * getMovieVideoByLanguage
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * EX
     *  {
            "language_id":1
     *  }
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * @method POST
     * @bodyParam *language_id integer required Example: 1,2,3 in JSON BODY
     *
     * <aside class="notice">basepath/api/v1/get-movie-video-by-language</aside>
     * @return \Illuminate\Http\Response
     * 
     *
     * @response 200
     * {
            "status": true,
            "status_code": 200,
            "message": "Successfully data list found..",
            "data": {
                "total": 2,
                "result": {
                    "current_page": 1,
                    "data": [
                        {
                            "id": 4,
                            "name": "WARCRAFT",
                            "link": "https://www.youtube.com/watch?v=RhFMIRuHAL4",
                            "total_likes": 0,
                            "total_dislikes": 0,
                            "language": {
                                "id": 1,
                                "name": "Hindi"
                            }
                        },
                        {
                            "id": 3,
                            "name": "Jai Gangaajal",
                            "link": "https://www.youtube.com/watch?v=pnSqqTrqQFE",
                            "total_likes": 0,
                            "total_dislikes": 0,
                            "language": {
                                "id": 1,
                                "name": "Hindi"
                            }
                        }
                    ],
                    "first_page_url": "http://local-nris.ca/api/v1/get-movie-video-by-language?page=1",
                    "from": 1,
                    "next_page_url": null,
                    "path": "http://local-nris.ca/api/v1/get-movie-video-by-language",
                    "per_page": 10,
                    "prev_page_url": null,
                    "to": 2
                }
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
    
    
    
    
     public function getMovieVideoByLanguage(Request $request)
     {
         $all = $request->all();
         $response = $this->movieVideoLib->movieVideoByLanguageGet($all);
 
         if (!$response[$this->status]) {
             return $this->sendError($response[$this->message], $response[$this->code]);
         }
         
         return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
     }
     







/**
     * getMovieVideoByCategoryLanguage
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * EX
     *  {
            "language_id":1,
            "category_id":1
     *  }
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * @method POST
     * @bodyParam *language_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *category_id integer required Example: 1,2,3 in JSON BODY
     *
     * <aside class="notice">basepath/api/v1/get-all-movie-video-by-category-language-id</aside>
     * @return \Illuminate\Http\Response
     * 
     *
     * @response 200
     * {
            "status": true,
            "status_code": 200,
            "message": "Successfully data list found..",
            "data": {
                "total": 1,
                "result": {
                    "current_page": 1,
                    "data": [
                        {
                            "id": 2,
                            "name": "X-Men: Apocalypse",
                            "link": "https://www.youtube.com/watch?v=COvnHv42T-A",
                            "total_likes": 0,
                            "total_dislikes": 1,
                            "language": {
                                "id": 2,
                                "name": "English"
                            },
                            "category": {
                                "id": 3,
                                "name": "Action"
                            }
                        }
                    ],
                    "first_page_url": "PATH/get-all-movie-video-by-category-language-id?page=1",
                    "from": 1,
                    "next_page_url": null,
                    "path": "PATH/get-all-movie-video-by-category-language-id",
                    "per_page": 10,
                    "prev_page_url": null,
                    "to": 1
                }
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
    
    
    
    
     public function getMovieVideoByCategoryLanguage(Request $request)
     {
         $all = $request->all();
         $response = $this->movieVideoLib->movieVideoByLanguageCategoryGet($all);
 
         if (!$response[$this->status]) {
             return $this->sendError($response[$this->message], $response[$this->code]);
         }
         
         return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
     }




/**
     * searchMovieVideo
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * EX
     *  {
            "keyword":text
     *  }
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * @method POST
     * @bodyParam *keyword string required Example: text in JSON BODY
     *
     * <aside class="notice">basepath/api/v1/search-movie-video</aside>
     * @return \Illuminate\Http\Response
     * 
     *
     * @response 200
     * {
            "status": true,
            "status_code": 200,
            "message": "Successfully list get...",
            "data": {
                "total": 1,
                "result": {
                    "current_page": 1,
                    "data": [
                        {
                            "id": 4,
                            "name": "WARCRAFT",
                            "link": "https://www.youtube.com/watch?v=RhFMIRuHAL4",
                            "total_likes": 1,
                            "total_dislikes": 0,
                            "category": {
                                "id": 2,
                                "name": "Horror"
                            }
                        }
                    ],
                    "first_page_url": "PATH/search-movie-video?page=1",
                    "from": 1,
                    "next_page_url": null,
                    "path": "PATH/search-movie-video",
                    "per_page": 10,
                    "prev_page_url": null,
                    "to": 1
                }
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
    
    
    
    
     public function searchMovieVideo(Request $request)
     {
         $all = $request->all();
         $response = $this->movieVideoLib->movieVideoSearch($all);
 
         if (!$response[$this->status]) {
             return $this->sendError($response[$this->message], $response[$this->code]);
         }
         
         return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
     }
     











     





      
/**
 * movieVideoLike
 * 
 * If everything is okay, you'll get a `200` OK response with data.
 *
 * EX
 *  {
        "video_id":1,
        "user_id:1
    *  }
    * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
    * @method POST
    * @authenticated
    * @header      Authorization Bearer _token required  
    * @bodyParam *video_id integer required Example: 1,2,3 in JSON BODY
    * @bodyParam *user_id integer required Example: 1,2,3 in JSON BODY
    *
    * <aside class="notice">basepath/api/v1/movie-video-like</aside>
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




    public function movieVideoLike(Request $request)
    {
        $all = $request->all();
        $response = $this->movieVideoLib->likeVideoMovie($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }


    
/**
 * movieVideoDisLike
 * 
 * If everything is okay, you'll get a `200` OK response with data.
 *
 *  EX
 *  {
        "video_id":1,
        "user_id:1
    }
    * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
    * @method POST
    * @authenticated
    * @header      Authorization Bearer _token required  
    * @bodyParam *video_id integer required Example: 1,2,3 in JSON BODY
    * @bodyParam *user_id integer required Example: 1,2,3 in JSON BODY
    *
    * <aside class="notice">basepath/api/v1/movie-video-dislike</aside>
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




    public function movieVideoDisLike(Request $request)
    {
        $all = $request->all();
        $response = $this->movieVideoLib->disLikeVideoMovie($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    


}
