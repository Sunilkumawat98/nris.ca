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
use App\Models\NrisTalk;
use App\Models\NrisTalkReply;
use App\Models\NrisTalkLike;
use App\Exceptions;
use Illuminate\Support\Str;


class NrisTalkService
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
        * Nris Talk Code
        * method storeNrisTalk()
        * 
        * @param[]
        * user_id
        * state_id
        * title
        * description
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
    
    public function storeNrisTalk($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];

        \DB::beginTransaction();
        try{

            
            $created_at                             = date("Y-m-d H:i:s");
            $nrisTalk                               = new NrisTalk;
            $nrisTalk->title                        = $param['title'];
            $nrisTalk->title_slug                   = Str::slug($param['title']);
            $nrisTalk->description                  = $param['description'];
            $nrisTalk->country_id                   = $param['country_id'];
            $nrisTalk->state_id                     = $param['state_id'];
            $nrisTalk->user_id                      = $param['user_id'];
            $nrisTalk->created_at                   = $created_at;
            $nrisTalk->updated_at                   = $created_at;
            
            $store                                  = $nrisTalk->save();
            

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
            $return[$this->message]                 = 'Successfully Nris talk created...';
            $return[$this->code]                    = 200;
            $return[$this->data]                    = $nrisTalk;
        }
        \DB::commit();

        return $return;
    }
    /**
        
        * method storeNrisTalkReply()
        * 
        * @param[]
        * user_id
        * state_id
        * talk_id
        * description
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
    
    public function storeNrisTalkReply($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];

        \DB::beginTransaction();
        try{
           
            $created_at                             = date("Y-m-d H:i:s");
            $nrisTalk                               = new NrisTalkReply;
            $nrisTalk->talk_id                      = $param['talk_id'];
            $nrisTalk->comment                      = $param['description'];
            $nrisTalk->country_id                   = $param['country_id'];
            $nrisTalk->state_id                     = $param['state_id'];
            $nrisTalk->user_id                      = $param['user_id'];
            $nrisTalk->created_at                   = $created_at;
            $nrisTalk->updated_at                   = $created_at;
            
            $store                                  = $nrisTalk->save();
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
            $return[$this->message]                 = 'Successfully Nris talk reply created...';
            $return[$this->code]                    = 200;
            $return[$this->data]                    = $nrisTalk;
        }
        \DB::commit();

        return $return;
    }


    /**
        
        * method fetchNrisTalk()
        * 
        * @param[]
        * user_id
        * talk_id
        * 
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/
    
    public function fetchNrisTalk($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                     = NrisTalk::with('comments')
                                        ->where('id',$param['talk_id'])
                                        ->where('user_id',$param['user_id'])
                                        ->where('is_live',1)
                                        ->where('status',1)
                                        ->withCount('comments')
                                        ->withCount('likes')
                                        ->orderBy('id', 'DESC');


        $total_count                = $result->count();
        $result                     = $result->simplePaginate(15);
    
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
        
        * method fetchNrisTalkList()
        * 
        * @param[]
        * country_id
        * state_id
        * 
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/
    
    public function fetchNrisTalkList($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                     = NrisTalk::where('state_id',$param['state_id'])
                                        ->where('is_live',1)
                                        ->where('status',1)
                                        ->take(10)
                                        ->orderBy('id', 'DESC')
                                        ->get();
    
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
        
        * method fetchAllNrisTalk()
        * 
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/
    
    public function fetchAllNrisTalk($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                     = NrisTalk::where('is_live',1)
                                        ->where('country_id',$param['country_id'])
                                        ->where('state_id',$param['state_id'])
                                        ->where('status',1)
                                        ->orderBy('id', 'DESC')
                                        ->withCount('comments')
                                        ->withCount('likes')
                                        ->take(5)
                                        ->get();
    
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
        
        * method fetchAllReplyOfNrisTalkById()
        * 
        * @param
        * talk_id
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/
    
    public function fetchAllReplyOfNrisTalkById($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                     = NrisTalkReply::where('talk_id',$param['talk_id'])
                                        ->where('status',1)
                                        ->orderBy('id', 'DESC');


        $total_count                = $result->count();
        $result                     = $result->simplePaginate(15);
    
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
        
        * method nrisTalkLikeById()
        * 
        * @param[]
        * user_id
        * country_id
        * state_id
        * talk_id
        * description
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
    
    public function nrisTalkLikeById($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];

        \DB::beginTransaction();
        try{
           
            $created_at                             = date("Y-m-d H:i:s");
            $nrisTalk                               = new NrisTalkLike;
            $nrisTalk->talk_id                      = $param['talk_id'];
            $nrisTalk->country_id                   = $param['country_id'];
            $nrisTalk->state_id                     = $param['state_id'];
            $nrisTalk->user_id                      = $param['user_id'];
            $nrisTalk->created_at                   = $created_at;
            $nrisTalk->updated_at                   = $created_at;
            
            $store                                  = $nrisTalk->save();
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
            $return[$this->message]                 = 'Successfully Nris talk reply created...';
            $return[$this->code]                    = 200;
            $return[$this->data]                    = $nrisTalk;
        }
        \DB::commit();

        return $return;
    }





}
