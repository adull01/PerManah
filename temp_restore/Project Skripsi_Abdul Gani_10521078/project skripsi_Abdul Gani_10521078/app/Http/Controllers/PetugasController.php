<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrowing;
use App\Models\User;
use App\Models\Announcement;
use App\Models\Book;
use App\Models\ExtensionRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BooksImport;

class PetugasController extends Controller
{
    // Import Buku dari Excel
    public function importBooks(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls',
        ]);

        try {
            Excel::import(new BooksImport, $request->file('excel_file'));
            return back()->with('success', 'Data buku berhasil diimpor dari Excel.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengimpor data buku: ' . $e->getMessage());
        }
    }

    public function dashboard()
    {
        $pendingBorrowings = Borrowing::where('status', 'pending')->count();
        $activeBorrowings = Borrowing::where('status', 'approved')->count();
        $totalAnggota = User::where('role', 'anggota')->count();
        // Get new notifications (pending with notified_at set)
        $newNotifications = Borrowing::with(['user', 'book'])
            ->where('status', 'pending')
            ->whereNotNull('notified_at')
            ->latest('notified_at')
            ->take(5)
            ->get();
        $recentBorrowings = Borrowing::with(['user', 'book'])
            ->latest()
            ->take(5)
            ->get();
        return view('petugas.dashboard', compact('pendingBorrowings', 'activeBorrowings', 'totalAnggota', 'recentBorrowings', 'newNotifications'));
    }

    // Payments index (redirect to PaymentController) helper
    public function payments()
    {
        return app(\App\Http\Controllers\PaymentController::class)->index();
    }

    // Borrowings Management
    public function borrowings()
    {
        $borrowings = Borrowing::with(['user', 'book', 'processedBy'])
            ->latest()
            ->paginate(15);
        return view('petugas.borrowings.index', compact('borrowings'));
    }

    public function approveBorrowing($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        
        if ($borrowing->status !== 'pending') {
            return back()->with('error', 'Peminjaman ini sudah diproses.');
        }

        $book = $borrowing->book;
        
        // Check book availability
        if ($book->available < 1) {
            $borrowing->update([
                'status' => 'rejected',
                'processed_by' => auth()->id(),
                'rejection_reason' => 'Buku tidak tersedia. Stok buku sedang habis, silakan pilih buku lain atau tunggu hingga ada yang mengembalikan.',
                'notes' => 'Ditolak karena stok habis',
            ]);
            
            return back()->with('error', 'Peminjaman ditolak karena buku tidak tersedia (stok: ' . $book->available . ').');
        }

        // Approve borrowing
        $borrowing->update([
            'status' => 'approved',
            'processed_by' => auth()->id(),
            'borrow_date' => now(),
            'due_date' => now()->addDays(7),
            'notified_at' => null, // Clear notification
        ]);

        $book->decrement('available');

        return back()->with('success', 'Peminjaman berhasil disetujui. Buku ID: ' . $book->id . ' - ' . $book->title);
    }

    public function rejectBorrowing(Request $request, $id)
    {
        $borrowing = Borrowing::findOrFail($id);
        
        if ($borrowing->status !== 'pending') {
            return back()->with('error', 'Peminjaman ini sudah diproses.');
        }

        $validated = $request->validate([
            'notes' => 'required|string',
        ]);

        $borrowing->update([
            'status' => 'rejected',
            'processed_by' => auth()->id(),
            'notes' => $validated['notes'],
            'rejection_reason' => $validated['notes'],
            'notified_at' => null, // Clear notification
        ]);

        return back()->with('success', 'Peminjaman ditolak dengan alasan: ' . $validated['notes']);
    }

    public function returnBook($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        
        if ($borrowing->status !== 'approved') {
            return back()->with('error', 'Peminjaman tidak valid untuk dikembalikan.');
        }

        // Calculate late fee (Rp 2.000 per day)
        $now = now();
        $due = \Carbon\Carbon::parse($borrowing->due_date);
        
        $lateFee = 0;
        
        // Cek jika pengembalian melebihi due date
        if ($now->gt($due)) {
            // Hitung selisih hari (gunakan startOfDay untuk hitungan hari kalender penuh dan abs() untuk nilai positif)
            $lateDays = $due->startOfDay()->diffInDays($now->startOfDay(), false); // false = signed
            
            // Jika positif (terlambat), hitung denda
            if ($lateDays > 0) {
                 $lateFee = abs($lateDays) * 2000;
            }
        }

        $borrowing->update([
            'status' => 'returned',
            'return_date' => $now,
            'late_fee' => $lateFee,
            'is_lost' => false,
        ]);

        // If not lost, increase available stock
        $borrowing->book->increment('available');

        if ($lateFee > 0) {
            return back()->with('success', 'Buku berhasil dikembalikan. Denda keterlambatan: Rp ' . number_format($lateFee, 0, ',', '.'));
        }

        return back()->with('success', 'Buku berhasil dikembalikan.');
    }

    // Mark borrowing as lost and charge replacement fee (use book.price or provided value)
    public function markLost(Request $request, $id)
    {
        $borrowing = Borrowing::findOrFail($id);

        if ($borrowing->status !== 'approved') {
            return back()->with('error', 'Hanya peminjaman berstatus "approved" yang dapat ditandai hilang.');
        }

        $validated = $request->validate([
            'replacement_fee' => 'nullable|integer|min:0',
        ]);

        // Determine replacement fee: provided or book price
        $replacementFee = $validated['replacement_fee'] ?? $borrowing->book->price ?? 0;

        $borrowing->update([
            'status' => 'returned',
            'return_date' => now(),
            'is_lost' => true,
            'replacement_fee' => $replacementFee,
        ]);

        // Do NOT increment available (book is lost)

        return back()->with('success', 'Buku ditandai hilang. Penggantian: Rp ' . number_format($replacementFee, 0, ',', '.'));
    }

    // Books Management
    public function books()
    {
        $books = Book::latest()->paginate(10);
        return view('petugas.books.index', compact('books'));
    }

    public function createBook()
    {
        return view('petugas.books.create');
    }

    public function storeBook(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books,isbn',
            'publisher' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'stock' => 'required|integer|min:0',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'required|image|max:2048',
        ]);

        $validated['available'] = $validated['stock'];

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $name = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('covers', $name, 'public');
            $validated['cover_image'] = $path;
        }

        Book::create($validated);
        return redirect()->route('petugas.books')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function editBook(Book $book)
    {
        return view('petugas.books.edit', compact('book'));
    }

    public function updateBook(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books,isbn,' . $book->id,
            'publisher' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'stock' => 'required|integer|min:0',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        // Update available based on stock change, keep it within 0..stock
        $stockDiff = $validated['stock'] - $book->stock;
        $newAvailable = $book->available + $stockDiff;
        $newAvailable = max(0, $newAvailable);
        $newAvailable = min($newAvailable, $validated['stock']);
        $validated['available'] = $newAvailable;

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $name = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('covers', $name, 'public');

            if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
                Storage::disk('public')->delete($book->cover_image);
            }

            $validated['cover_image'] = $path;
        }

        $book->update($validated);
        return redirect()->route('petugas.books')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroyBook(Book $book)
    {
        if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
            Storage::disk('public')->delete($book->cover_image);
        }
        $book->delete();
        return redirect()->route('petugas.books')->with('success', 'Buku berhasil dihapus.');
    }

    // Announcements Management
    public function announcements()
    {
        $announcements = Announcement::with('creator')->latest()->paginate(10);
        return view('petugas.announcements.index', compact('announcements'));
    }

    public function createAnnouncement()
    {
        return view('petugas.announcements.create');
    }

    public function storeAnnouncement(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['created_by'] = auth()->id();
        // Convert checkbox value: if checked it sends 'on', if not checked it's null
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        Announcement::create($validated);
        return redirect()->route('petugas.announcements')->with('success', 'Pengumuman berhasil dibuat.');
    }

    public function editAnnouncement(Announcement $announcement)
    {
        return view('petugas.announcements.edit', compact('announcement'));
    }

    public function updateAnnouncement(Request $request, Announcement $announcement)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'is_active' => 'nullable|boolean',
        ]);

        // Convert checkbox value: if checked it sends 'on', if not checked it's null
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        $announcement->update($validated);
        return redirect()->route('petugas.announcements')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroyAnnouncement(Announcement $announcement)
    {
        $announcement->delete();
        return redirect()->route('petugas.announcements')->with('success', 'Pengumuman berhasil dihapus.');
    }

    // Extension Requests Management
    public function extensions(Request $request)
    {
        $query = ExtensionRequest::with(['borrowing.book', 'user', 'processedBy']);
        
        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }
        
        $extensions = $query->latest()->paginate(15);
        
        // Count statistics
        $pendingCount = ExtensionRequest::where('status', 'pending')->count();
        $approvedCount = ExtensionRequest::where('status', 'approved')->count();
        $rejectedCount = ExtensionRequest::where('status', 'rejected')->count();
        
        return view('petugas.extensions.index', compact('extensions', 'pendingCount', 'approvedCount', 'rejectedCount'));
    }

    public function approveExtension($id)
    {
        $extension = ExtensionRequest::with('borrowing')->findOrFail($id);
        
        if ($extension->status !== 'pending') {
            return back()->with('error', 'Permintaan perpanjangan ini sudah diproses.');
        }
        
        $borrowing = $extension->borrowing;
        
        // Validasi: peminjaman harus masih approved dan belum dikembalikan
        if ($borrowing->status !== 'approved' || $borrowing->return_date !== null) {
            return back()->with('error', 'Peminjaman ini tidak dapat diperpanjang karena sudah dikembalikan atau batal.');
        }
        
        // Update due_date dengan menambahkan hari yang diminta
        $newDueDate = Carbon::parse($borrowing->due_date)->addDays($extension->requested_days);
        
        $borrowing->update([
            'due_date' => $newDueDate,
        ]);
        
        // Update extension request status
        $extension->update([
            'status' => 'approved',
            'processed_by' => auth()->id(),
            'processed_at' => now(),
        ]);
        
        return back()->with('success', 'Permintaan perpanjangan disetujui. Tanggal jatuh tempo baru: ' . $newDueDate->format('d/m/Y'));
    }

    public function rejectExtension(Request $request, $id)
    {
        $extension = ExtensionRequest::findOrFail($id);
        
        if ($extension->status !== 'pending') {
            return back()->with('error', 'Permintaan perpanjangan ini sudah diproses.');
        }
        
        $validated = $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);
        
        $extension->update([
            'status' => 'rejected',
            'processed_by' => auth()->id(),
            'processed_at' => now(),
            'rejection_reason' => $validated['rejection_reason'],
        ]);
        
        return back()->with('success', 'Permintaan perpanjangan ditolak.');
    }

    // Members Management
    public function members()
    {
        $members = User::where('role', 'anggota')->latest()->paginate(15);
        return view('petugas.members.index', compact('members'));
    }

    public function memberDetail(User $member)
    {
        if ($member->role !== 'anggota') {
            abort(404);
        }

        $borrowings = Borrowing::with('book')
            ->where('user_id', $member->id)
            ->latest()
            ->paginate(10);

        return view('petugas.members.detail', compact('member', 'borrowings'));
    }

    // Book detail for petugas (reuse anggota view)
    public function bookDetail($id)
    {
        $book = Book::findOrFail($id);
        return view('anggota.book-detail', compact('book'));
    }

    // Reports
    public function reports(Request $request)
    {
        $filter = $request->input('filter', 'all');
        $month = $request->input('month', now()->format('Y-m'));

        // Unreturned books report
        $unreturnedBorrowings = Borrowing::with(['user', 'book'])
            ->where('status', 'approved')
            ->whereNull('return_date')
            ->latest()
            ->get();

        // Currently borrowed books
        $activeBorrowings = Borrowing::with(['user', 'book'])
            ->where('status', 'approved')
            ->whereNull('return_date')
            ->latest()
            ->get();

        // Monthly report
        $monthlyBorrowings = Borrowing::with(['user', 'book'])
            ->whereYear('borrow_date', '=', date('Y', strtotime($month)))
            ->whereMonth('borrow_date', '=', date('m', strtotime($month)))
            ->latest()
            ->get();

        // Overdue borrowings
        $overdueBorrowings = Borrowing::with(['user', 'book'])
            ->where('status', 'approved')
            ->whereNull('return_date')
            ->where('due_date', '<', now())
            ->latest()
            ->get();

        return view('petugas.reports', compact('unreturnedBorrowings', 'activeBorrowings', 'monthlyBorrowings', 'overdueBorrowings', 'month', 'filter'));
    }

    // Laporan Buku Belum Dikembalikan
    public function laporanBelumKembali(Request $request)
    {
        $query = Borrowing::with(['user', 'book'])
            ->where('status', 'approved');

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('id', 'like', "%{$search}%");
                })
                ->orWhereHas('book', function($q) use ($search) {
                    $q->where('id', 'like', "%{$search}%")
                      ->orWhere('title', 'like', "%{$search}%");
                });
            });
        }

        // Status filter
        if ($request->filled('status')) {
            if ($request->status == 'terlambat') {
                $query->where('return_date', '<', now());
            } elseif ($request->status == 'belum_terlambat') {
                $query->where('return_date', '>=', now());
            }
        }

        // Sort
        $sort = $request->input('sort', 'borrow_date');
        if ($sort == 'borrow_date') {
            $query->orderBy('borrow_date', 'desc');
        } elseif ($sort == 'return_date') {
            $query->orderBy('return_date', 'asc');
        } elseif ($sort == 'member_name') {
            $query->join('users', 'borrowings.user_id', '=', 'users.id')
                  ->orderBy('users.name', 'asc')
                  ->select('borrowings.*');
        }

        $borrowings = $query->get();

        return view('petugas.laporan-belum-kembali', compact('borrowings'));
    }

    // Laporan Buku Sedang Dipinjam
    public function laporanBukuDipinjam(Request $request)
    {
        $query = Borrowing::with(['user', 'book'])
            ->where('status', 'approved');

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('book', function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('id', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->whereHas('book', function($q) use ($request) {
                $q->where('category', $request->category);
            });
        }

        // Sort
        $sort = $request->input('sort', 'borrow_date');
        if ($sort == 'borrow_date') {
            $query->orderBy('borrow_date', 'desc');
        } elseif ($sort == 'book_title') {
            $query->join('books', 'borrowings.book_id', '=', 'books.id')
                  ->orderBy('books.title', 'asc')
                  ->select('borrowings.*');
        } elseif ($sort == 'member_name') {
            $query->join('users', 'borrowings.user_id', '=', 'users.id')
                  ->orderBy('users.name', 'asc')
                  ->select('borrowings.*');
        }

        $borrowings = $query->get();

        return view('petugas.laporan-buku-dipinjam', compact('borrowings'));
    }

    // Profile Management
    public function profile()
    {
        $user = auth()->user();
        return view('petugas.profile', compact('user'));
    }

    // ... (kode lain tetap sama)

public function updateProfile(Request $request)
{
    $user = auth()->user();

    $validated = $request->validate([
        'name' => 'required|string|max:255',
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

// ... (method lain tetap sama)

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

    // User Approval Management
    public function pendingUsers()
    {
        $pendingUsers = User::where('role', 'anggota')
            ->where('status', 'pending')
            ->latest('created_at')
            ->paginate(15);
        
        return view('petugas.anggota.pending', compact('pendingUsers'));
    }

    public function approveUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->status !== 'pending') {
            return back()->with('error', 'Akun ini tidak dalam status pending.');
        }

        // Ambil password asli dari field plain_password, jika null generate password acak
        $password = $user->plain_password;
        $updateData = [
            'status' => 'active',
        ];
        if ($password === null) {
            // Untuk user lama atau data tidak lengkap, generate password acak
            $password = \Illuminate\Support\Str::random(12);
        } else {
            $updateData['plain_password'] = null; // kosongkan plain_password jika ada
        }
        $updateData['password'] = bcrypt($password);
        $user->update($updateData);

        // Kirim email persetujuan dengan password
        \Mail::to($user->email)->send(new \App\Mail\AccountApprovedMail($user, $password));

        return back()->with('success', 'Akun ' . $user->email . ' berhasil disetujui. Email notifikasi telah dikirim.');
    }

    public function rejectUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->status !== 'pending') {
            return back()->with('error', 'Akun ini tidak dalam status pending.');
        }

        $validated = $request->validate([
            'rejection_reason' => 'required|string|min:10|max:500',
        ]);

        $userEmail = $user->email;
        $rejectionReason = $validated['rejection_reason'];

        // Send rejection email BEFORE deleting the user
        \Mail::to($userEmail)->send(new \App\Mail\AccountRejectedMail($user, $rejectionReason));

        // Delete the user account after sending email
        $user->delete();

        return back()->with('success', 'Akun ' . $userEmail . ' berhasil ditolak dan dihapus. Email notifikasi penolakan telah dikirim.');
    }

    public function allMembers()
    {
        $members = User::where('role', 'anggota')
            ->where('status', 'active')
            ->latest('created_at')
            ->paginate(15);
        
        return view('petugas.anggota.index', compact('members'));
    }

    // User Management
    public function users()
    {
        $users = User::where('role', '!=', 'petugas')->latest()->paginate(10);
        return view('petugas.users.index', compact('users'));
    }

    public function createUser()
    {
        return view('petugas.users.create');
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:petugas,anggota',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $validated['password'] = \Illuminate\Support\Facades\Hash::make($validated['password']);
        if ($validated['role'] === 'anggota') {
            $validated['membership_date'] = now();
            $validated['status'] = 'active';
        }

        User::create($validated);
        return redirect()->route('petugas.users')->with('success', 'User berhasil ditambahkan.');
    }

    public function editUser(User $user)
    {
        return view('petugas.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
            'role' => 'required|in:petugas,anggota',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = \Illuminate\Support\Facades\Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);
        return redirect()->route('petugas.users')->with('success', 'User berhasil diperbarui.');
    }

    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->route('petugas.users')->with('success', 'User berhasil dihapus.');
    }

}
