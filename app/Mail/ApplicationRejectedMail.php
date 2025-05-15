<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $application;
    public $reason;

    public function __construct($application, $reason)
    {
        $this->application = $application;
        $this->reason = $reason;
    }

    public function build()
    {
        return $this->subject('Application Rejected')
                    ->view('emails.application-rejected')
                    ->with([
                        'referenceNumber' => $this->application->reference_number,
                        'name' => $this->application->tc_name,
                        'reason' => $this->reason,
                    ]);
    }
}
