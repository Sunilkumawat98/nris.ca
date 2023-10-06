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

use App\Models\TrainingPlacementCategory;
use App\Models\TrainingPlacement;
use App\Models\TrainingPlacementComment;

use App\Exceptions;
use Illuminate\Support\Str;


class TrainingPlacementService
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
        
        $result                     = TrainingPlacementCategory::where('is_live',1)
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
        
        * method getTraningPlacementListingByCategoryId()
        * 
        * @param
        * country_id
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/
    
    public function getTraningPlacementListingByCategoryId($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                                     = TrainingPlacementCategory::
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
        
        * method getAllTrainingPlacementListingByCategoryId()
        * 
        * @param
        * country_id
        * state_id
        * category_id
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/
    
    public function getAllTrainingPlacementListingByCategoryId($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                                     = TrainingPlacement::with('country_id', 'state_id', 'cat_id')
                                                        ->where('country_id', $param['country_id'])
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
    
    public function getTrainingListingById($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                                     = TrainingPlacement::with(['comments.user' => function ($query) use ($param) {
                                                            $query->where('country_id', $param['country_id'])
                                                                ->where('state_id', $param['state_id'])
                                                                ->orderBy('id', 'DESC');
                                                        }])
                                                        ->where('is_live',1)
                                                        ->where('id',$param['training_id'])
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
        * method storeTrainingListingComment()
        * 
        * @param[]
        *  user_id    
        *  training_id    
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
    
    public function storeTrainingListingComment($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];

        
        try{

            \DB::beginTransaction();
            $created_at                                = date("Y-m-d H:i:s");
            $trainingListCommt                         = new TrainingPlacementComment;
            $trainingListCommt->user_id                = $param['user_id'];
            $trainingListCommt->training_list_id       = $param['training_id'];
            $trainingListCommt->country_id             = $param['country_id'];
            $trainingListCommt->state_id               = $param['state_id'];
            $trainingListCommt->comment                = $param['comment'];
            $trainingListCommt->created_at             = $created_at;
            $trainingListCommt->updated_at             = $created_at;
            
            $store                                     = $trainingListCommt->save();
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
            $return[$this->data]                    = $trainingListCommt;
        }


        return $return;
    }




    /**
        
        * method fetchTrainingListByUserId()
        * 
        * @param
        * user_id
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/
    
    public function fetchTrainingListByUserId($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                                     = TrainingPlacement::with('cat_id')
                                                        ->where('user_id', $param['user_id'])
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







}
