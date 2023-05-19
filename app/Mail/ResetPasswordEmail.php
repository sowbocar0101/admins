<?php
// ====A+P+P+K+E+Y====
namespace App\Mail;

use Illuminate\Support\Facades\Mail;

class ResetPasswordEmail
{
    public function resetPassword($email,$password)
    {
        Mail::send('pages/email/reset-password',
            [
                'password' => $password
            ],
            function ($message) use ($email)
            {
                // $message->subject("タクシーアプリのパスワード再発行");
                $message->subject("Taxi App New Password");
                $message->from(env('MAIL_USERNAME'), 'Taxi App');
                $message->to($email);
            }
        );
    }
}
