<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    public $nom_;
    public $email_;
    public $message_;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nom_, $email_, $message_)
    {
        $this->nom_ = $nom_;
        $this->email_ = $email_;
        $this->message_ = $message_;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.contact2')->subject("Site");
        // return $this->markdown('emails.contactM')->subject("Site");
        // return $this->view('emails.contact')->subject("Site");
        // return $this->view('emails.contact');
    }
}
