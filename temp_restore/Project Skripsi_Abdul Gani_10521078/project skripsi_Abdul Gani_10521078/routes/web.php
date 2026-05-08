<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\AnggotaController;
use App\Models\Book;
use App\Models\User;
use App\Models\Borrowing;

// Landing Page
Route::get('/', function () {
    $totalBooks = Book::count();
    $totalMembers = User::where('role', 'anggota')->count();
    $totalBorrowings = Borrowing::count();
    $monthlyBorrowings = Borrowing::whereMonth('borrow_date', now()->month)
        ->whereYear('borrow_date', now()->year)
        ->count();
    
    // Get latest books for slider
    $latestBooks = Book::latest()->take(10)->get();
    
    return view('landing', compact('totalBooks', 'totalMembers', 'totalBorrowings', 'monthlyBorrowings', 'latestBooks'));
})->name('landing');

Route::get('/tentang-kami', function () {
    return view('about');
})->name('about');

// Auth Routes - Unified
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Auth Routes - Legacy Redirects (for compatibility with existing links)
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'loginAdmin'])->name('admin.login.post');
});

Route::prefix('petugas')->group(function () {
    Route::get('/login', [AuthController::class, 'showPetugasLogin'])->name('petugas.login');
    Route::post('/login', [AuthController::class, 'loginPetugas'])->name('petugas.login.post');
});

Route::prefix('anggota')->group(function () {
    Route::get('/login', [AuthController::class, 'showAnggotaLogin'])->name('anggota.login');
    Route::post('/login', [AuthController::class, 'loginAnggota'])->name('anggota.login.post');
    Route::get('/register', [AuthController::class, 'showAnggotaRegister'])->name('anggota.register');
    Route::post('/register', [AuthController::class, 'registerAnggota'])->name('anggota.register.post');
});

// (Generic login route removed or already covered above)

// Logout Route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/reports', [AdminController::class, 'reports'])->name('admin.reports');
    Route::get('/reports/print', [AdminController::class, 'printReports'])->name('admin.reports.print');
    Route::get('/reports/pdf', [AdminController::class, 'pdfReports'])->name('admin.reports.pdf');
    Route::get('/reports/fees', [AdminController::class, 'feesReport'])->name('admin.reports.fees');
    
    // Edit Profile
    Route::get('/edit-profile', [AdminController::class, 'showEditProfile'])->name('admin.editProfile');
    Route::post('/edit-profile', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');
});

