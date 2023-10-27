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

use App\Models\BlogCategory;
use App\Models\Blog;
use App\Models\BlogLike;
use App\Models\TrainingPlacementCategory;
use App\Models\TrainingPlacement;
use App\Models\TrainingPlacementComment;


use App\Exceptions;
use Illuminate\Support\Str;


class BlogService
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
        
        $result                     = BlogCategory::where('is_live',1)
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
        
        * method fetchHomePageBlogs()
        * 
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/
    
    public function fetchHomePageBlogs($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                                     = Blog::where('is_live',1)
                                                        ->where('status',1)
                                                        ->take(10)
                                                        ->orderBy('id', 'DESC');

        $total_count                                = $result->count();
        $result                                     = $result->simplePaginate(1);
    
    
        if(count($result)>0)
        {
            $result->makeHidden(['cat_id', 'admin_id', 'meta_title', 'meta_description', 'meta_keywords']);
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
        
        * method fetchAllBlogById()
        * 
        * @param
        * country_id
        * state_id
        * category_id
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/


    public function fetchAllBlogById($param)
    {
        $response = [
            $this->status => false,
            $this->message => 'Oops, something went wrong...',
            $this->code => 500,
            $this->data => [],
        ];

        $result = Blog::with('category', 'admin', 'likesCount', 'dislikesCount')
            ->where('id', $param['blog_id'])
            ->where('is_live', 1)
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->first();

        if ($result) {
            $likesCount = $result->likesCount()->count();
            $dislikesCount = $result->dislikesCount()->count();

            $result->makeHidden(['cat_id']);
            $result = $result->toArray();

            $response[$this->status] = true;
            $response[$this->message] = 'Successfully data list found..';
            $response[$this->code] = 200;
            $response['data'] = $result;
            $response['data']['likes_count'] = $likesCount;
            $response['data']['dislikes_count'] = $dislikesCount;

        } else {
            $response[$this->status] = false;
            $response[$this->message] = 'List not found...';
            $response[$this->code] = 404;
        }

        return $response;
    }

    
    





 /**
        
        * method fetchAllBlog()
        * 
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/
    
    public function fetchAllBlog()
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                                     = Blog::with('category')
                                                        ->where('is_live',1)
                                                        ->where('status',1)
                                                        ->orderBy('id', 'DESC');

        $total_count                                = $result->count();
        $result                                     = $result->simplePaginate(15);
    
    
        if(count($result)>0)
        {
            $result->makeHidden(['cat_id', 'admin_id', 'meta_title', 'meta_description', 'meta_keywords']);
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
        
        * method fetchBlogByCategory()
        * 
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/


    public function fetchBlogByCategory($param)
    {
        $response = [
            $this->status => false,
            $this->message => 'Oops, something went wrong...',
            $this->code => 500,
            $this->data => [],
        ];

        $result = Blog::with('category')
            ->where('cat_id', $param['category_id'])
            ->where('is_live', 1)
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->simplePaginate(15);

        if ($result->isNotEmpty()) {
            // You can access the total likes and dislikes counts from each blog
            // as 'total_likes' and 'total_dislikes' in the response

            $result->makeHidden(['cat_id', 'admin_id', 'meta_title', 'meta_description', 'meta_keywords']);
            $result = $result->toArray();

            $response[$this->status] = true;
            $response[$this->message] = 'Successfully data list found..';
            $response[$this->code] = 200;
            $response[$this->data] = $result;
        } else {
            $response[$this->status] = false;
            $response[$this->message] = 'List not found...';
            $response[$this->code] = 404;
        }

        return $response;
    }

    

    


    /**
        * method storeLikeBlog()
        * 
        * @param[]
        *  user_id    
        *  blog_id    
        * 
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/
    
    public function storeLikeBlog($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];

        
        try{

            \DB::beginTransaction();
            $created_at                                = date("Y-m-d H:i:s");

            $result = BlogLike::where('blog_id', $param['blog_id'])
                            ->where('user_id', $param['user_id'])
                            ->first();
    

            if($result)
            {
                $updateSt = BlogLike::where('blog_id', $param['blog_id'])
                            ->where('user_id', $param['user_id'])
                            ->take(1)
                            ->update(
                                ['liked' => true],
                                ['updated_at' => $created_at]
                            );
                if($updateSt)
                {
                    \DB::commit();
                    $return[$this->status]          = true;
                    $return[$this->message]         = 'Successfully liked...';
                    $return[$this->code]            = 200;
                    $return[$this->data]            = [];
                    
                }
                else
                {
                    \DB::rollBack();
                    $return[$this->status]          = false;
                    $return[$this->message]         = 'Oops, some problem occure, Please try again...';
                    $return[$this->code]            = 201;
                    $return[$this->data]            = [];
                }
            }
            else
            {
                
                $blogLike                         = new BlogLike;
                $blogLike->user_id                = $param['user_id'];
                $blogLike->blog_id                = $param['blog_id'];
                $blogLike->liked                  = true;
                $blogLike->updated_at             = $created_at;
                
                $store                                     = $blogLike->save();
                if($store)
                {
                    \DB::commit();
                    $return[$this->status]          = true;
                    $return[$this->message]         = 'Successfully liked...';
                    $return[$this->code]            = 200;
                    $return[$this->data]            = [];
                    
                }
                else
                {
                    \DB::rollBack();
                    $return[$this->status]          = false;
                    $return[$this->message]         = 'Oops, some problem occure, Please try again...';
                    $return[$this->code]            = 201;
                    $return[$this->data]            = [];
                }
            }
        }
        catch (Exception $e) {
            \DB::rollBack();
            $except['status']           = false;
            $except['error'][]          = 'Exception Error...';
            $except['message']          = $e;
            $exception                  = new BaseController();
            $exception                  = $exception->throwExceptionError($except, 500);
        }
        


        return $return;
    }



    /**
        * method storeLikeBlog()
        * 
        * @param[]
        *  user_id    
        *  blog_id    
        * 
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/
    
    public function storeDisLikeBlog($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];

        
        try{

            \DB::beginTransaction();
            $created_at                                = date("Y-m-d H:i:s");

            $result = BlogLike::where('blog_id', $param['blog_id'])
                            ->where('user_id', $param['user_id'])
                            ->first();
    

            if($result)
            {
                $updateSt = BlogLike::where('blog_id', $param['blog_id'])
                            ->where('user_id', $param['user_id'])
                            ->take(1)
                            ->update(
                                ['liked' => false],
                                ['updated_at' => $created_at]
                            );
                if($updateSt)
                {
                    \DB::commit();
                    $return[$this->status]          = true;
                    $return[$this->message]         = 'Successfully disliked...';
                    $return[$this->code]            = 200;
                    $return[$this->data]            = [];
                    
                }
                else
                {
                    \DB::rollBack();
                    $return[$this->status]          = false;
                    $return[$this->message]         = 'Oops, some problem occure, Please try again...';
                    $return[$this->code]            = 201;
                    $return[$this->data]            = [];
                }
            }
            else
            {
                
                $blogLike                         = new BlogLike;
                $blogLike->user_id                = $param['user_id'];
                $blogLike->blog_id                = $param['blog_id'];
                $blogLike->liked                  = false;
                $blogLike->updated_at             = $created_at;
                
                $store                                     = $blogLike->save();
                if($store)
                {
                    \DB::commit();
                    $return[$this->status]          = true;
                    $return[$this->message]         = 'Successfully disliked...';
                    $return[$this->code]            = 200;
                    $return[$this->data]            = [];
                    
                }
                else
                {
                    \DB::rollBack();
                    $return[$this->status]          = false;
                    $return[$this->message]         = 'Oops, some problem occure, Please try again...';
                    $return[$this->code]            = 201;
                    $return[$this->data]            = [];
                }
            }
        }
        catch (Exception $e) {
            \DB::rollBack();
            $except['status']           = false;
            $except['error'][]          = 'Exception Error...';
            $except['message']          = $e;
            $exception                  = new BaseController();
            $exception                  = $exception->throwExceptionError($except, 500);
        }
        


        return $return;
    }





    





}
