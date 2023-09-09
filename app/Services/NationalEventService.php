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
use App\Models\NationalEvent;
use App\Models\EventCategory;
use App\Models\BusinessSubCategory;
use App\Models\EventComment;

use App\Exceptions;
use Illuminate\Support\Str;


class NationalEventService
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
        
        $result                     = EventCategory::where('is_live',1)
                                        ->where('status',1)
                                        ->orderBy('id', 'DESC')->get();


    
        if(count($result)>0)
        {
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
        
        * method allSubCategoryByIdGet()
        * 
        * @param
        * category_id
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/
    
    public function getEventListingByCategoryId($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                                     = EventCategory::
                                                        with(['category_data' => function ($query) use ($param) {
                                                            $query->where('country_id', $param['country_id'])
                                                            ->take(4)->orderBy('id', 'DESC');
                                                        }])
                                                        ->where('is_live',1)
                                                        ->where('status',1)
                                                        ->orderBy('id', 'DESC')->get();
    
        if(count($result)>0)
        {
            $result                 = $result->toArray();
            $return[$this->status]  = true;
            $return[$this->message] = 'Successfully data list found..';
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
        
        * method getAllEventListingByCategoryId()
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
    
    public function getAllEventListingByCategoryId($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                                     = NationalEvent::where('country_id', $param['country_id'])
                                                        ->where('state_id', $param['state_id'])
                                                        ->where('cat_id',$param['category_id'])
                                                        ->where('is_live',1)
                                                        ->where('status',1)
                                                        ->orderBy('id', 'DESC');

        $total_count                                = $result->count();
        $result                                     = $result->simplePaginate(10);
    
    
        if(count($result)>0)
        {
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
        
        * method getEventListingById()
        * 
        * @param
        * business_list_id
        * country_id
        * state_id
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/
    
    public function getEventListingById($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                                     = NationalEvent::with(['comments.user' => function ($query) use ($param) {
                                                            $query->where('country_id', $param['country_id'])
                                                                ->where('state_id', $param['state_id'])
                                                                ->orderBy('id', 'DESC');
                                                        }])
                                                        ->where('is_live',1)
                                                        ->where('id',$param['event_id'])
                                                        ->where('country_id',$param['country_id'])
                                                        ->where('state_id',$param['state_id'])
                                                        ->where('status',1)
                                                        ->orderBy('id', 'DESC')->first();


                                                        
    
        if ($result) 
        {
            
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

    


    /**
        * method storeEventListingComment()
        * 
        * @param[]
        *  user_id    
        *  event_id    
        *  country_id    
        *  state_id
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
    
    public function storeEventListingComment($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];

        
        try{

            \DB::beginTransaction();
            $created_at                             = date("Y-m-d H:i:s");
            $eventListCommt                         = new EventComment;
            $eventListCommt->user_id                = $param['user_id'];
            $eventListCommt->event_list_id          = $param['event_id'];
            $eventListCommt->country_id             = $param['country_id'];
            $eventListCommt->state_id               = $param['state_id'];
            $eventListCommt->comment                = $param['comment'];
            $eventListCommt->created_at             = $created_at;
            $eventListCommt->updated_at             = $created_at;
            
            $store                                  = $eventListCommt->save();
            \DB::commit();

        }
        catch (Exception $e) {
            $except['status'] = false;
            $except['error'][] = 'Exception Error...';
            $except['message'] = $e;
            $exception = new BaseController();
            $exception = $exception->throwExceptionError($except, 500);
        }
        

        
        if($store)
        {
            $return[$this->status]                  = true;
            $return[$this->message]                 = 'Successfully comment done...';
            $return[$this->code]                    = 200;
            $return[$this->data]                    = $eventListCommt;
        }


        return $return;
    }





}