// Petugas Routes
Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->group(function () {
    Route::get('/dashboard', [PetugasController::class, 'dashboard'])->name('petugas.dashboard');
    Route::get('/borrowings', [PetugasController::class, 'borrowings'])->name('petugas.borrowings');
    Route::post('/borrowings/{id}/approve', [PetugasController::class, 'approveBorrowing'])->name('petugas.borrowings.approve');
    Route::post('/borrowings/{id}/reject', [PetugasController::class, 'rejectBorrowing'])->name('petugas.borrowings.reject');
    Route::post('/borrowings/{id}/return', [PetugasController::class, 'returnBook'])->name('petugas.borrowings.return');
    Route::post('/borrowings/{id}/mark-lost', [PetugasController::class, 'markLost'])->name('petugas.borrowings.mark-lost');
    
    
    // Books Management
    Route::get('/books', [PetugasController::class, 'books'])->name('petugas.books');
    Route::get('/books/create', [PetugasController::class, 'createBook'])->name('petugas.books.create');
    Route::post('/books', [PetugasController::class, 'storeBook'])->name('petugas.books.store');
    Route::post('/books/import', [PetugasController::class, 'importBooks'])->name('petugas.books.import');
    // Detail view for petugas (allow petugas to view book details)
    Route::get('/books/{id}', [PetugasController::class, 'bookDetail'])->name('petugas.books.detail');
    Route::get('/books/{book}/edit', [PetugasController::class, 'editBook'])->name('petugas.books.edit');
    Route::put('/books/{book}', [PetugasController::class, 'updateBook'])->name('petugas.books.update');
    Route::delete('/books/{book}', [PetugasController::class, 'destroyBook'])->name('petugas.books.destroy');
    
    // Announcements
    Route::get('/announcements', [PetugasController::class, 'announcements'])->name('petugas.announcements');
    Route::get('/announcements/create', [PetugasController::class, 'createAnnouncement'])->name('petugas.announcements.create');
    Route::post('/announcements', [PetugasController::class, 'storeAnnouncement'])->name('petugas.announcements.store');
    Route::get('/announcements/{announcement}/edit', [PetugasController::class, 'editAnnouncement'])->name('petugas.announcements.edit');
    Route::put('/announcements/{announcement}', [PetugasController::class, 'updateAnnouncement'])->name('petugas.announcements.update');
    Route::delete('/announcements/{announcement}', [PetugasController::class, 'destroyAnnouncement'])->name('petugas.announcements.destroy');
    
    // Members
    Route::get('/members', [PetugasController::class, 'members'])->name('petugas.members');
    Route::get('/members/{member}', [PetugasController::class, 'memberDetail'])->name('petugas.members.detail');
    
    // User Approval Management (Anggota Pending)
    Route::get('/anggota/pending', [PetugasController::class, 'pendingUsers'])->name('petugas.anggota.pending');
    Route::post('/anggota/{id}/approve', [PetugasController::class, 'approveUser'])->name('petugas.anggota.approve');
    Route::post('/anggota/{id}/reject', [PetugasController::class, 'rejectUser'])->name('petugas.anggota.reject');
    Route::get('/anggota/all', [PetugasController::class, 'allMembers'])->name('petugas.anggota.all');
    
    // Users Management
    Route::get('/users', [PetugasController::class, 'users'])->name('petugas.users');
    Route::get('/users/create', [PetugasController::class, 'createUser'])->name('petugas.users.create');
    Route::post('/users', [PetugasController::class, 'storeUser'])->name('petugas.users.store');
    Route::get('/users/{user}/edit', [PetugasController::class, 'editUser'])->name('petugas.users.edit');
    Route::put('/users/{user}', [PetugasController::class, 'updateUser'])->name('petugas.users.update');
    Route::delete('/users/{user}', [PetugasController::class, 'destroyUser'])->name('petugas.users.destroy');
    
    // Extension Requests Management
    Route::get('/extensions', [PetugasController::class, 'extensions'])->name('petugas.extensions');
    Route::post('/extensions/{id}/approve', [PetugasController::class, 'approveExtension'])->name('petugas.extensions.approve');
    Route::post('/extensions/{id}/reject', [PetugasController::class, 'rejectExtension'])->name('petugas.extensions.reject');
    
    // Reports
    Route::get('/reports', [PetugasController::class, 'reports'])->name('petugas.reports');
    Route::get('/laporan-buku-dipinjam', [PetugasController::class, 'laporanBukuDipinjam'])->name('petugas.laporan.buku-dipinjam');
    Route::get('/laporan-belum-kembali', [PetugasController::class, 'laporanBelumKembali'])->name('petugas.laporan.belum-kembali');
    // Payments ledger
    Route::get('/payments', [\App\Http\Controllers\PaymentController::class, 'index'])->name('petugas.payments');
    Route::post('/payments', [\App\Http\Controllers\PaymentController::class, 'store'])->name('petugas.payments.store');
    
    // Profile Management
    Route::get('/profile', [PetugasController::class, 'profile'])->name('petugas.profile');
    Route::put('/profile', [PetugasController::class, 'updateProfile'])->name('petugas.profile.update');
    Route::put('/profile/password', [PetugasController::class, 'updatePassword'])->name('petugas.profile.password');
});

// Anggota Routes
Route::middleware(['auth', 'role:anggota'])->prefix('anggota')->group(function () {
    Route::get('/dashboard', [AnggotaController::class, 'dashboard'])->name('anggota.dashboard');
    Route::get('/catalog', [AnggotaController::class, 'catalog'])->name('anggota.catalog');
    Route::get('/books/{id}', [AnggotaController::class, 'bookDetail'])->name('anggota.books.detail');
    Route::post('/books/{id}/borrow', [AnggotaController::class, 'borrowBook'])->name('anggota.books.borrow');
    Route::get('/history', [AnggotaController::class, 'history'])->name('anggota.history');
    Route::get('/unreturned', [AnggotaController::class, 'unreturned'])->name('anggota.unreturned');
    Route::get('/report', [AnggotaController::class, 'report'])->name('anggota.report');
    
    // Borrowing Actions
    Route::post('/borrowings/{id}/request-extension', [AnggotaController::class, 'requestExtension'])->name('anggota.borrowings.request-extension');
    Route::post('/borrowings/{id}/return', [AnggotaController::class, 'returnBook'])->name('anggota.borrowings.return');
    
    // Profile Management
    Route::get('/profile', [AnggotaController::class, 'profile'])->name('anggota.profile');
    Route::put('/profile', [AnggotaController::class, 'updateProfile'])->name('anggota.profile.update');
    Route::put('/profile/password', [AnggotaController::class, 'updatePassword'])->name('anggota.profile.password');
});
