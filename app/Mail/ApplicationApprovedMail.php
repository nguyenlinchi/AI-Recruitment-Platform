<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ApplicationApprovedMail extends Mailable
{
    public $candidate;
    public $job;
    public $employerEmail;

    public function __construct($candidate, $job, $employerEmail)
    {
        $this->candidate = $candidate;
        $this->job = $job;
        $this->employerEmail = $employerEmail;
    }

    public function build()
    {
        return $this->subject('CV của bạn đã được duyệt')
            ->replyTo($this->employerEmail)
            ->view('emails.application-approved');
    }
}