<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MissingRequirementsNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $application;
    public $missingRequirements;

    public function __construct($application, $missingRequirements)
    {
        $this->application = $application;
        $this->missingRequirements = $missingRequirements;
    }

    public function build()
    {
        return $this->subject('Missing Requirements in Your Application')
        ->view('emails.missing-requirements')
        ->with([
            'name' => $this->application->tc_name, // or however you get the name
            'missingRequirements' => $this->missingRequirements,
        ]);
    }
}
