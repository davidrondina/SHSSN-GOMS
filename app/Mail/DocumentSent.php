<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class DocumentSent extends Mailable
{
    use Queueable, SerializesModels;

    private $recipient;
    private $document;

    /**
     * Create a new message instance.
     */
    public function __construct($recipient, $document)
    {
        $this->recipient = $recipient;
        $this->document = $document;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $user_email = Auth::user()->email;
        $user_name = Auth::user()->profile->first_name . ' ' . Auth::user()->profile->surname;

        return new Envelope(
            from: new Address($user_email, $user_name),
            subject: 'Document Sent',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.documents.sent',
            with: [
                'document' => $this->document,
                'recipient' => $this->recipient,
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
