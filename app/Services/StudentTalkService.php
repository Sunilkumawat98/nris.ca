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
use App\Models\University;
use App\Models\StudentTalkCategory;
use App\Models\StudentTalk;
use App\Exceptions;
use Illuminate\Support\Str;


class StudentTalkService
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
        
        * method getAllStudentCategory()
        * 
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/
    
    public function getAllStudentCategory()
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                     = StudentTalkCategory::where('is_live',1)
                                        ->where('status',1)
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
        
        * method allUniversityFetch()
        * 
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/
    
    public function allUniversityFetch($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                     = University::where('is_live',1)
                                        ->where('status',1)
                                        ->where('country_id',$param['country_id'])
                                        ->where('state_id',$param['state_id'])
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
        * 
        * method storestudentUniversity()
        * 
        * @param[]
        * user_id
        * state_id
        * name
        * message
        * category_id
        * website
        * education_field
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
    
    public function storestudentUniversity($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];

        \DB::beginTransaction();
        try{

            
            $created_at                             = date("Y-m-d H:i:s");
            $obj                                    = new University;
            $obj->country_id                        = $param['country_id'];
            $obj->state_id                          = $param['state_id'];
            $obj->user_id                           = $param['user_id'];
            $obj->cat_id                            = $param['category_id'];
            $obj->name                              = $param['name'];
            $obj->slug                              = Str::slug($param['name']);
            $obj->website                           = $param['website'];
            $obj->education_field                   = $param['education_field'];
            $obj->message                           = $param['message'];            
            $obj->created_at                        = $created_at;
            $obj->updated_at                        = $created_at;            
            $store                                  = $obj->save();
            

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
            $return[$this->data]                    = $obj;
        }
        \DB::commit();

        return $return;
    }


    /**
        * Store Student Talk Code
        * method storeStudentTalk()
        * 
        * @param[]
        * user_id
        * country_id
        * state_id
        * cat_id
        * title
        * email
        * mobile
        * address
        * details
        * other_details
        * meta_title
        * meta_description
        * meta_keywords
        *
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
    
    public function storeStudentTalk($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];

        \DB::beginTransaction();
        try{

            
            $created_at                             = date("Y-m-d H:i:s");
            $storeObj                               = new StudentTalk;
            
            
            
            $storeObj->country_id                   = $param['country_id'];
            $storeObj->state_id                     = $param['state_id'];
            $storeObj->user_id                      = $param['user_id'];
            $storeObj->cat_id                       = $param['category_id'];
            $storeObj->university_id                = $param['university_id'];
            $storeObj->title                        = $param['title'];
            $storeObj->email                        = $param['email'];
            $storeObj->mobile                       = $param['mobile'];
            $storeObj->address                      = $param['address'];
            $storeObj->details                      = isset($param['details']) ?? 'NA';
            $storeObj->other_details                = isset($param['other_details']) ?? 'NA';
            $storeObj->meta_title                   = isset($param['meta_title']) ?? 'NA';
            $storeObj->meta_description             = isset($param['meta_description']) ?? 'NA';
            $storeObj->meta_keywords                = isset($param['meta_keywords']) ?? 'NA';



            $storeObj->created_at                   = $created_at;
            $storeObj->updated_at                   = $created_at;
            
            $store                                  = $storeObj->save();
            

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
            $return[$this->message]                 = 'Successfully Student talk created...';
            $return[$this->code]                    = 200;
            $return[$this->data]                    = $storeObj;
        }
        \DB::commit();

        return $return;
    }

    /**
        
        * method fetchAllStudentTalkList()
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
    
    public function fetchAllStudentTalkList($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                                     = StudentTalk::where('country_id',$param['country_id'])
                                                    ->where('state_id',$param['state_id'])
                                                    ->where('is_live',1)
                                                    ->where('status',1)
                                                    ->orderBy('id', 'DESC');

        $total_count                                = $result->count();
        $result                                     = $result->simplePaginate(10);
    
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
        
        * method getStudentTalkByCategory()
        * 
        * @param
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
    
    public function getStudentTalkByCategory($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                                     = StudentTalkCategory::with(['category_data.country','category_data.state','category_data' => function ($query) use ($param) {
                                                            $query->where('country_id', $param['country_id'])
                                                                    ->where('state_id', $param['state_id'])
                                                            ->take(1)->orderBy('id', 'DESC');
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










}
