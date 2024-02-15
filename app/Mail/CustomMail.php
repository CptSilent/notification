<?php

// app/Mail/CustomMail.php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\UploadedFile;

class CustomMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $body;
    public $bodyType;
    public $attachment;

    public function __construct($subject, $body, $bodyType, UploadedFile $attachment = null)
    {
        $this->subject = $subject;
        $this->body = $body;
        $this->bodyType = $bodyType;
        $this->attachment = $attachment;
    }

    public function build(): CustomMail
    {
        $mail = $this->subject($this->subject)->view('emails.custom');

        if ($this->bodyType === 'html') {
            $mail->html($this->body);
        } else {
            $mail->text($this->body);
        }

        if ($this->attachment) {
            $mail->attach($this->attachment->getRealPath(), [
                'as' => $this->attachment->getClientOriginalName(),
                'mime' => $this->attachment->getClientMimeType(),
            ]);
        }

        return $mail;
    }
}

