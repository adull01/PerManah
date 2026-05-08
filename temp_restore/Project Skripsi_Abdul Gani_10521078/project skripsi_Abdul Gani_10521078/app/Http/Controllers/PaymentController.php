<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Borrowing;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['user', 'borrowing'])->latest()->paginate(20);
        return view('petugas.payments.index', compact('payments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'borrowing_id' => 'nullable|exists:borrowings,id',
            'amount' => 'required|integer|min:0',
            'method' => 'nullable|string|max:100',
            'note' => 'nullable|string',
        ]);

        $payment = Payment::create([
            'user_id' => auth()->id(),
            'borrowing_id' => $validated['borrowing_id'] ?? null,
            'amount' => $validated['amount'],
            'method' => $validated['method'] ?? null,
            'note' => $validated['note'] ?? null,
            'paid_at' => now(),
        ]);

        // If linked to borrowing, mark borrowing fees as paid
        if ($payment->borrowing) {
            $bor = $payment->borrowing;
            $bor->update([
                'is_fee_paid' => true,
                'fee_paid_at' => now(),
            ]);
        }

        return back()->with('success', 'Pembayaran tercatat.');
    }
}
