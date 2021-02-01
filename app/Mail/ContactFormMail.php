<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $contactMessage;
    protected $contactName;
    protected $contactEmail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contactEmail, $contactName, $contactMessage) {
        
        $this->contactEmail = $contactEmail;
        $this->contactName = $contactName;
        $this->contactMessage = $contactMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        $this->from(config('mail.username'), $this->contactName)
                ->replyTo($this->contactEmail)
                ->subject('New message from contact form Blog');

        return $this->view('front.emails.contact_form')
                        ->with([
                            'contactName' => $this->contactName,
                            'contactMessage' => $this->contactMessage,
        ]);
    }
}
