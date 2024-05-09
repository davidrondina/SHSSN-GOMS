<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserVerificationFailed extends Mailable
{
    use Queueable, SerializesModels;

    private $reason;
    private $additional_comment;

    /**
     * Create a new message instance.
     */
    public function __construct($reason, $additional_comment = null)
    {
        $this->reason = $reason;
        $this->additional_comment = $additional_comment;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'User Verification Failed',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.verification.failed',
            with: [
                'reason' => $this->reason,
                'additional_comment' => $this->additional_comment,
            ]
        );
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
