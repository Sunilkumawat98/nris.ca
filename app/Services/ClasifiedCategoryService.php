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
use App\Models\ClassifiedCategory;
use App\Models\ClassifiedSubCategory;
use App\Models\FreeClassified;
use App\Models\FreeClassifiedBid;
use App\Models\FreeClassifiedComment;
use App\Exceptions;
use Illuminate\Support\Str;


class ClasifiedCategoryService
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
        * Store Free Category
        * method storeFreeCategory()
        * 
        * @param[]
        *  user_id    
        *  country_id    
        *  state_id    
        *  category_id    
        *  sub_cat_id    
        *  title   
        *  message   
        *  image  
        *  contact_name    
        *  contact_email    
        *  contact_number    
        *  contact_address    
        *  show_email 
        *  use_address_map 
        *  other_details
        * 
        * 
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/
    
    public function storeFreeClasified($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];

        
        try{

            

            if ($param['image']) 
            {
                $image = $param['image'];
                $imageName = str_replace(' ', '_', time() . '_' . $image->getClientOriginalName());
                $image->move(config('app.upload_ads_img'), $imageName);
            }
            \DB::beginTransaction();
            $created_at                             = date("Y-m-d H:i:s");
            $freeClassified                         = new FreeClassified;
            $freeClassified->user_id                = $param['user_id'];
            $freeClassified->country_id             = $param['country_id'];
            $freeClassified->state_id               = $param['state_id'];
            $freeClassified->cat_id                 = $param['category_id'] ?? NULL;
            $freeClassified->sub_cat_id             = $param['sub_cat_id'] ?? NULL;
            $freeClassified->title                  = $param['title'] ?? NULL;
            $freeClassified->title_slug             = Str::slug($param['title'] ?? NULL) ;
            $freeClassified->message                = $param['message'] ?? NULL;
            $freeClassified->image                  = $imageName ?? NULL;
            $freeClassified->contact_name           = $param['contact_name'];
            $freeClassified->contact_email          = $param['contact_email'];
            $freeClassified->contact_number         = $param['contact_number'];
            $freeClassified->contact_address        = $param['contact_address'];
            $freeClassified->show_email             = $param['show_email'];
            $freeClassified->use_address_map        = $param['use_address_map'];
            $freeClassified->other_details          = $param['other_details'];
            $freeClassified->end_at                 = $param['end_at'];
            $freeClassified->created_at             = $created_at;
            $freeClassified->updated_at             = $created_at;
            
            $store                                  = $freeClassified->save();
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
            $return[$this->message]                 = 'Successfully free clasified created...';
            $return[$this->code]                    = 200;
            $return[$this->data]                    = $freeClassified;
        }


        return $return;
    }
    


    /**
        * Store Free Category
        * method storeFreeCategory()
        * 
        * @param[]
        *  user_id    
        *  classified_id    
        *  comments    
        *  amount
        * 
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/
    
    public function storeFreeClasifiedBid($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];

        
        try{

            \DB::beginTransaction();
            $created_at                             = date("Y-m-d H:i:s");
            $freeClassified                         = new FreeClassifiedBid;
            $freeClassified->user_id                = $param['user_id'];
            $freeClassified->classified_id          = $param['classified_id'];
            $freeClassified->comments               = $param['comment'];
            $freeClassified->amount                 = $param['amount'];
            $freeClassified->created_at             = $created_at;
            $freeClassified->updated_at             = $created_at;
            
            $store                                  = $freeClassified->save();
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
            $return[$this->message]                 = 'Successfully free clasified bid created...';
            $return[$this->code]                    = 200;
            $return[$this->data]                    = $freeClassified;
        }


        return $return;
    }



    /**
        * Store Free Category
        * method storeFreeClasifiedComment()
        * 
        * @param[]
        *  user_id    
        *  classified_id    
        *  comments
        * 
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/
    
    public function storeFreeClasifiedComment($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];

        
        try{

            \DB::beginTransaction();
            $created_at                             = date("Y-m-d H:i:s");
            $freeClassified                         = new FreeClassifiedComment;
            $freeClassified->user_id                = $param['user_id'];
            $freeClassified->classified_id          = $param['classified_id'];
            $freeClassified->comments               = $param['comment'];
            $freeClassified->created_at             = $created_at;
            $freeClassified->updated_at             = $created_at;
            
            $store                                  = $freeClassified->save();
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
            $return[$this->message]                 = 'Successfully free clasified comment created...';
            $return[$this->code]                    = 200;
            $return[$this->data]                    = $freeClassified;
        }


        return $return;
    }

    

    /**
        
        * method freeClasifiedGetById()
        * 
        * @param
        * id
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/
    
    public function freeClasifiedGetById($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                     = FreeClassified::with('country_id', 'state_id', 'cat_id', 'sub_cat_id', 'bids', 'comments')
                                        ->where('id', $param['id'])
                                        ->where('is_live',1)
                                        ->where('status',1)
                                        ->orderBy('id', 'DESC')->first();
        if($result)
        {

            $result                 = $result->toArray();
            $return[$this->status]  = true;
            $return[$this->message] = 'Successfully clasified found..';
            $return[$this->code]    = 200;
            $return[$this->data]    = $result;
        }
        else
        {
            $return[$this->status]  = false;
            $return[$this->message] = 'Clasified not found...';
            $return[$this->code]    = 404;
            $return[$this->data]    = [];
        }


        return $return;
    }
    
    


    /**
        
        * method getRecentAdsList()
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
    
    public function getRecentAdsList($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                     = FreeClassified::with('country_id', 'state_id', 'cat_id', 'sub_cat_id')
                                        ->where('country_id',$param['country_id'])
                                        ->where('state_id',$param['state_id'])
                                        ->where('is_live',1)
                                        ->where('display_status',1)
                                        ->where('status',1)
                                        ->orderBy('id', 'DESC')
                                        ->take(10)
                                        ->get();
        if(count($result)>0)
        {

            $result                 = $result->toArray();
            $return[$this->status]  = true;
            $return[$this->message] = 'Successfully clasified found..';
            $return[$this->code]    = 200;
            $return[$this->data]    = $result;
        }
        else
        {
            $return[$this->status]  = false;
            $return[$this->message] = 'Recent ads not found...';
            $return[$this->code]    = 404;
            $return[$this->data]    = [];
        }

        return $return;
    }
    



    /**
        
        * method getRecentAds()
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
    
    public function getRecentAds($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                     = FreeClassified::with('country_id', 'state_id', 'cat_id', 'sub_cat_id')
                                        ->where('country_id',$param['country_id'])
                                        ->where('is_live',1)
                                        ->where('display_status',1)
                                        ->where('status',1)
                                        ->orderBy('id', 'DESC');

        $total_count                = $result->count();
        $result                     = $result->simplePaginate(4);
    
        if(count($result)>0)
        {
            $result                 = $result->toArray();
            $return[$this->status]  = true;
            $return[$this->message] = 'Successfully your list found..';
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
        
        $result                     = ClassifiedCategory::where('is_live',1)
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
        
        $result                     = ClassifiedSubCategory::where('is_live',1)
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
        
        $result                     = ClassifiedSubCategory::where('category_id', $param['category_id'])
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

    




}
