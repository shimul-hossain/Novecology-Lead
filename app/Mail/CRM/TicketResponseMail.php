<?php

namespace App\Mail\CRM;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketResponseMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public $subject = '';
    public $body = '';
    public $number = '';
    public $title = '';
    public $nom = '';
    public $prenom = '';
    public $url = '';
    public $details = '';
    public $response = '';
   public function __construct($subject, $body, $number, $title, $nom, $prenom, $url, $details, $response)
   {
       $this->subject = $subject;
       $this->body = $body;
       $this->number = $number;
       $this->title = $title;
       $this->nom = $nom;
       $this->prenom = $prenom;
       $this->url = $url;
       $this->details = $details;
       $this->response = $response;
   }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->view('includes.crm.mail.ticket-response');
    }
}
