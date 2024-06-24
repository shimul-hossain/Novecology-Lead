<?php

namespace App\Mail\CRM;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegisterMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $subject = '';
    public $body = '';
    public $email = '';
    public $password = '';
   public function __construct($subject, $body, $email, $password)
   {
       $this->subject = $subject;
       $this->body = $body;
       $this->email = $email;
       $this->password = $password;
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
        $email = '';
        $password = '';
       return $this->subject($this->subject)->markdown('includes.crm.mail.register-mail', compact('subject', 'body', 'email', 'password'));
   }
}
