<?php

use Carbon\Carbon;

require 'vendor/autoload.php';

$now = Carbon::parse('2026-02-18 13:00:00');
$due = Carbon::parse('2026-01-25 00:00:00');

echo "Raw Now: " . $now . "\n";
echo "Raw Due: " . $due . "\n";

// Test 1: Start of Day Diff
$diff1 = $now->copy()->startOfDay()->diffInDays($due->copy()->startOfDay());
echo "Diff 1 (Start of Day, Absolute): " . $diff1 . "\n";

// Test 2: Standard
$diff2 = $now->diffInDays($due);
echo "Diff 2 (Standard): " . $diff2 . "\n";
