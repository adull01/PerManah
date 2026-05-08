<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Borrowing;

class LateReturnNotice extends Mailable
{
    use Queueable, SerializesModels;
    
    public $borrowing;
    public $lateFee;
    public $daysLate;

    /**
     * Create a new message instance.
     */
    public function __construct(Borrowing $borrowing, $lateFee, $daysLate)
    {
        $this->borrowing = $borrowing;
        $this->lateFee = $lateFee;
        $this->daysLate = $daysLate;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pemberitahuan Keterlambatan Pengembalian Buku - PerManah',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.late-return-notice',
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
