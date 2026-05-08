@extends('layouts.anggota')

@section('title', 'Katalog Buku')

@push('styles')
<style>
    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        border-radius: 16px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(139, 92, 246, 0.2);
        color: white;
    }

    .page-header h2 {
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .page-header p {
        margin: 0;
        opacity: 0.95;
        font-size: 1.05rem;
    }

    /* Search Card */
    .search-card {
        background: white;
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
    }

    .search-card .form-control,
    .search-card .form-select {
        padding: 12px 18px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .search-card .form-control:focus,
    .search-card .form-select:focus {
        border-color: #8b5cf6;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
    }

    .btn-search {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 700;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
    }

    .btn-search:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(139, 92, 246, 0.4);
        color: white;
    }

    /* Book Cards */
    .books-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }

    .book-card {
        background: white;
        border-radius: 16px;
        overflow: visible;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .book-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }

    .book-card:hover .book-cover-shape {
        transform: scale(1.05);
    }

    .book-cover-container-catalog {
        padding: 20px 20px 10px;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    }

    .book-cover-shape {
        position: relative;
        width: 100%;
        aspect-ratio: 2/3;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 
            0 10px 30px rgba(139, 92, 246, 0.15),
            0 5px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .book-cover {
        width: 100%;
        height: 100%;
        object-fit: cover;
        background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
    }

    .book-cover-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .book-card-body {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .book-id-badge {
        display: inline-block;
        padding: 4px 10px;
        background: linear-gradient(135deg, #94a3b8 0%, #64748b 100%);
        color: white;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .book-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 8px;
        line-height: 1.4;
        min-height: 45px;
    }

    .book-author {
        color: #64748b;
        font-size: 0.85rem;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .book-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 15px;
    }

    .badge-category {
        padding: 6px 12px;
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .badge-available {
        padding: 6px 12px;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .badge-unavailable {
        padding: 6px 12px;
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .btn-detail {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: white;
        border: none;
        padding: 12px;
        border-radius: 10px;
        font-weight: 700;
        text-align: center;
        transition: all 0.3s ease;
        text-decoration: none;
        display: block;
        margin-top: auto;
    }

    .btn-detail:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(139, 92, 246, 0.4);
        color: white;
    }

    /* Empty State */
    .empty-state {
        background: white;
        border-radius: 16px;
        padding: 60px 30px;
        text-align: center;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
    }

    .empty-state i {
        font-size: 4rem;
        color: #cbd5e1;
        margin-bottom: 20px;
    }

    .empty-state h5 {
        color: #64748b;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .empty-state p {
        color: #94a3b8;
        margin: 0;
    }

    /* Pagination */
    .pagination {
        justify-content: center;
        gap: 8px;
    }

    .pagination .page-link {
        border: 2px solid #e2e8f0;
        color: #64748b;
        border-radius: 8px;
        padding: 8px 14px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .pagination .page-link:hover {
        border-color: #8b5cf6;
        color: #8b5cf6;
        background: #f5f3ff;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        border-color: #8b5cf6;
        color: white;
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<div class="page-header">
    <h2><i class="fas fa-book me-2"></i>Katalog Buku</h2>
    <p>Temukan dan pinjam buku favorit Anda dari koleksi kami</p>
</div>

<!-- Search Card -->
<div class="search-card">
    <form action="{{ route('anggota.catalog') }}" method="GET" class="row g-3">
        <div class="col-md-5">
            <div class="input-group">
                <span class="input-group-text bg-white" style="border: 2px solid #e2e8f0; border-right: none; border-radius: 10px 0 0 10px;">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" name="search" class="form-control" placeholder="Cari judul, penulis, atau ISBN..." value="{{ request('search') }}" style="border-left: none;">
            </div>
        </div>
        <div class="col-md-4">
            <select name="category" class="form-select">
                <option value="">Semua Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                        {{ $category }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-search w-100">
                <i class="fas fa-search me-2"></i>Cari Buku
            </button>
        </div>
    </form>
</div>

<!-- Books Grid -->
@if($books->count() > 0)
    <div class="books-grid">
        @foreach($books as $book)
        <div class="book-card">
            <div class="book-cover-container-catalog">
                <div class="book-cover-shape">
                    @if($book->cover_image)
                        <img src="{{ asset('storage/' . $book->cover_image) }}" class="book-cover" alt="{{ $book->title }}" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="book-cover-placeholder" style="display: none;">
                            <i class="fas fa-book fa-5x"></i>
                        </div>
                    @else
                        <div class="book-cover-placeholder">
                            <i class="fas fa-book fa-5x"></i>
                        </div>
                    @endif
                </div>
            </div>
            <div class="book-card-body">
                <span class="book-id-badge">ID: {{ $book->id }}</span>
                <h6 class="book-title">{{ Str::limit($book->title, 50) }}</h6>
                <p class="book-author">
                    <i class="fas fa-user"></i>
                    <span>{{ Str::limit($book->author, 30) }}</span>
                </p>
                <div class="book-meta">
                    <span class="badge-category">{{ $book->category }}</span>
                    @if($book->available > 0)
                        <span class="badge-available">
                            <i class="fas fa-check-circle me-1"></i>Tersedia: {{ $book->available }}
                        </span>
                    @else
                        <span class="badge-unavailable">
                            <i class="fas fa-times-circle me-1"></i>Tidak Tersedia
                        </span>
                    @endif
                </div>
                <a href="{{ route('anggota.books.detail', $book->id) }}" class="btn-detail">
                    <i class="fas fa-eye me-2"></i>Lihat Detail
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    {{-- <div class="d-flex justify-content-center mt-4">
        {{ $books->links() }}
    </div> --}}
@else
    <div class="empty-state">
        <i class="fas fa-search"></i>
        <h5>Tidak Ada Buku Ditemukan</h5>
        <p>Coba gunakan kata kunci pencarian yang berbeda</p>
    </div>
@endif
@endsection
