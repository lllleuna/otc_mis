<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $application;

    public function __construct($application)
    {
        $this->application = $application;
    }

    public function build()
    {
        return $this->subject('Application Approved')
                    ->view('emails.application-approved')
                    ->with([
                        'referenceNumber' => $this->application->reference_number,
                        'name' => $this->application->tc_name,
                    ]);
    }
}
