<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        $verificationUrl = URL::temporarySignedRoute(
            'verify.email',
            now()->addMinutes(60),
            ['token' => $this->user->email_verification_token]
        );

        return $this->subject('Verify Your Email Address')
            ->from('yourapp@example.com', 'Your App Name')
            ->view('emails.verify')
            ->with([
                'verificationUrl' => $verificationUrl,
                'user' => $this->user,
            ]);
    }
}
