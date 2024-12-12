<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ComplaintMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(protected $validated)
    {
        $this->validated = $validated;
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $validated = $this->validated;

        return new Envelope(
            
            subject: 'شكوى :' . $validated['complaint'], // Access array key
            from: new Address($validated['email'], $validated['name']),  // Use array values
            replyTo: [
                new Address($validated['email'], $validated['name']), // Use array values here too
            ]
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: '',
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
