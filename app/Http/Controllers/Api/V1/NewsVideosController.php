<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\NewsVideosLibrary;
use App\Http\Controllers\Api\V1\BaseController;

/**
 * @group News Videos Related 
 *
 * APIs for managing all News Videos related listing and its Category
 */


class NewsVideosController extends BaseController
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
        $this->newsVideoLib                          = new NewsVideosLibrary();
        
        
    }
    
      
     
    /**
     * getAllHomepageNews
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * 
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * @method GET
     *
     * <aside class="notice">basepath/api/v1/get-homepage-news</aside>
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
                        "title": "title",
                        "slug": "title-slug",
                        "video_link": "https://youtu.be/-NCPiLoLm2c",
                        "description": "description",
                        "created_at": null
                    }
                ],
                "first_page_url": "PATH/get-homepage-news?page=1",
                "from": 1,
                "next_page_url": "PATH/get-homepage-news?page=2",
                "path": "PATH/v1/get-homepage-news",
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
    
    
    
    
    public function getAllHomepageNews(Request $request)
    {
        $all = $request->all();
        $response = $this->newsVideoLib->homepageNewsGet($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
   





      
    /**
     * getNewsById
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * EX
     *  {
            "news_id":1
     *  }
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * @method POST
     * @bodyParam *news_id integer required Example: 1,2,3 in JSON BODY
     *
     * <aside class="notice">basepath/api/v1/get-news-by-id</aside>
     * @return \Illuminate\Http\Response
     * 
     *
     * @response 200
     *  {
            "status": true,
            "status_code": 200,
            "message": "Successfully data found..",
            "data": {
                "id": 1,
                "title": "test tile",
                "slug": "test-title",
                "video_link": "https://youtu.be/QZ1e2bpYbW4",
                "description": "test description",
                "meta_title": "meta title",
                "meta_description": "meta desc",
                "meta_keywords": "meta keyword",
                "created_at": null,
                "suggestions": [
                    {
                        "id": 2,
                        "title": "title",
                        "slug": "title-slug",
                        "video_link": "https://youtu.be/-NCPiLoLm2c",
                        "description": "desc",
                        "meta_title": "meta title",
                        "meta_description": "meta desc",
                        "meta_keywords": "meta key",
                        "created_at": null
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
            "message": "Data not found...",
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
    
    
    
    
    public function getNewsById(Request $request)
    {
        $all = $request->all();
        $response = $this->newsVideoLib->newsByIdGet($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    
    


}
