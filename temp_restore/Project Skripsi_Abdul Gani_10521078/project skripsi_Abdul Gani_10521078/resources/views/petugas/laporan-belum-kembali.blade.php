@extends('layouts.petugas')

@section('title', 'Laporan Buku Belum Dikembalikan')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Laporan Buku Belum Dikembalikan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('petugas.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Laporan Buku Belum Dikembalikan</li>
    </ol>

    <!-- Filter Section -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-filter me-1"></i>
            Filter Laporan
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('petugas.laporan.belum-kembali') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="search" class="form-label">Cari (Nama/ID Anggota/ID Buku)</label>
                    <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Masukkan kata kunci...">
                </div>
                <div class="col-md-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">Semua Status</option>
                        <option value="terlambat" {{ request('status') == 'terlambat' ? 'selected' : '' }}>Terlambat</option>
                        <option value="belum_terlambat" {{ request('status') == 'belum_terlambat' ? 'selected' : '' }}>Belum Terlambat</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="sort" class="form-label">Urutkan</label>
                    <select class="form-select" id="sort" name="sort">
                        <option value="borrow_date" {{ request('sort') == 'borrow_date' ? 'selected' : '' }}>Tanggal Pinjam</option>
                        <option value="return_date" {{ request('sort') == 'return_date' ? 'selected' : '' }}>Tanggal Jatuh Tempo</option>
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
                            <div class="small">Total Belum Kembali</div>
                            <div class="fs-3 fw-bold">{{ $borrowings->count() }}</div>
                        </div>
                        <i class="fas fa-book-open fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="small">Terlambat</div>
                            <div class="fs-3 fw-bold">{{ $borrowings->where('return_date', '<', now())->count() }}</div>
                        </div>
                        <i class="fas fa-exclamation-triangle fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="small">Belum Terlambat</div>
                            <div class="fs-3 fw-bold">{{ $borrowings->where('return_date', '>=', now())->count() }}</div>
                        </div>
                        <i class="fas fa-clock fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-info text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="small">Total Anggota</div>
                            <div class="fs-3 fw-bold">{{ $borrowings->pluck('user_id')->unique()->count() }}</div>
                        </div>
                        <i class="fas fa-users fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Table -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Daftar Buku Belum Dikembalikan
            <div class="float-end">
                <a href="{{ route('petugas.laporan.belum-kembali', array_merge(request()->all(), ['export' => 'excel'])) }}" class="btn btn-success btn-sm">
                    <i class="fas fa-file-excel me-1"></i> Export Excel
                </a>
                <a href="{{ route('petugas.laporan.belum-kembali', array_merge(request()->all(), ['export' => 'pdf'])) }}" class="btn btn-danger btn-sm">
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
                            <th width="8%">ID Anggota</th>
                            <th width="15%">Nama Anggota</th>
                            <th width="8%">ID Buku</th>
                            <th width="20%">Judul Buku</th>
                            <th width="10%">Tgl Pinjam</th>
                            <th width="10%">Jatuh Tempo</th>
                            <th width="10%">Keterlambatan</th>
                            <th width="14%">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($borrowings as $index => $borrowing)
                        @php
                            $isLate = now()->gt($borrowing->due_date);
                            $daysLate = $isLate ? now()->diffInDays($borrowing->due_date) : 0;
                            $estDenda = $daysLate * 2000;
                        @endphp
                        <tr class="{{ $isLate ? 'table-danger' : '' }}">
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">
                                <span class="badge bg-secondary">{{ $borrowing->user->id }}</span>
                            </td>
                            <td>
                                <strong>{{ $borrowing->user->name }}</strong><br>
                                <small class="text-muted">{{ $borrowing->user->email }}</small>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-info">{{ $borrowing->book->id }}</span>
                            </td>
                            <td>
                                <strong>{{ $borrowing->book->title }}</strong><br>
                                <small class="text-muted">{{ $borrowing->book->author }}</small>
                            </td>
                            <td class="text-center">
                                {{ \Carbon\Carbon::parse($borrowing->borrow_date)->format('d M Y') }}
                            </td>
                            <td class="text-center">
                                {{ \Carbon\Carbon::parse($borrowing->due_date)->format('d M Y') }}
                            </td>
                            <td class="text-center">
                                @if($isLate)
                                    <span class="badge bg-danger mb-1">
                                        <i class="fas fa-exclamation-circle me-1"></i>
                                        {{ $daysLate }} hari
                                    </span>
                                    <br>
                                    <small class="fw-bold text-danger">
                                        Rp {{ number_format($estDenda, 0, ',', '.') }}<br>
                                        <span style="font-size: 0.7em">({{ $daysLate }} x 2.000)</span>
                                    </small>
                                @else
                                    <span class="badge bg-success">
                                        <i class="fas fa-check-circle me-1"></i>
                                        Tepat waktu
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($isLate)
                                    <span class="badge bg-danger w-100 p-2">
                                        <i class="fas fa-clock me-1"></i> TERLAMBAT
                                    </span>
                                @else
                                    <span class="badge bg-warning w-100 p-2">
                                        <i class="fas fa-hourglass-half me-1"></i> DIPINJAM
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
                Tidak ada buku yang belum dikembalikan saat ini.
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
