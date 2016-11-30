<?php

namespace Cerebox\Mail;

use Cerebox\ContactMesssage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $contactMessage;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ContactMesssage $contactMessage)
    {
        $this->contactMessage = $contactMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contact-message')->with([
            'contactMessage' => $this->contactMessage
        ]);
    }
}
