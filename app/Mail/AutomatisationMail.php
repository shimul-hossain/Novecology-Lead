<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AutomatisationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $body; 
    public $subject; 
    public $files; 
    public function __construct($body, $subject, $files)
    {
        $this->body = $body;
        $this->subject = $subject;
        $this->files = $files;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->files != ''){
            return $this->subject($this->subject)->view('includes.crm.mail.automatisation')->attach($this->files);
        }else{
            return $this->subject($this->subject)->view('includes.crm.mail.automatisation');
        }
    }
}
