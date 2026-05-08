<?php

use App\Models\Borrowing;
use Carbon\Carbon;

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Checking for incorrect late fees...\n";

$borrowings = Borrowing::where('status', 'returned')
    ->whereColumn('return_date', '>', 'due_date')
    ->get();

$count = 0;
foreach ($borrowings as $b) {
    if ($b->late_fee <= 0) { // Check for 0 or negative
        $due = Carbon::parse($b->due_date)->startOfDay();
        $return = Carbon::parse($b->return_date)->startOfDay();
        
        $daysLate = $due->diffInDays($return); // Absolute difference
        $expectedFee = $daysLate * 2000;
        
        echo "ID {$b->id}: Due {$due->toDateString()}, Return {$return->toDateString()}. Late {$daysLate} days. Current Fee: {$b->late_fee}. Fixing to: {$expectedFee}\n";
        
        $b->late_fee = $expectedFee;
        $b->save();
        $count++;
    }
}

echo "Fixed {$count} records.\n";
