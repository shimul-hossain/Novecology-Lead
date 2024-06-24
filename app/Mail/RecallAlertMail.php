<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecallAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $subject = '';
    public $body = '';
   public function __construct($subject, $body)
   {
       $this->subject = $subject;
       $this->body = $body;
   }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = '';
        $body = '';
       return $this->subject($this->subject)->view('includes.crm.mail.recall_alert', compact('subject', 'body'));
    }
}
