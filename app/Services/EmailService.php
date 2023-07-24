<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendForgotEmail;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Http\Controllers\Api\V1\BaseController;

use Log;




class EmailService
{

    public function __construct()
    {
        $this->status                           = 'status';
        $this->message                          = 'message';
        $this->code                             = 'status_code';
        $this->data                             = 'data';
        $this->code_200                         = Response::HTTP_OK;
        $this->code_404                         = Response::HTTP_NOT_FOUND;
        $this->code_401                         = Response::HTTP_UNAUTHORIZED;
        $this->code_409                         = Response::HTTP_CONFLICT;
        $this->code_500                         = Response::HTTP_INTERNAL_SERVER_ERROR;
    }
    
    public function sendEmail($all)
    {
        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);

        try {
            // Set the PHPMailer configuration

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            // $mail->Host = 'smtp.zoho.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'onlynrismail@gmail.com';
            $mail->Password = 'Nris@@001233';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Set the email details
            $mail->setFrom('onlynrismail@gmail.com', 'NRIS');
            $mail->addAddress($all['to_email']);
            $mail->Subject = $all['sub_type'];
            $mail->Body = $all['body'];
            
            
            $isSent = $mail->send();
            

            return $isSent;

        } catch (Exception $e) {
            $except['status'] = false;
            $except['error'][] = 'Exception Error...';
            $except['message'] = $e;
            $except['Email message'] = $mail->ErrorInfo;
            $exception = new BaseController();
            $exception = $exception->throwExceptionError($except, $this->code_500);
        }





        
    }





}
