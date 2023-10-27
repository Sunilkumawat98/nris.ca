<?php

namespace App\Libraries;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Services\CommonService;
use App\Services\BlogService;


use Log;


class BlogLibrary
{

    public function __construct()
    {
        $this->commonSer                        = new CommonService();        
        $this->blogSer                          = new BlogService();        
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
        $serviceResponse                        = $this->blogSer->allCategoryGet();
        
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
    
    
    
    
    
    
    public function homepageBlogGet($param)
    {
        $serviceResponse                        = $this->blogSer->fetchHomePageBlogs($param);
        
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
    
    
    public function blogByIdGet($param)
    {
        $this->commonSer->inputValidators('blogByIdGet', $param);
        $serviceResponse                        = $this->blogSer->fetchAllBlogById($param);
        
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
    
    
    public function allBlogGet()
    {
        $serviceResponse                        = $this->blogSer->fetchAllBlog();
        
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
    
    
    public function blogByCategoryGet($param)
    {
        $this->commonSer->inputValidators('blogByCategoryGet', $param);
        $serviceResponse                        = $this->blogSer->fetchBlogByCategory($param);
        
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
    

    public function likeBlog($param)
    {
        $this->commonSer->inputValidators('likeBlog', $param);
        $serviceResponse                        = $this->blogSer->storeLikeBlog($param);
        
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


    public function dislikeBlog($param)
    {
        $this->commonSer->inputValidators('dislikeBlog', $param);
        $serviceResponse                        = $this->blogSer->storeDisLikeBlog($param);
        
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
