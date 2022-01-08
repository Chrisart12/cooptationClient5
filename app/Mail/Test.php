<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Test extends Mailable
{
    use Queueable, SerializesModels;

    public $firstname;
    public $lastname;
    public $url;
    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($firstname, $lastname, $url, $email)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->url = $url;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.testone');
        
    }
}
