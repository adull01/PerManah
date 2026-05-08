<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendOverdueNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-overdue-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send overdue notifications emails to members';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $overdueBorrowings = \App\Models\Borrowing::with(['user', 'book'])
            ->where('status', 'approved')
            ->whereNull('return_date')
            ->where('due_date', '<', now())
            ->get();

        $count = 0;
        foreach ($overdueBorrowings as $borrowing) {
            $due = \Carbon\Carbon::parse($borrowing->due_date);
            $now = now();
            $daysLate = $now->diffInDays($due);
            // Ensure at least 1 day late if due date was yesterday
            if ($daysLate < 1) $daysLate = 1;
            
            $lateFee = $daysLate * 2000;

            try {
                \Illuminate\Support\Facades\Mail::to($borrowing->user->email)
                    ->send(new \App\Mail\LateReturnNotice($borrowing, $lateFee, $daysLate));
                $this->info("Sent notification to {$borrowing->user->email} for book {$borrowing->book->title}");
                $count++;
            } catch (\Exception $e) {
                $this->error("Failed to send to {$borrowing->user->email}: " . $e->getMessage());
            }
        }

        $this->info("Completed. Sent {$count} notifications.");
    }
}
