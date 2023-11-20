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
use App\Models\MovieVideo;
use App\Models\MovieVideoCategory;
use App\Models\MovieVideoLanguage;
use App\Models\MovieVideoLike;


use App\Exceptions;
use Illuminate\Support\Str;


class MovieVideoService
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
        
        $result                     = MovieVideoCategory::where('is_live',1)
                                        ->where('status',1)
                                        ->orderBy('id', 'DESC')->get();


    
        if(count($result)>0)
        {
            $result->makeHidden(['created_at']);
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
        
        * method allLanguageGet()
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
    
    public function allLanguageGet()
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                     = MovieVideoLanguage::where('is_live',1)
                                        ->where('status',1)
                                        ->orderBy('id', 'DESC')->get();


    
        if(count($result)>0)
        {
            $result->makeHidden(['created_at']);
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
        
        * method fetchAllMovieVideo()
        * 
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/

    public function fetchAllMovieVideo()
    {
        $return[$this->status] = false;
        $return[$this->message] = 'Oops, something went wrong...';
        $return[$this->code] = 500;
        $return[$this->data] = [];

        $result = MovieVideo::with('category')
            ->where('is_live', 1)
            ->where('status', 1)
            ->orderBy('id', 'DESC');
            $total_count = $result->count();
            $result = $result->simplePaginate(10);

            

        if ($result->count() > 0) {
            $likesCount = 0;
            $dislikesCount = 0;

            $result->each(function ($movieVideo) use (&$likesCount, &$dislikesCount) {
                $likesCount += $movieVideo->likesCount()->count();
                $dislikesCount += $movieVideo->dislikesCount()->count();
                $movieVideo->makeHidden(['category_id', 'language_id', 'created_at']);

                $movieVideo->total_likes = $likesCount;
                $movieVideo->total_dislikes = $dislikesCount;
            });

            $return[$this->status] = true;
            $return[$this->message] = 'Successfully data list found..';
            $return[$this->code] = 200;
            $return[$this->data]   = [
                'total'=>$total_count,
                'result'=>$result->toArray(),
            ];
            
        } else {
            $return[$this->status] = false;
            $return[$this->message] = 'List not found...';
            $return[$this->code] = 404;
            $return[$this->data] = [];
        }

        return $return;
    }


 


 /**
        
        * method fetchMovieVideoByCategory()
        * 
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/


    public function fetchMovieVideoByCategory($param)
    {
        $response = [
            $this->status => false,
            $this->message => 'Oops, something went wrong...',
            $this->code => 500,
            $this->data => [],
        ];

        $result = MovieVideo::with('category')
            ->where('category_id', $param['category_id'])
            ->where('is_live', 1)
            ->where('status', 1)
            ->orderBy('id', 'DESC');
            $total_count = $result->count();
            $result = $result->simplePaginate(10);

        if ($result->isNotEmpty()) {
            
            $likesCount = 0;
            $dislikesCount = 0;

            $result->each(function ($movieVideo) use (&$likesCount, &$dislikesCount) {
                $likesCount += $movieVideo->likesCount()->count();
                $dislikesCount += $movieVideo->dislikesCount()->count();
                $movieVideo->makeHidden(['category_id', 'language_id', 'created_at']);

                $movieVideo->total_likes = $likesCount;
                $movieVideo->total_dislikes = $dislikesCount;
            });


            $response[$this->status] = true;
            $response[$this->message] = 'Successfully data list found..';
            $response[$this->code] = 200;
            $response[$this->data]   = [
                'total'=>$total_count,
                'result'=>$result->toArray(),
            ];
        } else {
            $response[$this->status] = false;
            $response[$this->message] = 'List not found...';
            $response[$this->code] = 404;
        }

        return $response;
    }


 /**
        
        * method fetchMovieVideoByLanguage()
        * 
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/


    public function fetchMovieVideoByLanguage($param)
    {
        $response = [
            $this->status => false,
            $this->message => 'Oops, something went wrong...',
            $this->code => 500,
            $this->data => [],
        ];

        $result = MovieVideo::with('language')
            ->where('language_id', $param['language_id'])
            ->where('is_live', 1)
            ->where('status', 1)
            ->orderBy('id', 'DESC');
            $total_count = $result->count();
            $result = $result->simplePaginate(10);

        if ($result->isNotEmpty()) {
            
            $likesCount = 0;
            $dislikesCount = 0;

            $result->each(function ($movieVideo) use (&$likesCount, &$dislikesCount) {
                $likesCount += $movieVideo->likesCount()->count();
                $dislikesCount += $movieVideo->dislikesCount()->count();
                $movieVideo->makeHidden(['category_id', 'language_id', 'created_at']);

                $movieVideo->total_likes = $likesCount;
                $movieVideo->total_dislikes = $dislikesCount;
            });

            $response[$this->status] = true;
            $response[$this->message] = 'Successfully data list found..';
            $response[$this->code] = 200;
            $response[$this->data]   = [
                'total'=>$total_count,
                'result'=>$result->toArray(),
            ];
        } else {
            $response[$this->status] = false;
            $response[$this->message] = 'List not found...';
            $response[$this->code] = 404;
        }

        return $response;
    }

    





    /**
        
        * method fetchMovieVideoSearch()
        * 
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/
    
    public function fetchMovieVideoSearch($param)
    {
        $response = [
            $this->status   => false,
            $this->message  => 'Data not found...',
            $this->code     => 404,
            $this->data     => [],
        ];
        
        $result                                     = MovieVideo::with('category');
        

        if ($param['keyword']) {
            $result->where(function ($query) use ($param) {
                $query->where('name', 'like', '%' . $param['keyword'] . '%');
            });
        }

        $result->where('is_live', 1);
        $result->where('status', 1);

        $total_count = $result->count();
        $result = $result->simplePaginate(10);

        if ($result->isNotEmpty()) {
            $likesCount = 0;
            $dislikesCount = 0;

            $result->each(function ($movieVideo) use (&$likesCount, &$dislikesCount) {
                $likesCount += $movieVideo->likesCount()->count();
                $dislikesCount += $movieVideo->dislikesCount()->count();
                $movieVideo->makeHidden(['category_id', 'language_id', 'created_at']);

                $movieVideo->total_likes = $likesCount;
                $movieVideo->total_dislikes = $dislikesCount;
            });
            
            $response[$this->status]  = true;
            $response[$this->message] = 'Successfully list get...';
            $response[$this->code]    = 200;
        
            $response[$this->data]    = [
                'total'=>$total_count,
                'result'=>$result->toArray(),
            ];
        }


        return $response;
    }






    


    /**
        * method storeLikeMovieVideo()
        * 
        * @param[]
        *  user_id    
        *  video_id    
        * 
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/ 
    
    public function storeLikeMovieVideo($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];

        
        try{

            \DB::beginTransaction();
            $created_at                                = date("Y-m-d H:i:s");

            $result = MovieVideoLike::where('video_id', $param['video_id'])
                            ->where('user_id', $param['user_id'])
                            ->first();
    

            if($result)
            {
                $updateSt = MovieVideoLike::where('video_id', $param['video_id'])
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
                
                $MovieVideoLike                         = new MovieVideoLike;
                $MovieVideoLike->user_id                = $param['user_id'];
                $MovieVideoLike->video_id               = $param['video_id'];
                $MovieVideoLike->liked                  = true;
                $MovieVideoLike->updated_at             = $created_at;
                
                $store                                  = $MovieVideoLike->save();
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
        * method storeDisLikeMovieVideo()
        * 
        * @param[]
        *  user_id    
        *  video_id    
        * 
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/
    
    public function storeDisLikeMovieVideo($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];

        
        try{

            \DB::beginTransaction();
            $created_at                                = date("Y-m-d H:i:s");

            $result = MovieVideoLike::where('video_id', $param['video_id'])
                            ->where('user_id', $param['user_id'])
                            ->first();
    

            if($result)
            {
                $updateSt = MovieVideoLike::where('video_id', $param['video_id'])
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
                
                $movieVideoLike                         = new MovieVideoLike;
                $movieVideoLike->user_id                = $param['user_id'];
                $movieVideoLike->video_id                = $param['video_id'];
                $movieVideoLike->liked                  = false;
                $movieVideoLike->updated_at             = $created_at;
                
                $store                                     = $movieVideoLike->save();
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
