<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EvaluationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $application;
    public $evaluationNotes;

    public function __construct($application, $evaluationNotes)
    {
        $this->application = $application;
        $this->evaluationNotes = $evaluationNotes;
    }

    public function build()
    {
        return $this->subject('Your Application Has Been Reviewed')
                    ->view('emails.evaluation_notification')
                    ->with([
                        'application' => $this->application,
                        'evaluationNotes' => $this->evaluationNotes,
                    ]);
    }
}
