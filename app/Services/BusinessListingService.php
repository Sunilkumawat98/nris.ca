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
use App\Models\BusinessListingReview;

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




    /**
        
        * method getAllBusinessListingByCategoryId()
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
    
    public function getAllBusinessListingByCategoryId($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                                     = BusinessListing::where('country_id', $param['country_id'])
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
        
        * method getBusinessListingById()
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
    
    public function getBusinessListingById($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                                     = BusinessListing::with(['reviews.user' => function ($query) use ($param) {
                                                            $query->where('country_id', $param['country_id'])
                                                                ->where('state_id', $param['state_id'])
                                                                ->orderBy('id', 'DESC');
                                                        }])
                                                        ->where('is_live',1)
                                                        ->where('id',$param['business_list_id'])
                                                        ->where('country_id',$param['country_id'])
                                                        ->where('state_id',$param['state_id'])
                                                        ->where('status',1)
                                                        ->withCount(['reviews as total_rating', 'reviews as total_comments' => function ($query) {
                                                            $query->whereNotNull('comment');
                                                        }])
                                                        ->orderBy('id', 'DESC')->first();


                                                        
    
        if ($result) 
        {
            $averageRating = $result->reviews->avg('rating');
            $totalRatings = $result->total_rating;
            $totalComments = $result->total_comments;

            $reviewsByRating = $result->reviews
                ->groupBy('rating')
                ->map(function ($group) {
                    return count($group);
                })
                ->sortKeysDesc(); // Sort the keys (ratings) in descending order.


            $result->reviews->transform(function ($review) {
                $review->name = $review->user->first_name.' '.$review->user->last_name;
                unset($review->user);
                return $review;
            });

            $return[$this->status] = true;
            $return[$this->message] = 'Successfully data list found..';
            $return[$this->code] = 200;
            $return[$this->data] = [
                'listing' => $result,
                'average_rating' => $averageRating ?? 0,
                'reviews_by_rating' => $reviewsByRating,
            ];
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
        * method storeBusinessListingReview()
        * 
        * @param[]
        *  user_id    
        *  business_list_id    
        *  country_id    
        *  state_id
        *  rating
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
    
    public function storeBusinessListingReview($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];

        
        try{

            \DB::beginTransaction();
            $created_at                              = date("Y-m-d H:i:s");
            $businessListRev                         = new BusinessListingReview;
            $businessListRev->user_id                = $param['user_id'];
            $businessListRev->business_list_id       = $param['business_list_id'];
            $businessListRev->country_id             = $param['country_id'];
            $businessListRev->state_id               = $param['state_id'];
            $businessListRev->rating                 = $param['rating'];
            $businessListRev->comment                = $param['comment'];
            $businessListRev->created_at             = $created_at;
            $businessListRev->updated_at             = $created_at;
            
            $store                                  = $businessListRev->save();
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
            $return[$this->message]                 = 'Successfully review done...';
            $return[$this->code]                    = 200;
            $return[$this->data]                    = $businessListRev;
        }


        return $return;
    }





}
