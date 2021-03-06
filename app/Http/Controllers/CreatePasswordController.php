<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\EmailToPasswordRequest;
use App\Http\Requests\PasswordRequest;
use App\Repositories\UserInterface;


class CreatePasswordController extends Controller
{
    /**
    * Undocumented variable
    *
    * @var [PasswordInterface]
    */
    protected $password;
    protected $userInterface;

    /**
     * Undocumented function
     *
     * @param [PasswordInterface] $password
     */
    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    /**
     * Permet d'envoyer un token de réinitialisation 
     * de mot de passe, renvoie yes en cas de success
     * et no en cas d'échec.
     * @param EmailToPasswordRequest $request
     * @return void
     */
    public function emailToPassword(EmailToPasswordRequest $request)
    {
        //On retient les données envoyées
        $userToken = $request->code;
        $userEmail = $request->email;

        if($this->userInterface->passwordResset($userToken, $userEmail)) {

            return 'yes';
        } else {

            return 'no';
        }
                        
    }

    /**
     * Permet de créer son mot de passe
     * Renvoie yes en cas de réussite et no en 
     * cas d'échec.
     * @param PasswordRequest $request
     * @return void
     */
    public function createPassword(PasswordRequest $request)
    {
    
        //On retient les données envoyées
        $email = $request->email;
        $verifyToken = $request->verifyToken;
        $password = $request->password;

        if($this->userInterface->emailVerify($email, $verifyToken, $password)) {
        
            return 'yes';
        } else {

            return 'no';
        }
    
    }

}
