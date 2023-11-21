<?php

namespace App\Libraries;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Services\CommonService;
use App\Services\ClasifiedCategoryService;

 
use Log;


class ClasifiedCategoryLibrary
{

    public function __construct()
    {
        $this->commonSer                        = new CommonService();        
        $this->clasifiedCatServ                 = new ClasifiedCategoryService();        
        $this->status                           = 'status';
        $this->message                          = 'message';
        $this->code                             = 'status_code';
        $this->error                            = 'error';
        $this->error_code                       = 'error_code';
        $this->data                             = 'data';
        $this->total                            = 'total_count';
    }

    
    
    /*

        Category

    */
    
    
    public function allCategoryGet()
    {
        $serviceResponse                        = $this->clasifiedCatServ->allCategoryGet();
        
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
    
    
    
    public function allSubCategoryGet()
    {
        $serviceResponse                        = $this->clasifiedCatServ->allSubCategoryGet();
        
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
    
    
    
    public function allCategoryByIdGet($param)
    {
        $this->commonSer->inputValidators('allCategoryByIdGet', $param);
        $serviceResponse                        = $this->clasifiedCatServ->allSubCategoryByIdGet($param);
        
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
    
    
    
    
    



    public function allSubSubCategoryGet()
    {
        $serviceResponse                        = $this->clasifiedCatServ->allSubSubCategoryGet();
        
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
    

    public function getAllSubSubCategoryUnderSubCategory($param)
    {
        $this->commonSer->inputValidators('getAllSubSubCategoryUnderSubCategory', $param);
        $serviceResponse                        = $this->clasifiedCatServ->allSubSubCategoryUnderSubCategoryGet($param);
        
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
    



    public function freeClasifiedCreate($param)
    {
        $this->commonSer->inputValidators('freeClasifiedCreate', $param);
        $serviceResponse                        = $this->clasifiedCatServ->storeFreeClasified($param);
        
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
    
    
    
    
    public function freeClasifiedBidCreate($param)
    {
        $this->commonSer->inputValidators('freeClasifiedBidCreate', $param);
        $serviceResponse                        = $this->clasifiedCatServ->storeFreeClasifiedBid($param);
        
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
    

    
    public function freeClasifiedCommentCreate($param)
    {
        $this->commonSer->inputValidators('freeClasifiedCommentCreate', $param);
        $serviceResponse                        = $this->clasifiedCatServ->storeFreeClasifiedComment($param);
        
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
    



    
    public function getFreeClasifiedById($param)
    {
        $this->commonSer->inputValidators('getFreeClasifiedById', $param);
        $serviceResponse                        = $this->clasifiedCatServ->freeClasifiedGetById($param);
        
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
    


    
    public function recentAdsGet($param)
    {
        $this->commonSer->inputValidators('recentAdsGet', $param);
        $serviceResponse                        = $this->clasifiedCatServ->getRecentAds($param);
        
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
    
    

    
    public function recentAdsListGet($param)
    {
        $this->commonSer->inputValidators('recentAdsListGet', $param);
        $serviceResponse                        = $this->clasifiedCatServ->getRecentAdsList($param);
        
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
    
    

    
    public function freeAdsGetByCategory($param)
    {
        $this->commonSer->inputValidators('freeAdsGetByCategory', $param); 
        $serviceResponse                        = $this->clasifiedCatServ->getFreeAdsListByCategory($param);
        
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
    

    
    public function freeAdsSearch($param)
    {
        $this->commonSer->inputValidators('freeAdsSearch', $param);
        $serviceResponse                        = $this->clasifiedCatServ->searchFreeAdsList($param);
        
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
