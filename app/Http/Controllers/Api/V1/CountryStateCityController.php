<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\CountryStateCityLibrary;
use App\Http\Controllers\Api\V1\BaseController;

/**
 * @group Country State & City
 *
 * APIs for managing all country, state, city
 */

class CountryStateCityController extends BaseController
{
    public function __construct()
    {
        $this->code                     = 'status_code';
        $this->status                   = 'status';
        $this->result                   = 'result';
        $this->message                  = 'message';
        $this->data                     = 'data';
        $this->total                    = 'total_count';
        $this->countryStateLibObj       = new CountryStateCityLibrary();
    }
    
    
    

    
    /**
     * 
     * 
     * 
     * 
     * getAllCountry
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and a response not found!
     *
     *
     *
     * <aside class="notice">basepath/api/v1/get-all-country</aside>
     *
     *
     * @return \Illuminate\Http\Response
     *
     * @response 200
     *  {
            "status": true,
            "status_code": 200,
            "message": "Successfully country list get...",
            "data": [
                {
                    "id": 1,
                    "name": "USA",
                    "color": "#16b19f",
                    "code": "us",
                    "domain": "usa",
                    "image": "152194054262639fda95ac05.12411768.jpg",
                    "c_meta_title": "Indian Website for Nris in USA",
                    "c_meta_description": "An Indian community website for all NRIS residing in United States. Get information on local real estate, Indian movies, restaurants, visiting spots etc.",
                    "c_meta_keywords": "Indian websites in USA, NRI websites, Indian community websites, classified website for NRIS in USA, free ads website",
                },
                {
                    "id": 2,
                    "name": "Canada",
                    "color": "#990d00",
                    "code": "ca",
                    "domain": "canada",
                    "image": "47659423262639bd6a30242.39786820.jpg",
                    "c_meta_title": "Indian Website for Nris in Canada",
                    "c_meta_description": "An Indian community website for all NRIS residing in Canada . Get information on",
                    "c_meta_keywords": "Indian websites in Canada, NRI websites, Indian community websites, classified website for NRIS in Canada, free ads website",
                }
            ]
        }
     *
     *
     * 

        @response 404
        {
            "status": false,
            "status_code": 404,
            "message": "Country not found...",
            "data": []
        }
     *
     *
     *
     */
    
    public function getAllCountry(Request $request)
    {

        $path = config('app.url');

        $all = $request->all();
        
        $response = $this->countryStateLibObj->allCountryGet($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }



    
    /**
     * getAllStateByCountry
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and a response not found!
     *
     * EX
     *  {
            "country_id":1
        }
     *
     * <aside class="note">basepath/api/v1/get-all-state-by-country</aside>
     *
     * @bodyParam *country_id integer required Example: 1,2,3 in JSON BODY
     * @param \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     *
     * @response 200
     *  {
            "status": true,
            "status_code": 200,
            "message": "Successfully state list get...",
            "data": [
                {
                    "id": 3,
                    "name": "Aberconwy and Colwyn",
                    "code": "AC",
                    "domain": "aberconwyandcolwyn",
                    "description": "Aberconwy and Colwyn",
                    "logo": "",
                    "s_meta_title": "",
                    "s_meta_description": "",
                    "s_meta_keywords": "",
                    "header_image": "NULL",
                    "header_image2": "NULL",
                    "header_image3": "NULL",
                    "created_by": "NULL"
                },
                {
                    "id": 5,
                    "name": "Aberdeen City",
                    "code": "ADC",
                    "domain": "aberdeencity",
                    "description": "Aberdeen City",
                    "logo": "",
                    "s_meta_title": "",
                    "s_meta_description": "",
                    "s_meta_keywords": "",
                    "header_image": "NULL",
                    "header_image2": "NULL",
                    "header_image3": "NULL",
                    "created_by": "NULL"
                }
            ]
        }
     *
     *

        @response 404
        {
            "status": false,
            "status_code": 404,
            "message": "State not found...",
            "data": []
        }
     *
     *
     *
     */
    
    public function getAllStateByCountry(Request $request)
    {
        $all = $request->all();
        
        $response = $this->countryStateLibObj->allStateByCountry($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }




    
    /**
     * getAllCityByStateAndCountry
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and a response not found!
     *
     *  {
            "country_id":101,
            "state_id":4037
        }
     * <aside class="notice">basepath/api/v1/get-all-city-by-state-and-country</aside>
     *
     * @bodyParam *country_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *state_id integer required Example: 1,2,3 in JSON BODY
     * @param \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     *
     * @response 200
     *  
        {
            "status": true,
            "status_code": 200,
            "message": "Successfully city list get...",
            "data": [
                {
                    "id": 1,
                    "name": "Airdrie",
                    "state_code": "AB"
                },
                {
                    "id": 2,
                    "name": "Brooks",
                    "state_code": "AB"
                }
            ]
        }
     
     *
     *
     * 

        @response 404
        {
            "status": false,
            "status_code": 404,
            "message": "City Not Found...",
            "data": []
        }
     *
     *
     *
     */
    
    public function getAllCityByStateAndCountry(Request $request)
    {
        $all = $request->all();
        
        $response = $this->countryStateLibObj->allCityByStateCountry($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }




    

    
    
    
}
