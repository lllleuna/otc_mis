<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $application;
    public $status;
    public $message;

    public function __construct($application, $status, $message)
    {
        $this->application = $application;
        $this->status = $status;
        $this->message = $message;
    }

    public function build()
    {
        return $this->subject("Your Application has been $this->status")
                    ->view('emails.application-status')
                    ->with([
                        'application' => $this->application,
                        'status' => ucfirst($this->status),
                        'message' => $this->message,
                    ]);
    }
}
