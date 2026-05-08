@extends('layouts.petugas')

@section('title', 'Kelola Buku')
@section('page-title', 'Kelola Buku')

@push('styles')
<style>
    .page-header-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .btn-add {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(139, 92, 246, 0.3);
        color: white;
    }

    .data-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .data-card-header {
        padding: 20px 25px;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .data-card-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .data-card-title i {
        color: #8b5cf6;
    }

    .search-box {
        position: relative;
        width: 300px;
    }

    .search-box input {
        width: 100%;
        padding: 10px 15px 10px 40px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .search-box input:focus {
        outline: none;
        border-color: #8b5cf6;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
    }

    .search-box i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
    }

    .table-modern {
        width: 100%;
        margin: 0;
    }

    .table-modern thead {
        background: #f8fafc;
    }

    .table-modern thead th {
        padding: 15px 20px;
        font-size: 0.85rem;
        font-weight: 700;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e2e8f0;
    }

    .table-modern tbody tr {
        transition: all 0.2s ease;
    }

    .table-modern tbody tr:hover {
        background: #f8fafc;
    }

    .table-modern tbody td {
        padding: 18px 20px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.9rem;
        color: #334155;
    }

    .book-cover-thumb-container {
        width: 50px;
        height: 70px;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.15);
        position: relative;
    }

    .book-cover-thumb {
        width: 100%;
        height: 100%;
        object-fit: cover;
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
    }

    .badge-modern {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
    }

    .badge-id {
        background: #dbeafe;
        color: #1e40af;
    }

    .badge-category {
        background: #e0e7ff;
        color: #4338ca;
    }

    .badge-stock {
        background: #ede9fe;
        color: #5b21b6;
    }

    .badge-stock.low {
        background: #fee2e2;
        color: #991b1b;
    }

    .btn-action {
        padding: 8px 12px;
        border-radius: 8px;
        border: none;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        text-decoration: none;
        margin: 2px;
    }

    .btn-action.btn-edit {
        background: #fef3c7;
        color: #92400e;
    }

    .btn-action.btn-edit:hover {
        background: #fde047;
        transform: translateY(-2px);
    }

    .btn-action.btn-delete {
        background: #fee2e2;
        color: #991b1b;
    }

    .btn-action.btn-delete:hover {
        background: #fca5a5;
        transform: translateY(-2px);
    }

    .pagination-wrapper {
        padding: 20px 25px;
        border-top: 1px solid #e2e8f0;
        display: flex;
        justify-content: center;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #64748b;
    }

    .empty-state i {
        font-size: 4rem;
        color: #cbd5e1;
        margin-bottom: 20px;
    }

    .empty-state h5 {
        font-size: 1.2rem;
        font-weight: 700;
        color: #475569;
        margin-bottom: 10px;
    }

    .empty-state p {
        font-size: 0.95rem;
    }

    /* Book Cover Thumbnail */
    .book-cover-thumb-container {
        width: 60px;
        height: 80px;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.15);
        transition: all 0.3s ease;
    }

    .book-cover-thumb-container:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 16px rgba(139, 92, 246, 0.25);
    }

    .book-cover-thumb {
        width: 100%;
        height: 100%;
        object-fit: cover;
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
        font-size: 1.5rem;
    }
</style>
@endpush

@section('content')
<div class="page-header-actions">
    <div class="breadcrumb-custom">
        <a href="{{ route('petugas.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
        <span>/</span>
        <span>Kelola Buku</span>
    </div>
    <a href="{{ route('petugas.books.create') }}" class="btn-add">
        <i class="fas fa-plus-circle"></i>
        Tambah Buku Baru
    </a>
</div>

<div class="data-card">
    <div class="data-card-header">
        <div class="data-card-title">
            <i class="fas fa-book"></i>
            Daftar Buku
        </div>
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Cari buku...">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table-modern">
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th style="width: 80px;">ID</th>
                    <th style="width: 80px;">Cover</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>ISBN</th>
                    <th style="width: 100px;">Tahun</th>
                    <th style="width: 130px;">Kategori</th>
                    <th style="width: 100px;">Harga</th>
                    <th style="width: 80px; text-align: center;">Stok</th>
                    <th style="width: 100px; text-align: center;">Tersedia</th>
                    <th style="width: 160px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                <tr>
                    <td>{{ $loop->iteration + ($books->currentPage() - 1) * $books->perPage() }}</td>
                    <td>
                        <span class="badge-modern badge-id">{{ $book->id }}</span>
                    </td>
                    <td>
                        <div class="book-cover-thumb-container">
                            @if($book->cover_image)
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="book-cover-thumb">
                            @else
                                <div class="book-cover-placeholder">
                                    <i class="fas fa-book"></i>
                                </div>
                            @endif
                        </div>
                    </td>
                    <td>
                        <strong>{{ $book->title }}</strong><br>
                        <small style="color: #64748b;">{{ $book->publisher }}</small>
                    </td>
                    <td>{{ $book->author }}</td>
                    <td><code style="font-size: 0.85rem; background: #f1f5f9; padding: 4px 8px; border-radius: 4px;">{{ $book->isbn }}</code></td>
                    <td>{{ $book->year }}</td>
                    <td>
                        <span class="badge-modern badge-category">{{ $book->category }}</span>
                    </td>
                    <td>
                        Rp {{ number_format($book->price, 0, ',', '.') }}
                    </td>
                    <td style="text-align: center;">
                        <strong>{{ $book->stock }}</strong>
                    </td>
                    <td style="text-align: center;">
                        <span class="badge-modern badge-stock {{ $book->available < 5 ? 'low' : '' }}">
                            {{ $book->available }}
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <a href="{{ route('petugas.books.edit', $book) }}" class="btn-action btn-edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('petugas.books.destroy', $book) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="11">
                        <div class="empty-state">
                            <i class="fas fa-book-open"></i>
                            <h5>Belum Ada Data Buku</h5>
                            <p>Silakan tambahkan buku baru untuk memulai</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($books->hasPages())
    <div class="pagination-wrapper">
        {{ $books->links('pagination::bootstrap-4') }}
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    // Simple search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toUpperCase();
        let table = document.querySelector('.table-modern tbody');
        let tr = table.getElementsByTagName('tr');

        for (let i = 0; i < tr.length; i++) {
            let td = tr[i].getElementsByTagName('td');
            let found = false;
            
            for (let j = 0; j < td.length; j++) {
                if (td[j]) {
                    let txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
            }
            
            tr[i].style.display = found ? '' : 'none';
        }
    });
</script>
@endpush

