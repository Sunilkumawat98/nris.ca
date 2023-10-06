<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\SearchLibrary;
use App\Http\Controllers\Api\V1\BaseController;

/**
 * @group Search Related
 *
 * APIs for managing all Search related listing
 */


class SearchController extends BaseController
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
        $this->searchLib                        = new SearchLibrary();
        
        
    }
    
      
    /**
     * getCountrySearch
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     *
     * EX
     *  {
            "country_id":1,
            "keyword":"chiken"
        }
     *
     * <aside class="notice">basepath/api/v1/country-search</aside>
     * @method POST
     * @bodyParam *country_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *keyword string required Example: chiken shop in JSON BODY
     * @return \Illuminate\Http\Response
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
                "first_page_url": "PATH/api/v1/country-search?page=1",
                "from": 1,
                "next_page_url": null,
                "path": "PATH/api/v1/country-search",
                "per_page": 10,
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
    
    
    
    
    public function getCountrySearch(Request $request)
    {
        $all = $request->all();
        $response = $this->searchLib->searchCountry($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    
      
    /**
     * getStateSearch
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     *
     * EX
     *  {
            "country_id":1,
            "state_id":1,
            "keyword":"chiken"
        }
     *
     * <aside class="notice">basepath/api/v1/state-search</aside>
     * @method POST
     * @bodyParam *country_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *state_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *keyword string required Example: chiken shop in JSON BODY
     * @return \Illuminate\Http\Response
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
                "first_page_url": "PATH/api/v1/country-search?page=1",
                "from": 1,
                "next_page_url": null,
                "path": "PATH/api/v1/country-search",
                "per_page": 10,
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
    
    
    
    
    public function getStateSearch(Request $request)
    {
        $all = $request->all();
        $response = $this->searchLib->searchState($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    


     


    
    


}
