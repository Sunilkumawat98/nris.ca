<?php

namespace App\Libraries;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Services\CommonService;
use App\Services\SearchService;
use Log;


class SearchLibrary
{

    public function __construct()
    {
        $this->commonSer                        = new CommonService();        
        $this->searchSer                         = new SearchService();        
        $this->status                           = 'status';
        $this->message                          = 'message';
        $this->code                             = 'status_code';
        $this->error                            = 'error';
        $this->error_code                       = 'error_code';
        $this->data                             = 'data';
        $this->total                            = 'total_count';
    }

    
    
    
    
    
    
    public function searchCountry($param)
    {
        $this->commonSer->inputValidators('searchCountry', $param);
        $serviceResponse                        = $this->searchSer->fetchAllCountrySearch($param);
        
        if($serviceResponse[$this->status])
        {
            $return[$this->code]                = $serviceResponse[$this->code];
            $return[$this->status]              = $serviceResponse[$this->status];
            $return[$this->message]             = $serviceResponse[$this->message];
            $return[$this->data]                = $serviceResponse[$this->data];
        }
        else
        {
            $return[$this->code]                = $serviceResponse[$this->code];
            $return[$this->status]              = $serviceResponse[$this->status];
            $return[$this->message]             = $serviceResponse[$this->message];
            $return[$this->data]                = [];
        }
        return $return;
    }
    
    
    
    
    public function searchState($param)
    {
        $this->commonSer->inputValidators('searchState', $param);
        $serviceResponse                        = $this->searchSer->fetchAllStateSearch($param);
        
        if($serviceResponse[$this->status])
        {
            $return[$this->code]                = $serviceResponse[$this->code];
            $return[$this->status]              = $serviceResponse[$this->status];
            $return[$this->message]             = $serviceResponse[$this->message];
            $return[$this->data]                = $serviceResponse[$this->data];
        }
        else
        {
            $return[$this->code]                = $serviceResponse[$this->code];
            $return[$this->status]              = $serviceResponse[$this->status];
            $return[$this->message]             = $serviceResponse[$this->message];
            $return[$this->data]                = [];
        }
        return $return;
    }
    
    



}
