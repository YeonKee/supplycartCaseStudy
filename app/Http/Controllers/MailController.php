<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Mail;
use App\Http\Controllers\Controller;

class MailController extends Controller
{

    public static function verifyEmail($to, $userID)
    {
        Mail::send(['html' => 'emailTemplate.verifyEmail'], ['userID' => $userID], function ($message) use ($to) {
            $message->to($to)->subject('Email Verification');
            $message->from(config('mail.mailers.smtp.username'), 'EventWise');
        });
    }

    public static function resentVerifyEmail($to, $userID)
    {
        Mail::send(['html' => 'emailTemplate.verifyEmail'], ['userID' => $userID], function ($message) use ($to) {
            $message->to($to)->subject('Email Verification');
            $message->from(config('mail.mailers.smtp.username'), 'EventWise');
        });

        // Set a flash message
        Session::flash('emailSent', true);
    }

    public static function resetPassword($to, $code)
    {
        Mail::send(['html' => 'emailTemplate.resetPassword'], ['code' => $code], function ($message) use ($to) {
            $message->to($to)->subject('EventWise Account Reset Password');
            $message->from(config('mail.mailers.smtp.username'), 'EventWise');
        });
    }
}