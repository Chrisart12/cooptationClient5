<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Model\User;

class VerifyTokenEmailPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $userEmail;
    public $verifyEmailToken;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userEmail, $verifyEmailToken)
    {
        $this->userEmail = $userEmail;
        $this->verifyEmailToken = $verifyEmailToken;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view("emails.verifyTokenEmailPassword")->subject("Initialisation de mot de passe");
    }
}
