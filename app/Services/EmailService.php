<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use App\Mail\CustomMail;

class EmailService
{
    protected $smtpConfig;

    public function __construct(array $smtpConfig)
    {
        $this->smtpConfig = $smtpConfig;
    }

    public function sendEmail($sender, $receiver, $subject, $body, $bodyType, $attachment = null): void
    {
        config(['mail' => $this->smtpConfig]);

        $mail = new CustomMail($subject, $body, $bodyType, $attachment);

        Mail::to($receiver)->send($mail);
    }
}
