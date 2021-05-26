<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewMessageContact extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $message;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // todo : update email admin app
        return $this->to(['info@arabsstock.com'])
        ->subject('#'.$this->message->id . ' رسالة جديدة - تواصل معنا ')
        ->markdown('emails.contact.message')
        ->with(['message' => $this->message]);
    }
}