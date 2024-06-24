<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DailyReportingEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $title = 'Email Title';
    public $body = 'Email Body';
    public $response = 'Email response';
    public $chart = '';


    public function __construct($chart)
    {
        $this->chart = $chart; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Daily Reporting')->view('includes.crm.mail.daily_reporting');
    }
}
