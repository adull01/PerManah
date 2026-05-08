<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Borrowing;
use Illuminate\Support\Facades\Mail;
use App\Mail\LateReturnNotification;
use Carbon\Carbon;

class ProcessLateBorrowings extends Command
{
    protected $signature = 'borrowings:process-late';
    protected $description = 'Update status, denda, dan kirim email untuk peminjaman yang terlambat';

    public function handle()
    {
        $today = Carbon::today();
        $dendaPerHari = 2000; // Ganti sesuai ketentuan
        $maksDenda = 50000; // Plafon maksimal denda

        $lateBorrowings = Borrowing::with('user')
            ->where('status', 'approved')
            ->where('due_date', '<', $today)
            ->get();

        foreach ($lateBorrowings as $borrowing) {
            $daysLate = $today->diffInDays(Carbon::parse($borrowing->due_date));
            $lateFee = min($daysLate * $dendaPerHari, $maksDenda);
            $borrowing->late_fee = $lateFee;
            $borrowing->overdue_status = 'late';
            // Jangan update late_notified_at jika sudah pernah dikirim
            if (!$borrowing->late_notified_at) {
                Mail::to($borrowing->user->email)->send(new LateReturnNotification($borrowing));
                $borrowing->late_notified_at = now();
            }
            $borrowing->save();
        }

        $this->info('Proses keterlambatan selesai.');
    }
}
