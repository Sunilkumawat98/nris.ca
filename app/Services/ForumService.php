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
use App\Models\Forum;
use App\Models\ForumCategory;
use App\Models\ForumSubCategory;
use App\Models\ForumComment;

use Illuminate\Support\Str;


class ForumService
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
        
        $result                     = ForumCategory::where('is_live',1)
                                        ->where('status',1)
                                        ->orderBy('id', 'DESC')->get();


    
        if(count($result)>0)
        {
            $result->makeHidden([
                'slug',
                'created_at',
            ]);
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
        
        $result                                     = ForumSubCategory::where('is_live',1)
                                                        ->where('status',1)
                                                        ->orderBy('id', 'DESC')->get();


    
        if(count($result)>0)
        {
            $result->makeHidden([
                'slug',
                'created_at',
            ]);
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
        
        $result                     = ForumSubCategory::where('category_id', $param['category_id'])
                                        ->where('is_live',1)
                                        ->where('status',1)
                                        ->orderBy('id', 'DESC')->get();


    
        if(count($result)>0)
        {
            $result->makeHidden([
                'slug',
                'created_at',
            ]);
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
        
        * method getAllForumByCategoryId()
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
    
    public function getAllForumByCategoryId($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                                     = Forum::with('category', 'subcategory', 'user', 'comments')
                                                        ->where('cat_id',$param['category_id'])
                                                        ->where('is_live',1)
                                                        ->where('status',1)
                                                        ->withCount('comments')
                                                        ->orderBy('id', 'DESC');

        $total_count                                = $result->count();
        $result                                     = $result->simplePaginate(10);
    
    
        if(count($result)>0)
        {
            $result->makeHidden([
                'user_id',
                'cat_id',
                'sub_cat_id',
                'meta_title',
                'meta_description',
                'meta_keywords',
                'display_status',
                'comments',
                
            ]);
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
        
        * method getForumById()
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

    
    
    public function getForumById($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                                     = Forum::with('category', 'subcategory', 'comments.user')
                                                        ->where('is_live',1)
                                                        ->where('id',$param['forum_id'])                                                     
                                                        ->where('status',1)
                                                        ->orderBy('id', 'DESC')->first();


                                                        
    
        if ($result) 
        {
            $result->makeHidden([
                'user_id',
                'cat_id',
                'sub_cat_id',
                'display_status',
            ]);
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
    
    public function storeForum($param)
    {
        $return = [
            $this->status => false,
            $this->message => 'Oops, something went wrong...',
            $this->code => 500,
            $this->data => [],
        ];
        
        try{

            \DB::beginTransaction();

                $created_at = now(); // Use the Carbon instance for the current timestamp.

                $create = new Forum;
                $create->user_id = $param['user_id'];
                $create->cat_id = $param['category_id'];
                $create->sub_cat_id = $param['sub_cat_id'];
                $create->title = $param['title'];
                $create->title_slug = Str::slug($param['title']);
                $create->description = $param['description'];
                $create->created_at = $created_at;
                $create->updated_at = $created_at;

                if ($create->save()) {
                    \DB::commit();

                    $return = [
                        $this->status => true,
                        $this->message => 'Successfully forum submitted...',
                        $this->code => 200,
                        $this->data => $create,
                    ];
                }

        }
        catch (\Exception $e) {
            \DB::rollBack();
                $response = [
                    $this->status => false,
                    $this->message => 'Oops, please try again...',
                    $this->code => 500,
                    'error' => 'Exception Error...',
                    'exception' => $e->getMessage(),
                ];

                $exception                  = new BaseController();
                $exception                  = $exception->throwExceptionError($response, 500);
        }
        
        return $return;
    }









    /**
        * method storeForumComment()
        * 
        * @param[]
        *  user_id    
        *  forum_id
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
    
    public function storeForumComment($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];

        
        try{

            \DB::beginTransaction();
            $created_at                                 = date("Y-m-d H:i:s");
            $create                                     = new ForumComment;
            $create->user_id                            = $param['user_id'];
            $create->forum_id                           = $param['forum_id'];
            $create->comment                            = $param['comment'];
            $create->created_at                         = $created_at;
            $create->updated_at                         = $created_at;
            
            $store                                      = $create->save();
            \DB::commit();

        }
        catch (\Exception $e) {
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
            $return[$this->data]                    = $create;
        }


        return $return;
    }






}
