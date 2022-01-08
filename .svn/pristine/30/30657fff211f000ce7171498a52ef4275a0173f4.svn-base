<?php

namespace App\Exceptions;

use Exception;
use Auth;
use Mail;

class RoleException extends Exception
{
    
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()//Exception $exception
    {
        // dd('kkkkkk');
        // $url = url('/');

		// on récupère l'utilisateur
        // $user = Auth::user();
                
        // dd($user);
        
        // if(env("APP_ENV") != "local") {
		// 	// envoi d'un mail de relevé d'exception
        // 	Mail::send('emails.exception.exception', ['url' => $url, 'user' => $user, 'exception' => $exception], function ($message) use($url, $user, $exception){
		// 		$message->from('tek@heliop.com', 'Support Wesead');
		// 		$message->to('issaissifou10@gmail.com', 'Mastory');
		// 		$message->subject('Exception Mastory relevée');
		// 	});
        // }
        
        // envoi d'un mail de relevé d'exception
        // Mail::send('emails.exceptions.exception', ['url' => $url, 'user' => $user, 'exception' => $exception], 
        //             function ($message) use($url, $user, $exception){
        //     $message->from('tek@heliop.com', 'Support Wesead');
        //     $message->to('issaissifou@hotmail.com', 'Mastory');
        //     $message->subject('Exception Mastory relevée');
        // });

    }
    
    
    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return view("errors.403");
    }
}
