<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Borrowing;
use App\Models\ExtensionRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AdminController extends Controller
{
    // Edit Profile Admin
    public function showEditProfile()
    {
        $user = auth()->user();
        return view('admin.edit-profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo && \Storage::disk('public')->exists($user->profile_photo)) {
                \Storage::disk('public')->delete($user->profile_photo);
            }
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $validated['profile_photo'] = $path;
        }

        if ($validated['password']) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);
        return back()->with('success', 'Profil berhasil diperbarui!');
    }
    public function dashboard()
    {
        $totalUsers = User::where('role', '!=', 'admin')->count();
        $totalBorrowings = Borrowing::count();
        $pendingBorrowings = Borrowing::where('status', 'pending')->count();

        return view('admin.dashboard', compact('totalUsers', 'totalBorrowings', 'pendingBorrowings'));
    }

    // Reports
    public function reports(Request $request)
    {
        $month = $request->input('month', now()->format('Y-m'));
        
        $borrowings = Borrowing::with(['user', 'book', 'processedBy'])
            ->whereYear('borrow_date', '=', date('Y', strtotime($month)))
            ->whereMonth('borrow_date', '=', date('m', strtotime($month)))
            ->latest()
            ->get();

        $mostBorrowedBooks = Book::withCount(['borrowings' => function ($query) use ($month) {
            $query->whereYear('borrow_date', '=', date('Y', strtotime($month)))
                  ->whereMonth('borrow_date', '=', date('m', strtotime($month)));
        }])
        ->orderBy('borrowings_count', 'desc')
        ->take(10)
        ->get();

        return view('admin.reports', compact('borrowings', 'mostBorrowedBooks', 'month'));
    }

    public function printReports(Request $request)
    {
        $month = $request->input('month', now()->format('Y-m'));

        $borrowings = Borrowing::with(['user', 'book', 'processedBy'])
            ->whereYear('borrow_date', '=', date('Y', strtotime($month)))
            ->whereMonth('borrow_date', '=', date('m', strtotime($month)))
            ->latest()
            ->get();

        $mostBorrowedBooks = Book::withCount(['borrowings' => function ($query) use ($month) {
            $query->whereYear('borrow_date', '=', date('Y', strtotime($month)))
                  ->whereMonth('borrow_date', '=', date('m', strtotime($month)));
        }])
        ->orderBy('borrowings_count', 'desc')
        ->take(10)
        ->get();

        return view('admin.reports-print', compact('borrowings', 'mostBorrowedBooks', 'month'));
    }

    public function pdfReports(Request $request)
    {
        $month = $request->input('month', now()->format('Y-m'));

        $borrowings = Borrowing::with(['user', 'book', 'processedBy'])
            ->whereYear('borrow_date', '=', date('Y', strtotime($month)))
            ->whereMonth('borrow_date', '=', date('m', strtotime($month)))
            ->latest()
            ->get();

        $mostBorrowedBooks = Book::withCount(['borrowings' => function ($query) use ($month) {
            $query->whereYear('borrow_date', '=', date('Y', strtotime($month)))
                  ->whereMonth('borrow_date', '=', date('m', strtotime($month)));
        }])
        ->orderBy('borrowings_count', 'desc')
        ->take(10)
        ->get();

        // Check if dompdf package is installed
        if (!class_exists('Barryvdh\\DomPDF\\Facade\\Pdf')) {
            return redirect()->route('admin.reports', ['month' => $month])
                ->with('error', 'Paket dompdf belum terpasang. Jalankan: composer require barryvdh/laravel-dompdf');
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.reports-pdf', compact('borrowings', 'mostBorrowedBooks', 'month'));
        $pdf->setPaper('a4', 'portrait');

        $filename = 'laporan-peminjaman-' . str_replace('-', '', $month) . '.pdf';
        return $pdf->download($filename);
    }

    // Per-member fees report
    public function feesReport(Request $request)
    {
        $month = $request->input('month', now()->format('Y-m'));

        $borrowings = Borrowing::with('user')
            ->whereYear('borrow_date', '=', date('Y', strtotime($month)))
            ->whereMonth('borrow_date', '=', date('m', strtotime($month)))
            ->get();

        // Aggregate per user
        $feesPerUser = $borrowings->groupBy('user_id')->map(function ($items) {
            $user = $items->first()->user;
            $totalBorrowings = $items->count();
            $totalFees = $items->sum('late_fee') + $items->sum('replacement_fee');
            $unpaidFees = $items->where('is_fee_paid', false)->sum(function ($b) { return ($b->late_fee ?? 0) + ($b->replacement_fee ?? 0); });
            return (object)[
                'user' => $user,
                'totalBorrowings' => $totalBorrowings,
                'totalFees' => $totalFees,
                'unpaidFees' => $unpaidFees,
            ];
        })->values();

        return view('admin.reports-fees', compact('feesPerUser', 'month'));
    }
}
