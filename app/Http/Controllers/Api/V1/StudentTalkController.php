<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\StudentTalkLibrary;
use App\Http\Controllers\Api\V1\BaseController;

/**
 * @group StudentTalk Related
 *
 * APIs for managing all student talk and its reply related
 */


class StudentTalkController extends BaseController
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
        $this->studentLib = new StudentTalkLibrary();
        
        
    }
    
   

    /**
     * getAllStudnetTalkCategory
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     * 
     *
     * <aside class="notice">basepath/api/v1/get-all-studnet-talk-category</aside>
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
                    "name": "Accomodation",
                    "slug": "accomodation",
                    "created_at": "19-Sep-2023 12:58 PM"
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





    
    public function getAllStudentTalkCategory()
    {
        // $all = $request->all();
        $response = $this->studentLib->allStudentCategoryGet();

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    
    

    
    /**
     * getAllUniversity
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     * EX
     *  {
            "country_id":1,
            "state_id":2
        }
     *
     * <aside class="notice">basepath/api/v1/get-all-university</aside>
     * @method POST
     * @bodyParam *country_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *state_id integer required Example: 1,2,3 in JSON BODY
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
                            "country_id": 1,
                            "state_id": 2,
                            "cat_id": 1,
                            "user_id": 2,
                            "name": "test4",
                            "slug": "test4",
                            "website": "www.websitelink.com",
                            "education_field": "BCA",
                            "message": "Nice great university",
                            "created_at": "19-Sep-2023 05:27 PM"
                        },
                        {
                            "id": 5,
                            "country_id": 1,
                            "state_id": 2,
                            "cat_id": 1,
                            "user_id": 2,
                            "name": "Test",
                            "slug": "test",
                            "website": "www.websitelink.com",
                            "education_field": "BCA",
                            "message": "mast great university",
                            "created_at": "19-Sep-2023 05:49 PM"
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
     *
     */
    
    
    
    
    public function getAllUniversity(Request $request)
    {
        $all = $request->all();
        $response = $this->studentLib->allUniversityGet($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    






    
    /**
     * addUniversityStudent
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
            "category_id":1,
            "name":"King Salman University",
            "website":"www.websitelink.com",
            "education_field":"BCA",
            "message":"Nice university"
        }
     *
     * <aside class="notice">basepath/api/v1/add-student-university</aside>
     * @method POST
     * @authenticated
     * @header      Authorization Bearer _token required  
     * @bodyParam *user_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *country_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *state_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *category_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *name string required Example: 'This is test name' in JSON BODY
     * @bodyParam *message string required Example: 'This is test message' in JSON BODY
     * @bodyParam *website string required Example: 'www.universitylink.com' in JSON BODY
     * @bodyParam *education_field string required Example: 'Any educational degree' in JSON BODY
     * @return \Illuminate\Http\Response
     *
     * @response 200
     *  {
            "status": true,
            "status_code": 200,
            "message": "Successfully Nris talk created...",
            "data": {
                "country_id": 1,
                "state_id": 1,
                "user_id": 2,
                "cat_id": 1,
                "name": "Test University",
                "slug": "test-university",
                "website": "www.websitelink.com",
                "education_field": "BCA",
                "message": "Nice university",
                "created_at": "19-Sep-2023 05:24 PM",
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
    
    
    
    
     public function addUniversityStudent(Request $request)
     {
         $all = $request->all();
         $response = $this->studentLib->studentUniversityCreate($all);
 
         if (!$response[$this->status]) {
             return $this->sendError($response[$this->message], $response[$this->code]);
         }
         
         return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
     }
     
 
 
 

     


   
    
    /**
     * createStudentTalk
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
            "category_id":1,
            "university_id":3,
            "title":"this is testing title",
            "email":"test@email.com",
            "mobile":"9899998987",
            "address":"test address"
        }
     *
     * <aside class="notice">basepath/api/v1/create-student-talk</aside>
     * @method POST
     * @authenticated
     * @header      Authorization Bearer _token required  
     * @bodyParam *user_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *country_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *state_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *category_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *university_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *email email required Example: 'This is test title' in JSON BODY
     * @bodyParam *mobile number required Example: '9998****12' in JSON BODY
     * @bodyParam *address string Example: 'This is test address' in JSON BODY
     * @bodyParam other_details string Example: 'This is test other_details' in JSON BODY
     * @bodyParam meta_title string Example: 'This is test meta_title' in JSON BODY
     * @bodyParam meta_description string Example: 'This is test meta_description' in JSON BODY
     * @bodyParam meta_keywords string Example: 'This is test meta_keywords' in JSON BODY
     * 
     * 
     * @return \Illuminate\Http\Response
     *
     * @response 200
     * {
            "status": true,
            "status_code": 200,
            "message": "Successfully student talk created...",
            "data": {
                "country_id": 1,
                "state_id": 1,
                "user_id": 2,
                "cat_id": 1,
                "university_id": 3,
                "title": "this is testing title",
                "email": "test@email.com",
                "mobile": "9899998987",
                "address": "test address",
                "details": 'na',
                "other_details": 'na',
                "meta_title": 'na',
                "meta_description": 'na',
                "meta_keywords": 'na',
                "created_at": "21-Sep-2023 01:24 PM",
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
    
    
    
    
    public function createStudentTalk(Request $request)
    {
        $all = $request->all();
        $response = $this->studentLib->studentTalkCreate($all);

        if (!$response[$this->status]) {
            return $this->sendError($response[$this->message], $response[$this->code]);
        }
        
        return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
    }
    





    
    /**
     * getAllStudentTalk
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     * EX
     *  {
            "country_id":1,
            "state_id":2
        }
     *
     * <aside class="notice">basepath/api/v1/get-all-student-talk</aside>
     * @method POST
     * @bodyParam *country_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *state_id integer required Example: 1,2,3 in JSON BODY
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
                        "id": 8,
                        "country_id": 1,
                        "state_id": 1,
                        "cat_id": 2,
                        "university_id": 4,
                        "user_id": 2,
                        "title": "test title",
                        "email": "test@email.com",
                        "mobile": "9899998987",
                        "address": "test address",
                        "details": "NA",
                        "other_details": "NA",
                        "meta_title": "NA",
                        "meta_description": "NA",
                        "meta_keywords": "NA",
                        "created_at": "21-Sep-2023 03:49 PM"
                    },
                    {
                        "id": 3,
                        "country_id": 1,
                        "state_id": 1,
                        "cat_id": 1,
                        "university_id": 3,
                        "user_id": 2,
                        "title": "this is testing title",
                        "email": "test@email.com",
                        "mobile": "9899998987",
                        "address": "test address",
                        "details": "0",
                        "other_details": "0",
                        "meta_title": "0",
                        "meta_description": "0",
                        "meta_keywords": "0",
                        "created_at": "21-Sep-2023 01:24 PM"
                    }
                ],
                "first_page_url": "PATH/api/v1/get-all-student-talk?page=1",
                "from": 1,
                "next_page_url": null,
                "path": "PATH/api/v1/get-all-student-talk",
                "per_page": 10,
                "prev_page_url": null,
                "to": 5
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
     */
    
    
    
    
     public function getAllStudentTalk(Request $request)
     {
         $all = $request->all();
         $response = $this->studentLib->allStudentTalkFetch($all);
 
         if (!$response[$this->status]) {
             return $this->sendError($response[$this->message], $response[$this->code]);
         }
         
         return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
     }
     
    
    /**
     * getStudentTalkByCategory
     * 
     * If everything is okay, you'll get a `200` OK response with data.
     *
     * Otherwise, the request will fail with a `404` error, and Profile not found and token related response...
     * 
     * EX
     *  {
            "country_id":1,
            "state_id":2
        }
     *
     * <aside class="notice">basepath/api/v1/get-student-talk-by-category</aside>
     * @method POST
     * @bodyParam *country_id integer required Example: 1,2,3 in JSON BODY
     * @bodyParam *state_id integer required Example: 1,2,3 in JSON BODY
     * @return \Illuminate\Http\Response
     *
     * @response 200
     *  {
            "status": true,
            "status_code": 200,
            "message": "Successfully data list found..",
            "data": [
                {
                    "id": 2,
                    "name": "Accomodation",
                    "slug": "accomodation",
                    "created_at": "19-Sep-2023 12:58 PM",
                    "category_data": [
                        {
                            "id": 8,
                            "country_id": 1,
                            "state_id": 1,
                            "cat_id": 2,
                            "university_id": 4,
                            "user_id": 2,
                            "title": "category 2 only new title this is  for testing title",
                            "email": "test@email.com",
                            "mobile": "9899998987",
                            "address": "test address",
                            "details": "0",
                            "other_details": "0",
                            "meta_title": "0",
                            "meta_description": "0",
                            "meta_keywords": "0",
                            "created_at": "21-Sep-2023 03:49 PM",
                            "country": {
                                "id": 1,
                                "name": "USA",
                                "color": "#ef8888",
                                "code": "US",
                                "domain": "usa",
                                "image": "NA",
                                "c_meta_title": "US META",
                                "c_meta_description": "US DESC",
                                "c_meta_keywords": "US KEY",
                                "created_at": null
                            },
                            "state": {
                                "id": 1,
                                "name": "Alaska",
                                "code": "AL",
                                "domain": "alaska",
                                "description": "AL desc",
                                "logo": "NA",
                                "s_meta_title": "Al title",
                                "s_meta_description": "AL META",
                                "s_meta_keywords": "AL key",
                                "header_image": "NULL",
                                "header_image2": "NULL",
                                "header_image3": "NULL"
                            }
                        }
                    ] 
                },
                {
                    "id": 1,
                    "name": "Campus Job",
                    "slug": "campus-job",
                    "created_at": "19-Sep-2023 12:38 PM",
                    "category_data": []
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
     *
     */
    
    
    
    
     public function getStudentTalkByCategory(Request $request)
     {
         $all = $request->all();
         $response = $this->studentLib->studentTalkFetchByCategory($all);
 
         if (!$response[$this->status]) {
             return $this->sendError($response[$this->message], $response[$this->code]);
         }
         
         return $this->sendResponse($response[$this->data], $response[$this->message], $response[$this->code]);
     }
     

    
    
}
