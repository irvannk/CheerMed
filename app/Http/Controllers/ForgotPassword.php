<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail; 
class ForgotPassword extends Controller
{
    public function send(Request $request)
    {
    	$email = $request->email;

        $data = array('name'=>"CheerMedia");
        $template_path = 'emails.ForgotPassword';
        
        Mail::send($template_path, $data, function($message) use ($email) {
            // Set the receiver and subject of the mail.
            $message->to($email, 'Receiver Name')->subject('Mail from CheerMedia');
            // Set the sender
            $message->from('irvanlaw45@gmail.com','CheerMedia');
        });

        return "New password has been sent to your email, check your inbox.";
    }
}
