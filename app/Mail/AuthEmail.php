<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AuthEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($userName, $userEmail, $authToken)
    {
        $this->userName = $userName;
        $this->userEmail = $userEmail;
        $this->authToken = $authToken;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bem-vindo',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        // Passa os dados para a view
        return $this->view('mails.mail', ['user' => $this->userName, 'token' =>  $this->authToken]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
