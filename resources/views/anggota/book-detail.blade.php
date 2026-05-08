@extends('layouts.anggota')

@section('title', $book->title)

@push('styles')
<style>
    /* Breadcrumb Modern */
    .breadcrumb-modern {
        background: white;
        padding: 15px 20px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }

    .breadcrumb-modern .breadcrumb {
        margin: 0;
        background: transparent;
        padding: 0;
    }

    .breadcrumb-modern .breadcrumb-item a {
        color: #8b5cf6;
        text-decoration: none;
        font-weight: 600;
    }

    .breadcrumb-modern .breadcrumb-item.active {
        color: #64748b;
    }

    /* Book Cover Container */
    .book-cover-container {
        position: relative;
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 550px;
    }

    .book-cover-wrapper {
        position: relative;
        width: 100%;
        max-width: 320px;
        margin: 0 auto;
    }

    .book-cover-shape {
        position: relative;
        width: 100%;
        aspect-ratio: 2/3;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 
            0 15px 40px rgba(139, 92, 246, 0.2),
            0 8px 20px rgba(0, 0, 0, 0.1);
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        transition: all 0.3s ease;
    }

    .book-cover-shape:hover {
        transform: translateY(-8px);
        box-shadow: 
            0 20px 50px rgba(139, 92, 246, 0.25),
            0 12px 30px rgba(0, 0, 0, 0.15);
    }

    .book-cover-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        position: relative;
        display: block;
    }

    .book-cover-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        position: relative;
    }

    /* Book Info Card */
    .book-info-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
    }

    .book-id-badge {
        display: inline-block;
        padding: 8px 16px;
        background: linear-gradient(135deg, #94a3b8 0%, #64748b 100%);
        color: white;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .book-title {
        font-size: 2.2rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 20px;
        line-height: 1.3;
    }

    /* Info Table */
    .info-table {
        margin: 25px 0;
    }

    .info-row {
        display: flex;
        padding: 12px 0;
        border-bottom: 1px solid #e2e8f0;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        flex: 0 0 150px;
        font-weight: 700;
        color: #475569;
        font-size: 0.9rem;
    }

    .info-value {
        flex: 1;
        color: #1e293b;
        font-size: 0.95rem;
    }

    .badge-category {
        padding: 6px 12px;
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .badge-available {
        padding: 6px 12px;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .badge-unavailable {
        padding: 6px 12px;
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    /* Description Box */
    .description-box {
        background: #f8fafc;
        padding: 20px;
        border-radius: 12px;
        border-left: 4px solid #8b5cf6;
        margin: 25px 0;
    }

    .description-box h5 {
        color: #1e293b;
        font-weight: 700;
        margin-bottom: 15px;
        font-size: 1.1rem;
    }

    .description-box p {
        color: #64748b;
        line-height: 1.7;
        margin: 0;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 15px;
        margin-top: 30px;
    }

    .btn-borrow {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: white;
        border: none;
        padding: 14px 28px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(139, 92, 246, 0.3);
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .btn-borrow:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(139, 92, 246, 0.4);
        color: white;
    }

    .btn-back {
        background: white;
        color: #64748b;
        border: 2px solid #e2e8f0;
        padding: 14px 28px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .btn-back:hover {
        border-color: #8b5cf6;
        color: #8b5cf6;
        background: #f5f3ff;
    }

    .btn-unavailable {
        background: #e2e8f0;
        color: #94a3b8;
        border: none;
        padding: 14px 28px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1rem;
        cursor: not-allowed;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }
</style>
@endpush

@section('content')
<!-- Breadcrumb -->
<div class="breadcrumb-modern">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('anggota.dashboard') }}"><i class="fas fa-home me-1"></i>Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('anggota.catalog') }}">Katalog</a></li>
            <li class="breadcrumb-item active">{{ Str::limit($book->title, 50) }}</li>
        </ol>
    </nav>
</div>

<!-- Book Detail -->
<div class="row">
    <!-- Book Cover -->
    <div class="col-md-4">
        <div class="book-cover-container">
            <div class="book-cover-wrapper">
                <div class="book-cover-shape">
                    @if($book->cover_image)
                        <img src="{{ asset('storage/' . $book->cover_image) }}" class="book-cover-image" alt="{{ $book->title }}" onerror="this.parentElement.innerHTML='<div class=\'book-cover-placeholder\'><i class=\'fas fa-book fa-8x\'></i></div>'">
                    @else
                        <div class="book-cover-placeholder">
                            <i class="fas fa-book fa-8x"></i>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Book Information -->
    <div class="col-md-8">
        <div class="book-info-card">
            <span class="book-id-badge">
                <i class="fas fa-hashtag"></i> ID: {{ $book->id }}
            </span>
            <h1 class="book-title">{{ $book->title }}</h1>

            <div class="info-table">
                <div class="info-row">
                    <div class="info-label"><i class="fas fa-user me-2"></i>Penulis</div>
                    <div class="info-value">{{ $book->author }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label"><i class="fas fa-building me-2"></i>Penerbit</div>
                    <div class="info-value">{{ $book->publisher }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label"><i class="fas fa-calendar me-2"></i>Tahun Terbit</div>
                    <div class="info-value">{{ $book->year }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label"><i class="fas fa-barcode me-2"></i>ISBN</div>
                    <div class="info-value">{{ $book->isbn }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label"><i class="fas fa-tag me-2"></i>Kategori</div>
                    <div class="info-value">
                        <span class="badge-category">{{ $book->category }}</span>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-label"><i class="fas fa-tag me-2"></i>Harga</div>
                    <div class="info-value">
                        Rp {{ number_format($book->price, 0, ',', '.') }}
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-label"><i class="fas fa-boxes me-2"></i>Stok Total</div>
                    <div class="info-value">{{ $book->stock }} Buku</div>
                </div>
                <div class="info-row">
                    <div class="info-label"><i class="fas fa-check-circle me-2"></i>Tersedia</div>
                    <div class="info-value">
                        @if($book->available > 0)
                            <span class="badge-available">
                                <i class="fas fa-book me-1"></i>{{ $book->available }} Buku Tersedia
                            </span>
                        @else
                            <span class="badge-unavailable">
                                <i class="fas fa-times-circle me-1"></i>Tidak Tersedia
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            @if($book->description)
            <div class="description-box">
                <h5><i class="fas fa-info-circle me-2"></i>Deskripsi Buku</h5>
                <p>{{ $book->description }}</p>
            </div>
            @endif

            <div class="action-buttons">
                @if($book->available > 0)
                    <button type="button" class="btn-borrow" data-bs-toggle="modal" data-bs-target="#borrowModal">
                        <i class="fas fa-hand-holding"></i>
                        <span>Ajukan Peminjaman</span>
                    </button>
                @else
                    <button class="btn-unavailable" disabled>
                        <i class="fas fa-times-circle"></i>
                        <span>Buku Tidak Tersedia</span>
                    </button>
                @endif
                <a href="{{ route('anggota.catalog') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali ke Katalog</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Borrow Modal -->
<div class="modal fade" id="borrowModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border: none; border-radius: 16px; overflow: hidden;">
            <form action="{{ route('anggota.books.borrow', $book->id) }}" method="POST" id="borrowForm">
                @csrf
                <!-- Modal Header -->
                <div class="modal-header" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; padding: 24px 30px; border: none;">
                    <h5 class="modal-title fw-bold" style="font-size: 1.3rem;">
                        <i class="fas fa-hand-holding me-2"></i> Form Peminjaman Buku
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body" style="padding: 30px;">
                    <!-- Info Alert -->
                    <div style="background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); padding: 16px; border-radius: 12px; margin-bottom: 25px; border-left: 4px solid #3b82f6;">
                        <div style="display: flex; align-items: start; gap: 12px;">
                            <i class="fas fa-info-circle" style="color: #3b82f6; font-size: 1.2rem; margin-top: 2px;"></i>
                            <div>
                                <strong style="color: #1e40af; display: block; margin-bottom: 4px; font-size: 1rem;">Detail Peminjaman</strong>
                                <span style="color: #1e3a8a; font-size: 0.9rem;">Pastikan data di bawah sudah benar sebelum mengajukan peminjaman.</span>
                            </div>
                        </div>
                    </div>

                    <!-- Book Details Grid -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div style="background: #f8fafc; padding: 16px; border-radius: 10px; border: 2px solid #e2e8f0;">
                                <label class="fw-bold mb-2" style="color: #64748b; font-size: 0.85rem;">
                                    <i class="fas fa-hashtag me-1" style="color: #8b5cf6;"></i>ID BUKU
                                </label>
                                <p class="mb-0 fw-bold" style="color: #1e293b; font-size: 1.1rem;">{{ $book->id }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div style="background: #f8fafc; padding: 16px; border-radius: 10px; border: 2px solid #e2e8f0;">
                                <label class="fw-bold mb-2" style="color: #64748b; font-size: 0.85rem;">
                                    <i class="fas fa-barcode me-1" style="color: #8b5cf6;"></i>ISBN
                                </label>
                                <p class="mb-0 fw-bold" style="color: #1e293b; font-size: 1.1rem;">{{ $book->isbn }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div style="background: #f8fafc; padding: 16px; border-radius: 10px; border: 2px solid #e2e8f0;">
                            <label class="fw-bold mb-2" style="color: #64748b; font-size: 0.85rem;">
                                <i class="fas fa-book me-1" style="color: #8b5cf6;"></i>JUDUL BUKU
                            </label>
                            <p class="mb-0 fw-bold" style="color: #1e293b; font-size: 1.05rem;">{{ $book->title }}</p>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div style="background: #f8fafc; padding: 16px; border-radius: 10px; border: 2px solid #e2e8f0;">
                                <label class="fw-bold mb-2" style="color: #64748b; font-size: 0.85rem;">
                                    <i class="fas fa-user me-1" style="color: #8b5cf6;"></i>PENULIS
                                </label>
                                <p class="mb-0 fw-bold" style="color: #1e293b;">{{ $book->author }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div style="background: #f8fafc; padding: 16px; border-radius: 10px; border: 2px solid #e2e8f0;">
                                <label class="fw-bold mb-2" style="color: #64748b; font-size: 0.85rem;">
                                    <i class="fas fa-check-circle me-1" style="color: #8b5cf6;"></i>KETERSEDIAAN
                                </label>
                                <p class="mb-0">
                                    <span style="padding: 6px 12px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border-radius: 8px; font-size: 0.85rem; font-weight: 700;">
                                        <i class="fas fa-book me-1"></i>{{ $book->available }} Buku Tersedia
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <hr style="margin: 30px 0; border-top: 2px solid #e2e8f0;">

                    <!-- Duration Info -->
                    <div class="mb-4">
                        <label class="form-label fw-bold" style="color: #475569; margin-bottom: 10px; font-size: 1rem;">
                            <i class="fas fa-clock me-2" style="color: #8b5cf6;"></i>Durasi Peminjaman
                        </label>
                        <div style="background: #f8fafc; padding: 12px 16px; border-radius: 10px; border: 2px solid #e2e8f0; color: #1e293b; font-weight: 600;">
                            7 Hari (Satu Minggu)
                        </div>
                        <small style="color: #64748b; font-size: 0.85rem; margin-top: 6px; display: block;">
                            <i class="fas fa-info-circle me-1"></i>Tanggal pengembalian akan dihitung otomatis sejak persetujuan peminjaman.
                        </small>
                    </div>

                    <hr style="margin: 30px 0; border-top: 2px solid #e2e8f0;">

                    <!-- Terms & Conditions -->
                    <div style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); padding: 20px; border-radius: 12px; margin-bottom: 20px; border-left: 4px solid #f59e0b;">
                        <h6 class="fw-bold mb-3" style="color: #92400e; font-size: 1rem;">
                            <i class="fas fa-clipboard-list me-2"></i>Syarat & Ketentuan Peminjaman
                        </h6>
                        <div style="max-height: 200px; overflow-y: auto; padding-right: 10px;">
                            <ol style="margin: 0; padding-left: 20px; color: #78350f; font-size: 0.9rem; line-height: 1.9;">
                                <li>Anggota wajib menjaga kondisi buku yang dipinjam dengan baik.</li>
                                <li>Buku harus dikembalikan paling lambat 7 hari setelah peminjaman disetujui.</li>
                                <li>Keterlambatan pengembalian akan dikenakan <strong>denda Rp 2.000 per hari</strong>.</li>
                                <li>Jika buku hilang atau rusak, peminjam wajib mengganti dengan buku yang sama atau membayar ganti rugi.</li>
                                <li>Peminjam bertanggung jawab penuh atas buku yang dipinjam.</li>
                                <li>Perpustakaan berhak menolak permintaan peminjaman jika syarat tidak terpenuhi.</li>
                                <li>Anggota hanya boleh meminjam maksimal <strong>3 buku</strong> dalam waktu bersamaan.</li>
                                <li>Buku referensi dan koleksi khusus tidak dapat dipinjam untuk dibawa pulang.</li>
                            </ol>
                        </div>
                    </div>

                    <!-- Agreement Checkbox -->
                    <div class="form-check" style="padding: 16px; background: #f8fafc; border-radius: 10px; border: 2px solid #e2e8f0; margin-bottom: 20px;">
                        <input class="form-check-input" type="checkbox" name="terms_accepted" value="1" id="termsCheck" required
                            style="width: 20px; height: 20px; border: 2px solid #8b5cf6; cursor: pointer;">
                        <label class="form-check-label" for="termsCheck" style="margin-left: 8px; color: #1e293b; font-weight: 700; cursor: pointer; font-size: 0.95rem;">
                            Saya telah membaca dan menyetujui syarat & ketentuan peminjaman buku di atas
                        </label>
                    </div>

                    <!-- Warning Alert -->
                    <div style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); padding: 16px; border-radius: 10px; border-left: 4px solid #f59e0b;">
                        <div style="display: flex; align-items: start; gap: 12px;">
                            <i class="fas fa-info-circle" style="color: #f59e0b; font-size: 1.1rem; margin-top: 2px;"></i>
                            <span style="color: #78350f; font-size: 0.9rem; line-height: 1.6;">
                                Permintaan peminjaman Anda akan diproses oleh <strong>petugas perpustakaan</strong>. Anda akan menerima notifikasi setelah permintaan disetujui atau ditolak.
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer" style="padding: 20px 30px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
                    <button type="button" class="btn" data-bs-dismiss="modal" 
                        style="background: white; color: #64748b; border: 2px solid #e2e8f0; padding: 10px 24px; border-radius: 10px; font-weight: 700; transition: all 0.3s ease;">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <button type="submit" class="btn" id="submitBtn" disabled
                        style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; border: none; padding: 10px 24px; border-radius: 10px; font-weight: 700; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);">
                        <i class="fas fa-paper-plane me-2"></i>Kirim Permintaan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Modal Custom Styles */
    #borrowModal .form-control:focus {
        border-color: #8b5cf6 !important;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1) !important;
    }

    #borrowModal .form-check-input:checked {
        background-color: #8b5cf6;
        border-color: #8b5cf6;
    }

    #borrowModal .modal-footer .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
    }

    #borrowModal input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(46%) sepia(95%) saturate(1820%) hue-rotate(233deg) brightness(93%) contrast(93%);
        cursor: pointer;
    }

    #borrowModal #submitBtn:disabled {
        background: #cbd5e1 !important;
        cursor: not-allowed;
        box-shadow: none !important;
    }

    #borrowModal #submitBtn:not(:disabled):hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(139, 92, 246, 0.4) !important;
    }
</style>
@endpush

@push('scripts')
<script>
    // Enable submit button only when terms are accepted
    document.getElementById('termsCheck').addEventListener('change', function() {
        document.getElementById('submitBtn').disabled = !this.checked;
    });
</script>
@endpush
@endsection
