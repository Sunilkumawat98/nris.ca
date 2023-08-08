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
use App\Models\MovieRating;
use App\Models\DesiMovie;
use App\Exceptions;
use Illuminate\Support\Str;


class MovieRelatedService
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
        
        * method allMovieRatings()
        * 
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/
    
    public function movieRatingsGet()
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                     = MovieRating::where('is_live',1)
                                        ->where('status',1)
                                        ->take(5)
                                        ->orderBy('id', 'DESC')->get();
        if($result)
        {

            $result                 = $result->toArray();
            $return[$this->status]  = true;
            $return[$this->message] = 'Successfully ratings found..';
            $return[$this->code]    = 200;
            $return[$this->data]    = $result;
        }
        else
        {
            $return[$this->status]  = false;
            $return[$this->message] = 'Ratings not found...';
            $return[$this->code]    = 404;
            $return[$this->data]    = [];
        }


        return $return;
    }
    
    
    

    /**
        
        * method getAllMovieRatings()
        * 
        *
        * @return 
        * 200
        * 
        * @error
        * 500
        * 
    **/
    
    public function getAllMovieRatings()
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                     = MovieRating::where('is_live',1)
                                        ->where('status',1)
                                        ->orderBy('id', 'DESC');
        $total_count                = $result->count();
        $result                     = $result->simplePaginate(15);

        if(count($result)>0)
        {
            $result                 = $result->toArray();
            $return[$this->status]  = true;
            $return[$this->message] = 'Successfully ratings found..';
            $return[$this->code]    = 200;
            $return[$this->total]   = $total_count;
            $return[$this->data]    = $result;
        }
        else
        {
            $return[$this->status]  = false;
            $return[$this->message] = 'Rating not found...';
            $return[$this->code]    = 404;
            $return[$this->data]    = [];
        }


        return $return;
    }
    
    
    

    /**
        
        * method getAllDesiMovies()
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
    
    public function getAllDesiMovies($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                     = DesiMovie::where('country_id', $param['country_id'])
                                        ->where('state_id', $param['state_id'])
                                        ->where('is_live',1)
                                        ->where('status',1)
                                        ->orderBy('id', 'DESC');
        $total_count                = $result->count();
        $result                     = $result->simplePaginate(15);

        if(count($result)>0)
        {
            $result                 = $result->toArray();
            $return[$this->status]  = true;
            $return[$this->message] = 'Successfully desi movies found..';
            $return[$this->code]    = 200;
            $return[$this->total]   = $total_count;
            $return[$this->data]    = $result;
        }
        else
        {
            $return[$this->status]  = false;
            $return[$this->message] = 'Desi movies not found...';
            $return[$this->code]    = 404;
            $return[$this->data]    = [];
        }


        return $return;
    }
    
    

    

    /**
        
        * method latestGetAllDesiMovies()
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
    
    public function latestGetAllDesiMovies($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];
        
        $result                     = DesiMovie::where('country_id', $param['country_id'])
                                        ->where('state_id', $param['state_id'])
                                        ->where('is_live',1)
                                        ->where('status',1)
                                        ->orderBy('id', 'DESC')->first();

        if($result)
        {
            $result                 = $result->toArray();
            $return[$this->status]  = true;
            $return[$this->message] = 'Successfully desi movies found..';
            $return[$this->code]    = 200;
            $return[$this->data]    = $result;
        }
        else
        {
            $return[$this->status]  = false;
            $return[$this->message] = 'Desi movies not found...';
            $return[$this->code]    = 404;
            $return[$this->data]    = [];
        }


        return $return;
    }
    
    




}
