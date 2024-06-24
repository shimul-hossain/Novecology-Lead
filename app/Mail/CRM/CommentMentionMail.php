<?php

namespace App\Mail\CRM;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommentMentionMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $title = '';
    public $body = '';
    public $response = '';
    public function __construct($title, $body, $response)
    {
        $this->title = $title;
        $this->body = $body;
        $this->response = $response;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject('Mention du commentaire')->view('includes.crm.mail.comment_mention');
    }
}
