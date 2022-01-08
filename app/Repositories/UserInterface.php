<?php

namespace App\Repositories;


/**
 * [Description UserInterface]
 */
interface UserInterface 
{
    public function getUserById($id);
    public function passwordResset($userToken, $userEmail);
    public function sendEmailToPasswordResset($userEmail, $verifyEmailToken);
    public function emailVerify($email, $verifyToken, $password);
    public function getCooptants();
}

