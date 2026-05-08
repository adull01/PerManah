@extends('layouts.petugas')

@section('title', 'Laporan Buku Sedang Dipinjam')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Laporan Buku Sedang Dipinjam</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('petugas.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Laporan Buku Sedang Dipinjam</li>
    </ol>

    <!-- Filter Section -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-filter me-1"></i>
            Filter Laporan
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('petugas.laporan.buku-dipinjam') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="search" class="form-label">Cari (Judul/Pengarang/ID Buku)</label>
                    <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Masukkan kata kunci...">
                </div>
                <div class="col-md-3">
                    <label for="category" class="form-label">Kategori</label>
                    <select class="form-select" id="category" name="category">
                        <option value="">Semua Kategori</option>
                        <option value="Fiksi" {{ request('category') == 'Fiksi' ? 'selected' : '' }}>Fiksi</option>
                        <option value="Non-Fiksi" {{ request('category') == 'Non-Fiksi' ? 'selected' : '' }}>Non-Fiksi</option>
                        <option value="Sains" {{ request('category') == 'Sains' ? 'selected' : '' }}>Sains</option>
                        <option value="Teknologi" {{ request('category') == 'Teknologi' ? 'selected' : '' }}>Teknologi</option>
                        <option value="Sejarah" {{ request('category') == 'Sejarah' ? 'selected' : '' }}>Sejarah</option>
                        <option value="Biografi" {{ request('category') == 'Biografi' ? 'selected' : '' }}>Biografi</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="sort" class="form-label">Urutkan</label>
                    <select class="form-select" id="sort" name="sort">
                        <option value="borrow_date" {{ request('sort') == 'borrow_date' ? 'selected' : '' }}>Tanggal Pinjam</option>
                        <option value="book_title" {{ request('sort') == 'book_title' ? 'selected' : '' }}>Judul Buku</option>
                        <option value="member_name" {{ request('sort') == 'member_name' ? 'selected' : '' }}>Nama Anggota</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search me-1"></i> Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Statistics Card -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="small">Total Dipinjam</div>
                            <div class="fs-3 fw-bold">{{ $borrowings->count() }}</div>
                        </div>
                        <i class="fas fa-book fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="small">Judul Unik</div>
                            <div class="fs-3 fw-bold">{{ $borrowings->pluck('book_id')->unique()->count() }}</div>
                        </div>
                        <i class="fas fa-bookmark fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-info text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="small">Total Peminjam</div>
                            <div class="fs-3 fw-bold">{{ $borrowings->pluck('user_id')->unique()->count() }}</div>
                        </div>
                        <i class="fas fa-users fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="small">Kategori Aktif</div>
                            <div class="fs-3 fw-bold">{{ $borrowings->map(fn($b) => $b->book->category)->unique()->count() }}</div>
                        </div>
                        <i class="fas fa-layer-group fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Table -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Daftar Buku Sedang Dipinjam
            <div class="float-end">
                <a href="{{ route('petugas.laporan.buku-dipinjam', array_merge(request()->all(), ['export' => 'excel'])) }}" class="btn btn-success btn-sm">
                    <i class="fas fa-file-excel me-1"></i> Export Excel
                </a>
                <a href="{{ route('petugas.laporan.buku-dipinjam', array_merge(request()->all(), ['export' => 'pdf'])) }}" class="btn btn-danger btn-sm">
                    <i class="fas fa-file-pdf me-1"></i> Export PDF
                </a>
            </div>
        </div>
        <div class="card-body">
            @if($borrowings->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="8%">ID Buku</th>
                            <th width="22%">Judul Buku</th>
                            <th width="12%">Kategori</th>
                            <th width="8%">ID Anggota</th>
                            <th width="17%">Nama Anggota</th>
                            <th width="10%">Tgl Pinjam</th>
                            <th width="10%">Jatuh Tempo</th>
                            <th width="8%">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($borrowings as $index => $borrowing)
                        @php
                            $isLate = now()->gt($borrowing->return_date);
                            $daysRemaining = now()->diffInDays($borrowing->return_date, false);
                        @endphp
                        <tr class="{{ $isLate ? 'table-warning' : '' }}">
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">
                                <span class="badge bg-info">{{ $borrowing->book->id }}</span>
                            </td>
                            <td>
                                <strong>{{ $borrowing->book->title }}</strong><br>
                                <small class="text-muted">
                                    <i class="fas fa-user me-1"></i>{{ $borrowing->book->author }}<br>
                                    <i class="fas fa-calendar me-1"></i>{{ $borrowing->book->publish_year }}
                                </small>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-secondary">{{ $borrowing->book->category }}</span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-primary">{{ $borrowing->user->id }}</span>
                            </td>
                            <td>
                                <strong>{{ $borrowing->user->name }}</strong><br>
                                <small class="text-muted">{{ $borrowing->user->email }}</small>
                            </td>
                            <td class="text-center">
                                {{ \Carbon\Carbon::parse($borrowing->borrow_date)->format('d M Y') }}
                            </td>
                            <td class="text-center">
                                {{ \Carbon\Carbon::parse($borrowing->return_date)->format('d M Y') }}
                                @if(!$isLate && $daysRemaining <= 3)
                                    <br><small class="text-warning">
                                        <i class="fas fa-exclamation-triangle"></i> {{ abs($daysRemaining) }} hari lagi
                                    </small>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($isLate)
                                    <span class="badge bg-danger">
                                        <i class="fas fa-exclamation-circle me-1"></i>
                                        Terlambat
                                    </span>
                                @elseif($daysRemaining <= 3)
                                    <span class="badge bg-warning">
                                        <i class="fas fa-clock me-1"></i>
                                        Segera
                                    </span>
                                @else
                                    <span class="badge bg-success">
                                        <i class="fas fa-check-circle me-1"></i>
                                        Normal
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle me-2"></i>
                Tidak ada buku yang sedang dipinjam saat ini.
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
