<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Announcement;
use App\Models\ExtensionRequest;

class AnggotaController extends Controller
{
    public function dashboard()
    {
        $announcements = Announcement::where('is_active', true)
            ->latest()
            ->take(3)
            ->get();

        $activeBorrowings = Borrowing::with('book')
            ->where('user_id', auth()->id())
            ->where('status', 'approved')
            ->count();

        $pendingRequests = Borrowing::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->count();

        return view('anggota.dashboard', compact('announcements', 'activeBorrowings', 'pendingRequests'));
    }

    // Catalog
    public function catalog(Request $request)
    {
        $query = Book::query();

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('isbn', 'like', "%{$search}%");
            });
        }

        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        $books = $query->latest()->paginate(12);
        $categories = Book::distinct()->pluck('category');

        return view('anggota.catalog', compact('books', 'categories'));
    }

    public function bookDetail($id)
    {
        $book = Book::findOrFail($id);
        return view('anggota.book-detail', compact('book'));
    }

    // Borrowing Request
    public function borrowBook(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        
        if ($book->available < 1) {
            return back()->with('error', 'Buku tidak tersedia untuk dipinjam.');
        }

        // Check if user already has pending or active borrowing for this book
        $existingBorrowing = Borrowing::where('user_id', auth()->id())
            ->where('book_id', $book->id)
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existingBorrowing) {
            return back()->with('error', 'Anda sudah memiliki permintaan peminjaman untuk buku ini.');
        }

        // Enforce maximum active/pending borrowings per user (3 buku)
        $activeCount = Borrowing::where('user_id', auth()->id())
            ->whereIn('status', ['pending', 'approved'])
            ->count();

        if ($activeCount >= 3) {
            return back()->with('error', 'Batas maksimal peminjaman tercapai (3 buku). Kembalikan atau batalkan permintaan sebelum meminjam lagi.');
        }

        $validated = $request->validate([
            'terms_accepted' => 'required|accepted',
        ], [
            'terms_accepted.required' => 'Anda harus menyetujui syarat dan ketentuan.',
            'terms_accepted.accepted' => 'Anda harus menyetujui syarat dan ketentuan.',
        ]);

        // Create borrowing request with notification
        $borrowing = Borrowing::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'borrow_date' => now(),
            'due_date' => now()->addDays(7),
            'status' => 'pending',
            'terms_accepted' => true,
            'notified_at' => now(), // Mark as notified
        ]);

        return back()->with('success', 'Permintaan peminjaman berhasil dikirim. Petugas akan segera memproses permintaan Anda.');
    }

    // Borrowing Request (old method - keeping for compatibility)
    public function requestBorrowing(Request $request, Book $book)
    {
        if ($book->available < 1) {
            return back()->with('error', 'Buku tidak tersedia untuk dipinjam.');
        }

        // Check if user already has pending or active borrowing for this book
        $existingBorrowing = Borrowing::where('user_id', auth()->id())
            ->where('book_id', $book->id)
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existingBorrowing) {
            return back()->with('error', 'Anda sudah memiliki permintaan peminjaman untuk buku ini.');
        }

        $validated = $request->validate([
            'terms_accepted' => 'required|accepted',
        ], [
            'terms_accepted.required' => 'Anda harus menyetujui syarat dan ketentuan.',
            'terms_accepted.accepted' => 'Anda harus menyetujui syarat dan ketentuan.',
        ]);

        // Create borrowing request with notification
        $borrowing = Borrowing::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'borrow_date' => now(),
            'due_date' => now()->addDays(7),
            'status' => 'pending',
            'terms_accepted' => true,
            'notified_at' => now(), // Mark as notified
        ]);

        return back()->with('success', 'Permintaan peminjaman berhasil dikirim. Petugas akan segera memproses permintaan Anda.');
    }

    // Borrowing History
    public function history()
    {
        $borrowings = Borrowing::with('book')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(15);

        return view('anggota.history', compact('borrowings'));
    }

    // Reports
    public function report(Request $request)
    {
        $month = $request->input('month', now()->format('Y-m'));
        $year = $request->input('year', now()->format('Y'));
        
        $query = Borrowing::with('book')
            ->where('user_id', auth()->id());

        if ($month) {
            $query->whereYear('borrow_date', '=', $year)
                  ->whereMonth('borrow_date', '=', date('m', strtotime($month)));
        }

        $borrowings = $query->get();

        // Statistics
        $totalBorrowed = $borrowings->count();
        $totalReturned = $borrowings->where('status', 'returned')->count();
        $totalUnreturned = $borrowings->whereIn('status', ['pending', 'approved'])->count();

        return view('anggota.report', compact('borrowings', 'totalBorrowed', 'totalReturned', 'totalUnreturned', 'month', 'year'));
    }

    public function unreturned()
    {
        $borrowings = Borrowing::with('book')
            ->where('user_id', auth()->id())
            ->where('status', 'approved')
            ->latest()
            ->get();

        return view('anggota.unreturned', compact('borrowings'));
    }

    // Request Extension
    public function requestExtension(Request $request, $id)
    {
        $borrowing = Borrowing::findOrFail($id);
        
        // Validasi: hanya pemilik peminjaman yang bisa mengajukan
        if ($borrowing->user_id !== auth()->id()) {
            return back()->with('error', 'Anda tidak memiliki akses untuk mengajukan perpanjangan ini.');
        }
        
        // Validasi: hanya bisa extend jika status approved dan belum dikembalikan
        if ($borrowing->status !== 'approved' || $borrowing->return_date !== null) {
            return back()->with('error', 'Peminjaman ini tidak dapat diperpanjang.');
        }
        
        // Validasi: cek apakah sudah ada permintaan pending
        $existingRequest = ExtensionRequest::where('borrowing_id', $borrowing->id)
            ->where('status', 'pending')
            ->first();
        
        if ($existingRequest) {
            return back()->with('error', 'Anda sudah memiliki permintaan perpanjangan yang sedang diproses untuk peminjaman ini.');
        }
        
        // Validasi: maksimal 2x perpanjangan yang disetujui
        $approvedExtensions = ExtensionRequest::where('borrowing_id', $borrowing->id)
            ->where('status', 'approved')
            ->count();
        
        if ($approvedExtensions >= 2) {
            return back()->with('error', 'Peminjaman ini sudah mencapai batas maksimal perpanjangan (2x).');
        }
        
        $validated = $request->validate([
            'requested_days' => 'required|integer|in:3,5,7',
            'reason' => 'required|string|max:500',
        ]);
        
        ExtensionRequest::create([
            'borrowing_id' => $borrowing->id,
            'user_id' => auth()->id(),
            'requested_days' => $validated['requested_days'],
            'reason' => $validated['reason'],
            'status' => 'pending',
        ]);
        
        return back()->with('success', 'Permintaan perpanjangan berhasil dikirim. Silakan tunggu persetujuan dari admin/petugas.');
    }

    // Return Book by Member
    public function returnBook($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        
        // Validasi: hanya pemilik peminjaman yang bisa mengembalikan
        if ($borrowing->user_id !== auth()->id()) {
            return back()->with('error', 'Anda tidak memiliki akses untuk mengembalikan buku ini.');
        }
        
        // Validasi: hanya bisa return jika status approved dan belum dikembalikan
        if ($borrowing->status !== 'approved' || $borrowing->return_date !== null) {
            return back()->with('error', 'Peminjaman ini tidak dapat dikembalikan.');
        }
        
        // Calculate late fee (Rp 2.000 per hari keterlambatan)
        $now = now();
        $due = \Carbon\Carbon::parse($borrowing->due_date);
        $lateDays = 0;
        if ($now->gt($due)) {
            $lateDays = $now->diffInDays($due);
        }
        $lateFeePerDay = 2000;
        $lateFee = $lateDays * $lateFeePerDay;

        // Update status dan tanggal pengembalian serta simpan denda
        $borrowing->update([
            'status' => 'returned',
            'return_date' => $now,
            'late_fee' => $lateFee,
        ]);

        // Tambah stok buku kembali
        $borrowing->book->increment('available');

        if ($lateFee > 0) {
            return back()->with('success', 'Buku berhasil dikembalikan. Denda keterlambatan: Rp ' . number_format($lateFee, 0, ',', '.'));
        }

        return back()->with('success', 'Buku berhasil dikembalikan. Terima kasih telah mengembalikan buku tepat waktu!');
    }

    // Profile Management
    public function profile()
    {
        $user = auth()->user();
        return view('anggota.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nisn' => 'required|string|max:20|unique:users,nisn,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:500',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($user->profile_photo && \Storage::disk('public')->exists($user->profile_photo)) {
                \Storage::disk('public')->delete($user->profile_photo);
            }

            // Store new photo
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $validated['profile_photo'] = $path;
        }

        $user->update($validated);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        // Check current password
        if (!\Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
        }

        $user->update([
            'password' => \Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Password berhasil diubah!');
    }
}
