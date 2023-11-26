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
use App\Models\AdvertiseWithUs;
use App\Exceptions;
use Illuminate\Support\Str;



class AdvertiseWithUsService
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
        * 
        * method storeAdvertiseWithUS()
        * 
        * @param[]
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
    
    public function storeAdvertiseWithUS($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 500;
        $return[$this->data]                        = [];

        try{         

            \DB::beginTransaction();

            if (isset($param['image'])) 
            {
                $image = $param['image'];
                $imageName = str_replace(' ', '_', time() . '_' . $image->getClientOriginalName());
                $image->move(config('app.advertise_img'), $imageName);
            }
            else {
                $imageName = null; // Set it to null if 'image' key is not present
            }
            
            $created_at                     = date("Y-m-d H:i:s");
            $create                         = new AdvertiseWithUs;
            
            $create->first_name             = $param['first_name'] ?? NULL;
            $create->last_name              = $param['last_name'] ?? NULL;
            $create->email                  = $param['email'];
            $create->phone                  = $param['mobile'];
            $create->business               = $param['business_name'];
            $create->website                = $param['website_link'];
            $create->message                = $param['message'] ?? NULL;
            $create->image                  = $imageName ?? NULL;
            $create->created_at             = $created_at;
            $create->updated_at             = $created_at;
            
            $store                                  = $create->save();
            \DB::commit();

        }
        catch (\Exception $e) {
            \DB::rollBack();
            $except['status']           = false;
            $except['error'][]          = 'Exception Error...';
            $except['message']          = $e;
            $exception                  = new BaseController();
            $exception                  = $exception->throwExceptionError($except, 500);
        }
        

        
        if($store)
        {
            $return[$this->status]                  = true;
            $return[$this->message]                 = 'Successfully submitted...';
            $return[$this->code]                    = 200;
            $return[$this->data]                    = $create;
        }


        return $return;
    }
    


}
