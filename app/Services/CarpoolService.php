<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Api\V1\BaseController;
use Log;
use App\Models\Forum;
use App\Models\ForumCategory;
use App\Models\ForumSubCategory;
use App\Models\ForumComment;


use App\Models\CarpoolCategory;
use App\Models\CarpoolComment;
use App\Models\Carpool;



use Illuminate\Support\Str;


class CarpoolService
{

    public function __construct()
    {
        $this->status                       = 'status';
        $this->message                      = 'message';
        $this->code                         = 'status_code';
        $this->data                         = 'data';
        $this->total                        = 'total_count';
        

    }
    
    
    /**
        
        * method allCategoryGet()
        * 
        * @param
        * 
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/
    
    public function allCategoryGet()
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                     = CarpoolCategory::where('is_live',1)
                                        ->where('status',1)
                                        ->orderBy('id', 'DESC')->get();


    
        if(count($result)>0)
        {
            $result->makeHidden([
                'slug',
                'created_at',
            ]);
            $result                 = $result->toArray();
            $return[$this->status]  = true;
            $return[$this->message] = 'Successfully your list found..';
            $return[$this->code]    = 200;
            $return[$this->data]    = $result;
        }
        else
        {
            $return[$this->status]  = false;
            $return[$this->message] = 'List not found...';
            $return[$this->code]    = 404;
            $return[$this->data]    = [];
        }


        return $return;
    }

    



    /**
        * method storeCarpool()
        * 
        * @param[]
        *  user_id   
        * 
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/
    
    public function storeCarpool($param)
    {
        $return = [
            $this->status => false,
            $this->message => 'Oops, something went wrong...',
            $this->code => 500,
            $this->data => [],
        ];
        
        try{

            \DB::beginTransaction();

            \DB::beginTransaction();

            $created_at = now();
    
            $carpoolData = [
                'from_country_id' => $param['from_country_id'] ?? null,
                'to_country_id' => $param['to_country_id'] ?? null,
                'from_state_id' => $param['from_state_id'] ?? null,
                'to_state_id' => $param['to_state_id'] ?? null,
                'from_city_id' => $param['from_city_id'] ?? null,
                'to_city_id' => $param['to_city_id'] ?? null,
                'cat_id' => $param['category_id'],
                'user_id' => $param['user_id'],
                'journey_type' => $param['journey_type'],
                'contact_name' => $param['contact_name'],
                'contact_email' => $param['contact_email'],
                'contact_number' => $param['contact_number'],
                'contact_address' => $param['contact_address'],
                'start_date' => $param['start_date'],
                'end_date' => $param['end_date'] ?? null,
                'start_time' => $param['start_time'],
                'end_time' => $param['end_time'] ?? null,
                'flex_date' => $param['flex_date'],
                'flex_time' => $param['flex_time'],
                'flex_location' => $param['flex_location'],
                'created_at' => $created_at,
                'updated_at' => $created_at,
            ];
    
            $carpool = Carpool::create($carpoolData);
    
            \DB::commit();
    
            $return = [
                $this->status => true,
                $this->message => 'Successfully data submitted...',
                $this->code => 200,
                $this->data => $carpool,
            ];

        }
        catch (\Exception $e) {
            \DB::rollBack();
                $response = [
                    $this->status => false,
                    $this->message => 'Oops, please try again...',
                    $this->code => 500,
                    'error' => 'Exception Error...',
                    'exception' => $e->getMessage(),
                ];

                $exception                  = new BaseController();
                $exception                  = $exception->throwExceptionError($response, 500);
        }
        
        return $return;
    }


    




    /**
        * method storeCarpoolComment()
        * 
        * @param[]
        *  user_id    
        *  forum_id
        *  comment   
        * 
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/
    
    public function storeCarpoolComment($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];

        
        try{

            $created_at = now();

            $carpoolComment = CarpoolComment::create([
                'user_id' => $param['user_id'],
                'carpool_id' => $param['carpool_id'],
                'comment' => $param['comment'],
                'created_at' => $created_at,
                'updated_at' => $created_at,
            ]);

            \DB::commit();

            $return = [
                $this->status => true,
                $this->message => 'Successfully comment done...',
                $this->code => 200,
                $this->data => $carpoolComment,
            ];
        }
        catch (\Exception $e) {
            $except['status'] = false;
            $except['error'][] = 'Exception Error...';
            $except['message'] = $e;
            $exception = new BaseController();
            $exception = $exception->throwExceptionError($except, 500);
        }

        return $return;
    }




    /**
        
        * method getAllForumByCategoryId()
        * 
        * @param
        * country_id
        * category_id
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/
    
    public function getAllCarpoolByCategoryId($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                                     = Carpool::with('category')
                                                        ->where('cat_id',$param['category_id'])
                                                        ->where('is_live',1)
                                                        ->where('status',1)
                                                        ->orderBy('id', 'DESC');

        $total_count                                = $result->count();
        $result                                     = $result->simplePaginate(10);
    
    
        if(count($result)>0)
        {
            $result->makeHidden([
                'user_id',
                'cat_id',
                'sub_cat_id',
                'meta_title',
                'meta_description',
                'meta_keywords',
                'display_status',
                'created_at',
            ]);
            $result                 = $result->toArray();
            $return[$this->status]  = true;
            $return[$this->message] = 'Successfully data list found..';
            $return[$this->code]    = 200;
            $return[$this->total]   = $total_count;
            $return[$this->data]    = $result;
        }
        else
        {
            $return[$this->status]  = false;
            $return[$this->message] = 'List not found...';
            $return[$this->code]    = 404;
            $return[$this->data]    = [];
        }


        return $return;
    }




    /**
        
        * method getCarpoolById()
        * 
        * @param
        * carpool_id
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/

    
    
    public function getCarpoolById($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                                     = Carpool::with('category', 'comments.user')
                                                        ->where('is_live',1)
                                                        ->where('id',$param['carpool_id'])                                                     
                                                        ->where('status',1)
                                                        ->orderBy('id', 'DESC')->first();


                                                        
    
        if ($result) 
        {
            $result->makeHidden([
                'user_id',
                'cat_id',
            ]);
            $return[$this->status] = true;
            $return[$this->message] = 'Successfully data list found..';
            $return[$this->code] = 200;
            $return[$this->data] = $result;
        }
        else
        {
            $return[$this->status]  = false;
            $return[$this->message] = 'List not found...';
            $return[$this->code]    = 404;
            $return[$this->data]    = [];
        }
        return $return;
    }

    


    










}
