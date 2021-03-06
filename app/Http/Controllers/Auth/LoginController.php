<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |--------------------------------------------------------------------------
    | Je fais une surchage  de la methode logout du trait AuthenticatesUsers
    | pour faire une redirection vers login et non vers / 
    | Cette methode se trouve dans : Illuminate\Foundation\Auth\AuthenticatesUsers.php
    | Il faudrait importer la classe : use Illuminate\Http\Request pour cela
    */

    use AuthenticatesUsers;

    /**
     * 
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();
        // J'ai fait ce changement pour faire une redirection 
        // vers la page login et non vers la racine /
        return redirect('/login');
        
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //Redirige vers gallery et non vers home
    // protected $redirectTo = '/home';
    protected $redirectTo = '/gallery';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /* Vérification du rôle de l'utilisateur, s'il est admin ou pas.*/
    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
        // return  ['email' => $request->{ $this->username() }, 'password' => $request->password, 'role' => 'admin' ];
    }

}
