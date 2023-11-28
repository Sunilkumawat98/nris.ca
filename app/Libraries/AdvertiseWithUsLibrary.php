<?php

namespace App\Libraries;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Services\CommonService;
use App\Services\AdvertiseWithUsService;

 
use Log;


class AdvertiseWithUsLibrary
{

    public function __construct()
    {
        $this->commonSer                        = new CommonService();        
        $this->advertiseSer                     = new AdvertiseWithUsService();        
        $this->status                           = 'status';
        $this->message                          = 'message';
        $this->code                             = 'status_code';
        $this->error                            = 'error';
        $this->error_code                       = 'error_code';
        $this->data                             = 'data';
        $this->total                            = 'total_count';
    }

    
    
    

    public function advertiseWithUsCreate($param)
    {
        $this->commonSer->inputValidators('advertiseWithUsCreate', $param);
        $serviceResponse                        = $this->advertiseSer->storeAdvertiseWithUS($param);
        
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
    
    

    public function homePageGifAdsGet($param)
    {
        $this->commonSer->inputValidators('homePageGifAdsGet', $param);
        $serviceResponse                        = $this->advertiseSer->allhomepageGifGet($param);
        
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
