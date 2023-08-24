<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\MovieRelatedLibrary;
use App\Http\Controllers\Api\V1\BaseController;

/**
 * @group allMovieRelated Related
 *
 * APIs for managing all movie related
 */


class MovieRelatedController extends BaseController
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
        $this->movieRelatedLib = new MovieRelatedLibrary();
        
        
    }
    
      
    /**
     * getMovieRatings
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     * 
     *
     * <aside class="notice">basepath/api/v1/get-movie-ratings</aside>
     * @method GET
     * @return \Illuminate\Http\Response
     *
     * @response 200
     *  {
            "status": true,
            "status_code": 200,
            "message": "Successfully ratings found..",
            "data": [
                {
                    "id": 2,
                    "name": "Bro Telugu",
                    "slug": "bro-telugu",
                    "rating_data": "{\"1\": [\"4.75\", \"https://wwww.url2.com\"], \"2\": [\"3.25\", \"https://wwww.url2.com\"], \"3\": [\"4.5\", \"https://wwww.url5.com\"]}",
                    "image": "http://localhost/upload/image-data/MOVIE_RATING_IMAGE/1692883260__turing.png",
                    "created_at": "05-Aug-2023 10:41 AM"
                },
                {
                    "id": 1,
                    "name": "Bro Hindi",
                    "slug": "bro-hindi",
                    "rating_data": "{\"1\": [\"4.75\", \"https://wwww.url2.com\"], \"2\": [\"3.25\", \"https://wwww.url2.com\"], \"3\": [\"4.5\", \"https://wwww.url5.com\"]}",
                    "image": "http://localhost/upload/image-data/MOVIE_RATING_IMAGE/1692883260__turing.png",
                    "created_at": "05-Aug-2023 10:28 AM"
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
    
    
    
    
    public function getMovieRatings()
    {
        // $all = $request->all();
        $response = $this->movieRelatedLib->movieRatingsGet();

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    


      
    /**
     * getAllMovieRatings
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     * 
     *
     * <aside class="notice">basepath/api/v1/get-all-movie-ratings</aside>
     * @method GET
     * @return \Illuminate\Http\Response
     *
     * @response 200
     *  {
            "status": true,
            "status_code": 200,
            "message": "Successfully ratings found..",
            "data": {
                "current_page": 1,
                "data": [
                        {
                            "id": 2,
                            "name": "Bro Telugu",
                            "slug": "bro-telugu",
                            "rating_data": "{\"1\": [\"4.75\", \"https://wwww.url2.com\"], \"2\": [\"3.25\", \"https://wwww.url2.com\"], \"3\": [\"4.5\", \"https://wwww.url5.com\"]}",
                            "created_at": "05-Aug-2023 10:41 AM"
                        },
                        {
                            "id": 1,
                            "name": "Bro Hindi",
                            "slug": "bro-hindi",
                            "rating_data": "{\"1\": [\"4.75\", \"https://wwww.url2.com\"], \"2\": [\"3.25\", \"https://wwww.url2.com\"], \"3\": [\"4.5\", \"https://wwww.url5.com\"]}",
                            "created_at": "05-Aug-2023 10:28 AM"
                        }
                    ]
                ],
                "first_page_url": "http://PATH/api/v1/get-all-movie-ratings?page=1",
                "from": 1,
                "next_page_url": null,
                "path": "http://PATH/api/v1/get-all-movie-ratings",
                "per_page": 15,
                "prev_page_url": null,
                "to": 2
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
    
    
    
    
    public function getAllMovieRatings()
    {
        $response = $this->movieRelatedLib->allMovieRatingsGet();

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    





    /**
     * getAllDesiMovies
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     * 
     *
     * <aside class="notice">basepath/api/v1/get-all-desi-movies</aside>
     * @method POST
     * @bodyParam *country_id       required integer     Ex 1/2/3
     * @bodyParam *state_id         required integer     Ex 1/2/3
     * @return \Illuminate\Http\Response
     *
     * @response 200
     *  {
            "status": true,
            "status_code": 200,
            "message": "Successfully Desi movies found..",
            "data": {
                "current_page": 1,
                "data": [
                    {
                        "id": 4,
                        "country_id": 1,
                        "state_id": 1,
                        "city_id": 1,
                        "address": "ADDRESS",
                        "name": "Bro movie",
                        "slug": "bro-movie",
                        "description": null,
                        "url": "https://www.youtube.com/watch?v=L_nN1P297N0&t=19s",
                        "image": "http://PATH/DESI_MOVIE_IMAGE/1691470622_bhadmegali.jpeg",
                        "start_date": "09/08/2023",
                        "end_date": "30/09/2023",
                        "additional_info": "[{\"cast\":\"arjun rampal, rani, ajay \"},{\"director\":\"ajay\"}, {\"duaration\": \"1 ghanta\"} ]",
                        "meta_title": "META TITLE",
                        "meta_description": "META DESC",
                        "meta_keywords": "META KEY",
                        "created_at": "08-Aug-2023 04:57 AM"
                    }
                ],
                "first_page_url": "http://PATH/api/v1/get-all-desi-movies?page=1",
                "from": 1,
                "next_page_url": null,
                "path": "http://PATH/api/v1/get-all-desi-movies",
                "per_page": 15,
                "prev_page_url": null,
                "to": 1
            }

     *  }
     *
     *
     * @response 404
     *  {
            "status": false,
            "status_code": 404,
            "message": "Desi movies not found...",
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
    
    
    
    
    public function getAllDesiMovies(Request $request)
    {
        $all                    = $request->all();
    
        $response = $this->movieRelatedLib->allDesiMoviesGet($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
     




    /**
     * getLatestDesiMovies
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     * 
     *
     * <aside class="notice">basepath/api/v1/get-latest-desi-movies</aside>
     * @method POST
     * @bodyParam *country_id       required integer     Ex 1/2/3
     * @bodyParam *state_id         required integer     Ex 1/2/3
     * @return \Illuminate\Http\Response
     *
     * @response 200
     *  {
            "status": true,
            "status_code": 200,
            "message": "Successfully desi movies found..",
            "data": {
                "id": 4,
                "country_id": 1,
                "state_id": 1,
                "city_id": 1,
                "address": "ADDRESS",
                "name": "Bro movie",
                "slug": "bro-movie",
                "description": null,
                "url": "https://www.youtube.com/watch?v=L_nN1P297N0&t=19s",
                "image": "http://IMAGE_PATH/1691470622_bhadmegali.jpeg",
                "start_date": "09/08/2023",
                "end_date": "30/09/2023",
                "additional_info": "[{\"cast\":\"arjun rampal, rani, ajay \"},{\"director\":\"ajay\"}, {\"duaration\": \"1 ghanta\"} ]",
                "meta_title": "META TITLE",
                "meta_description": "META DESC",
                "meta_keywords": "META KEY",
                "created_at": "08-Aug-2023 04:57 AM"
            }


     *  }
     *
     *
     * @response 404
     *  {
            "status": false,
            "status_code": 404,
            "message": "Desi movies not found...",
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
    
    
    
    
     public function getLatestDesiMovies(Request $request)
     {
         $all                    = $request->all();
     
         $response = $this->movieRelatedLib->latestDesiMoviesGet($all);
 
         if (!$response[$this->status]) {
             return $this->sendError($response[$this->message], $response[$this->code]);
         }
         
         return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
     }
      
  
 
    


}
