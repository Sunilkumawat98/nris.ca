<?php

namespace App\Libraries;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Services\CommonService;
use App\Services\CountryStateCityService;
use Log;


class CountryStateCityLibrary
{

    public function __construct()
    {
        
        $this->commonSer                    = new CommonService();
        $this->countryStateSer              = new CountryStateCityService();
        $this->status                       = 'status';
        $this->message                      = 'message';
        $this->code                         = 'status_code';
        $this->error                        = 'error';
        $this->error_code                   = 'error_code';
        $this->data                         = 'data';
    }

    
    /**
        * @param[]
        * userId
        *
        * @return 
        * 200
        * 
        * @error
        * 404/201
        * 
    **/
    
    public function allCountryGet($param)
    {
        // $this->commonSer->inputValidators('allCountryGet', $param);
        $serviceResponse = $this->countryStateSer->getAllCountryList($param);
        if($serviceResponse[$this->status])
        {
            $return[$this->code] = $serviceResponse[$this->code];
            $return[$this->status] = $serviceResponse[$this->status];
            $return[$this->message] = $serviceResponse[$this->message];
            $return[$this->data] = $serviceResponse[$this->data];
        }
        else
        {
            $return[$this->code] = $serviceResponse[$this->code];
            $return[$this->status] = $serviceResponse[$this->status];
            $return[$this->message] = $serviceResponse[$this->message];
            $return[$this->data] = [];
        }
        
        return $return;
    }
    
   /**
        * @param[]
        * userId
        * countryId
        *
        * @return 
        * 200
        * 
        * @error
        * 404/201
        * 
    **/
    
    public function allStateByCountry($param)
    {
        $this->commonSer->inputValidators('allStateByCountry', $param);
        $serviceResponse = $this->countryStateSer->getAllStateByCountry($param);
        if($serviceResponse[$this->status])
        {
            $return[$this->code] = $serviceResponse[$this->code];
            $return[$this->status] = $serviceResponse[$this->status];
            $return[$this->message] = $serviceResponse[$this->message];
            $return[$this->data] = $serviceResponse[$this->data];
        }
        else
        {
            $return[$this->code] = $serviceResponse[$this->code];
            $return[$this->status] = $serviceResponse[$this->status];
            $return[$this->message] = $serviceResponse[$this->message];
            $return[$this->data] = [];
        }
        
        return $return;
    }
    
    
   /**
        * @param[]
        * userId
        * countryId
        *
        * @return 
        * 200
        * 
        * @error
        * 404/201
        * 
    **/
    
    public function allCityByStateCountry($param)
    {
        $this->commonSer->inputValidators('allCityByStateCountry', $param);
        $serviceResponse = $this->countryStateSer->getAllCityByStateAndCountry($param);

        if($serviceResponse[$this->status])
        {
            $return[$this->code] = $serviceResponse[$this->code];
            $return[$this->status] = $serviceResponse[$this->status];
            $return[$this->message] = $serviceResponse[$this->message];
            $return[$this->data] = $serviceResponse[$this->data];
        }
        else
        {
            $return[$this->code] = $serviceResponse[$this->code];
            $return[$this->status] = $serviceResponse[$this->status];
            $return[$this->message] = $serviceResponse[$this->message];
            $return[$this->data] = [];
        }
        
        return $return;
    }
    
   
    

}
