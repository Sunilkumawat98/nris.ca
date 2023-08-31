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
use App\Models\BusinessCategory;
use App\Models\BusinessSubCategory;
use App\Models\BusinessListing;

use App\Exceptions;
use Illuminate\Support\Str;


class BusinessListingService
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
        
        $result                     = BusinessCategory::where('is_live',1)
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
        
        * method allSubCategoryGet()
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
    
    public function allSubCategoryGet()
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                     = BusinessSubCategory::where('is_live',1)
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
    
    public function allSubCategoryByIdGet($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                     = BusinessSubCategory::where('category_id', $param['category_id'])
                                        ->where('is_live',1)
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
    
    public function getBusinessListingByCategoryId($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                                     = BusinessCategory::
                                                        with(['category_data' => function ($query) use ($param) {
                                                            $query->where('country_id', $param['country_id'])
                                                            ->take(3)->orderBy('id', 'DESC');
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

    




}
