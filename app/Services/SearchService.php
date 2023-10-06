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


use App\Models\BusinessListing;

use App\Exceptions;
use Illuminate\Support\Str;


class SearchService
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
        
        * method fetchAllCountrySearch()
        * 
        * @param
        * country_id
        * keyword
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/
    
    public function fetchAllCountrySearch($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        

        $searchQuery = $param['keyword'];

        


        $result                                    = BusinessListing::where('country_id', $param['country_id'])
                                                        ->where('is_live',1)
                                                        ->where('status', 1);
        if ($searchQuery) {
            $result->where('name', 'like', '%' . $searchQuery . '%')            
            ->orWhere('contact_address', 'like', '%' . $searchQuery . '%')
            ->orWhere('meta_title', 'like', '%' . $searchQuery . '%')
            ->orWhere('meta_description', 'like', '%' . $searchQuery . '%');
        }

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
        
        * method fetchAllStateSearch()
        * 
        * @param
        * country_id
        * keyword
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/
    
    public function fetchAllStateSearch($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        

        $searchQuery = $param['keyword'];

        


        $result                                    = BusinessListing::where('country_id', $param['country_id'])
                                                        ->where('state_id',$param['state_id'])
                                                        ->where('is_live',1)
                                                        ->where('status', 1);
        if ($searchQuery) {
            $result->where('name', 'like', '%' . $searchQuery . '%')            
            ->orWhere('contact_address', 'like', '%' . $searchQuery . '%')
            ->orWhere('meta_title', 'like', '%' . $searchQuery . '%')
            ->orWhere('meta_description', 'like', '%' . $searchQuery . '%');
        }

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
