<?php

use Carbon\Carbon;

require 'vendor/autoload.php';

$now = Carbon::parse('2026-02-18 13:00:00');
$dueDate = Carbon::parse('2026-01-25 00:00:00');

echo "Now: " . $now->toDateTimeString() . "\n";
echo "Due: " . $dueDate->toDateTimeString() . "\n";

if ($now->gt($dueDate)) {
    $lateDays = $now->diffInDays($dueDate);
    echo "Late Days: " . $lateDays . "\n";
    $lateFee = $lateDays * 2000;
    echo "Late Fee: " . $lateFee . "\n";
} else {
    echo "Not Late\n";
}
