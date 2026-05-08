<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Borrowing;

class LateReturnNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $borrowing;

    public function __construct(Borrowing $borrowing)
    {
        $this->borrowing = $borrowing;
    }

    public function build()
    {
        return $this->subject('Pemberitahuan Keterlambatan Pengembalian Buku')
            ->view('emails.late-return-notification')
            ->with([
                'borrowing' => $this->borrowing,
                'user' => $this->borrowing->user,
            ]);
    }
}
