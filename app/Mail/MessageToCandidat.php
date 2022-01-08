<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessageToCandidat extends Mailable
{
    use Queueable, SerializesModels;

    //Les attributs du mail à envyer au candidat
    public $candidatLastname;
    public $candidatFirstname;
    public $jobTitle;
    public $userFirstname;
    public $userLastname;
    public $jobUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($candidatLastname, $candidatFirstname, $jobTitle, 
                                $userFirstname, $userLastname, $jobUrl)
    {
        $this->candidatLastname = $candidatLastname;
        $this->candidatFirstname = $candidatFirstname;
        $this->jobTitle = $jobTitle;
        $this->userFirstname = $userFirstname;
        $this->userLastname = $userLastname;
        $this->jobUrl = $jobUrl;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view("emails.messageToCandidat")->subject("Candidature");
    }

    
}
