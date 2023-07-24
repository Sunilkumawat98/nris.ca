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
use Validator;
use App\Models\User;
use App\Exceptions;
use Illuminate\Support\Facades\Hash;


class CommonService
{

    public function __construct()
    {
        $this->status                       = 'status';
        $this->message                      = 'message';
        $this->code                         = 'status_code';
        $this->data                         = 'data';
        $this->total                        = 'total_count';
        $this->code_200                     = Response::HTTP_OK;
        $this->code_404                     = Response::HTTP_NOT_FOUND;
        $this->code_401                     = Response::HTTP_UNAUTHORIZED;
        $this->code_409                     = Response::HTTP_CONFLICT;
        $this->code_500                     = Response::HTTP_INTERNAL_SERVER_ERROR;

    }
    
    /*
    
        If inputValidators() @method is not properly working try to run composer dump auto load command

        composer dump-autoload;php artisan cache:clear;php artisan config:clear;php artisan route:clear;php artisan view:clear;php artisan config:cache;php artisan cache:clear;

    
    */
    
    public function inputValidators($apiValidationConfigName, $params) {
        $pageParams = config('validator-config.api_validations.' . $apiValidationConfigName);
        $validate['status'] = true;
        $rules = [];
        foreach ($pageParams as $pageKey => $pageParam) {
            if (count($pageParam)) {
                foreach ($pageParam as $value) {
                        $ruleConfigKey = $value;
                        if ($pageKey == "optional") {
                            $ruleConfigKey = $value . "_$pageKey";
                        }
                        $rules[$value] = config('validator-config.rules.' . $ruleConfigKey);
                    }
            }
        }
//        print_r($rules);exit;
        
        $validator = Validator::make($params, $rules);
        if ($validator->fails()) {
            $validate['status'] = false;
            $validate['error'][] = $validator->messages()->first();
            $validate['message'] = $validator->messages()->first();
            $exception = new BaseController();
            $exception = $exception->throwValidationException($validate);
        }
        
//        echo "Validators";
//        echo "<pre>";
//            print_r($validator);
//        echo "</pre>";
//        echo "validate";
//        echo "<pre>";
//            print_r($validate);
//        echo "</pre>";
//        
//        exit;
        
        return $validate;
    }
    
    
    /**
        * @param
        * amount
        *
        * @return 
        * GST
        * 
    **/
    
    public function calculateGst($amount)
    {
        $percent4Gst = 100;                                         //I want to get 18% of $amount.
        $percentInDecimal4Gst = $percent4Gst / 100;                 //Convert our percentage value into a decimal.
        return $percentInDecimal4Gst * $amount;                     // Get the result.
    }
    
    /**
        * @param
        * amount
        *
        * @return 
        * TxnCharge
        * 
    **/
    
    public function calculateTxnCharge($amount)
    {
        $percent4Txn = 5;                                           //  I want to get 3% of $amount.
        $percentInDecimal4Txn = $percent4Txn / 100;                 //  Convert our percentage value into a decimal.
        return $percentInDecimal4Txn * $amount;                     //  Get the result.
    }





    /**
        * Profile Code
        * method getUserProfile()
        * 
        * @param[]
        * userId
        * 
        * 
        *
        * @return 
        * 200
        * 
        * @error
        * 404
        * 
    **/
    
    public function getUserProfile($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Profile not found...';
        $return[$this->code]                        = $this->code_404;
        $return[$this->data]                        = [];

        $result                                     = User::where('id',$param['user_id'])->first();
        
        if($result)
        {
            $result                                 = $result->toArray();
            $return[$this->status]                  = true;
            $return[$this->message]                 = 'Successfully Profile Get...';
            $return[$this->code]                    = $this->code_200;
            $return[$this->data]                    = $result;
        }
        
        return $return;
    }







    /**
        * method changeUserPassword()
        * 
        * @param[]
        * user_id
        * current_password
        * new_password
        * 
        * 
        *
        * @return 
        * 200
        * 
        * @error
        * 404
        * 
    **/
    
    public function changeUserPassword($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 201;
        $return[$this->data]                        = [];

        
        $exist                                      = $this->getUserPasswordByUserId($param);

        if($exist[$this->status])
        {
            $return[$this->status]                  = false;
            $return[$this->message]                 = 'Current password is not being match...';
            $return[$this->code]                    = $this->code_401;
            $return[$this->data]                    = [];
            
            if (Hash::check($param['current_password'], $exist[$this->data]['password'])) 
            {

                $userMaster                                 = User::find($param['user_id']);
                $userMaster->password                       = bcrypt($param['new_password']);
                if($userMaster->save())
                {
                    $return[$this->status]                  = true;
                    $return[$this->message]                 = 'Successfully Password Changed...';
                    $return[$this->code]                    = $this->code_200;
                    $return[$this->data]                    = [];
                }                
            }
        }
        return $return;
    }



    public function getUserPasswordByUserId($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'User not found...';
        $return[$this->code]                        = $this->code_404;
        $return[$this->data]                        = [];

        $result                                     = User::select('password','email')->where('id',$param['user_id'])->first();
              
        if($result)
        {
            $result->makeVisible('password');
            $result                                 = $result->toArray();
            $return[$this->status]                  = true;
            $return[$this->message]                 = 'Successfully User Get...';
            $return[$this->code]                    = $this->code_200;
            $return[$this->data]                    = $result;
        }
        
        return $return;
    }



}
