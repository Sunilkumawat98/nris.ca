<?php

namespace App\Services;

use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Exception;
use App\Http\Controllers\Api\V1\BaseController;
use Log;



class CountryStateCityService
{

    public function __construct()
    {
        $this->status                   = 'status';
        $this->message                  = 'message';
        $this->code                     = 'status_code';
        $this->data                     = 'data';
        $this->total                    = 'total_count';
        $this->code_200                 = Response::HTTP_OK;
        $this->code_404                 = Response::HTTP_NOT_FOUND;
        $this->code_500                 = Response::HTTP_INTERNAL_SERVER_ERROR;
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
    
    
    public function getAllCountryList($param)
    {
        $return[$this->status]                  = false;
        $return[$this->message]                 = 'Country not found...';
        $return[$this->code]                    = $this->code_404;
        $return[$this->data]                    = [];
        try{
            $result                                 = Country::all();
            if($result)
            {
                $result                             = $result->toArray();
                $return[$this->status]              = true;
                $return[$this->message]             = 'Successfully country list get...';
                $return[$this->code]                = $this->code_200;
                $return[$this->data]                = $result;
            }
        }
        catch (Exception $e) {
            $except['status'] = false;
            $except['error'][] = 'Exception Error...';
            $except['message'] = $e;
            $exception = new BaseController();
            $exception = $exception->throwExceptionError($except, $this->code_500);
            return $e;
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
    
    
    public function getAllStateByCountry($param)
    {
        $return[$this->status]                  = false;
        $return[$this->message]                 = 'State not found...';
        $return[$this->code]                    = $this->code_404;
        $return[$this->data]                    = [];
        

        $result                                 = State::where('country_id', $param['country_id'])->orderBy('name', 'asc')->get();
        

        if(count($result)>0)
        {

            $result                             = $result->toArray();


            $return[$this->status]              = true;
            $return[$this->message]             = 'Successfully state list get...';
            $return[$this->code]                = $this->code_200;
            $return[$this->data]                = $result;
        }
        
        return $return;
    }
    
    
    
    /**
        * @param[]
        * userId
        * countryId
        * stateId
        * 
        * @return 
        * 200
        * 
        * @error
        * 404/201
        * 
    **/
    
    
    public function getAllCityByStateAndCountry($param)
    {
        $return[$this->status]                  = false;
        $return[$this->message]                 = 'City list not found';
        $return[$this->code]                    = $this->code_404;
        $return[$this->data]                    = [];
        

        $result                                 = City::where('state_id', $param['state_id'])
                                                        ->where('country_id', $param['country_id'])
                                                        ->orderBy('name', 'asc')
                                                        ->get();
        
        if(count($result)>0)
        {
            $result                             = $result->toArray();

            $return[$this->status]              = true;
            $return[$this->message]             = 'Successfully city list get...';
            $return[$this->code]                = $this->code_200;
            $return[$this->data]                = $result;
        }
        
        return $return;
    }
    
    
    
    


}
