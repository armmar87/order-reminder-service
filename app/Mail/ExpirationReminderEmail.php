<?php

namespace App\Mail;

use App\Models\Reminder;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ExpirationReminderEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $businessName;
    public $orderType;
    public $expirationDate;

    /**
     * Create a new message instance.
     */
    public function __construct(protected Reminder $reminder)
    {
        $this->businessName = $reminder->order->business;
        $this->orderType = $reminder->order->type;
        $this->expirationDate = $reminder->order->experattion_date;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Expiration Reminder',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.' . $this->reminder->type . '_expiration_reminder',
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
