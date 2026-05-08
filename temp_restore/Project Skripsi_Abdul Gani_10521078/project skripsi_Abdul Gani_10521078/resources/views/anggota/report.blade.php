@extends('layouts.anggota')

@section('title', 'Laporan Peminjaman')

@section('content')
<div class="hero-section">
    <div class="container">
        <h1><i class="fas fa-chart-line"></i> Laporan Peminjaman Saya</h1>
        <p class="lead">Lihat laporan dan statistik peminjaman buku Anda</p>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2 mb-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <i class="fas fa-filter"></i> Filter Laporan
                </div>
                <div class="card-body">
                    <form action="{{ route('anggota.report') }}" method="GET" class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label">Pilih Bulan & Tahun</label>
                            <input type="month" name="month" class="form-control" value="{{ $month }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">&nbsp;</label>
                            <button type="submit" class="btn btn-success w-100">
                                <i class="fas fa-search"></i> Tampilkan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card border-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Total Peminjaman Bulan Ini</h6>
                            <h2 class="mb-0">{{ $borrowings->count() }} <small class="text-muted">buku</small></h2>
                        </div>
                        <div>
                            <i class="fas fa-book-open fa-3x text-primary opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card border-danger">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Buku Belum Dikembalikan</h6>
                            <h2 class="mb-0">{{ $unreturned->count() }} <small class="text-muted">buku</small></h2>
                        </div>
                        <div>
                            <i class="fas fa-exclamation-triangle fa-3x text-danger opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Buku Belum Dikembalikan -->
    @if($unreturned->count() > 0)
    <div class="card mb-4 border-danger">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0"><i class="fas fa-exclamation-circle"></i> Buku yang Belum Dikembalikan</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-danger">
                        <tr>
                            <th>No</th>
                            <th>ID Buku</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Jatuh Tempo</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($unreturned as $borrowing)
                        <tr class="{{ $borrowing->due_date < now() ? 'table-danger' : '' }}">
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>#{{ $borrowing->book->id }}</strong></td>
                            <td>
                                <strong>{{ $borrowing->book->title }}</strong><br>
                                <small class="text-muted">{{ $borrowing->book->author }}</small>
                            </td>
                            <td>{{ $borrowing->borrow_date->format('d/m/Y') }}</td>
                            <td>
                                {{ $borrowing->due_date->format('d/m/Y') }}
                                @if($borrowing->due_date < now())
                                    <br><span class="badge bg-danger">TERLAMBAT {{ now()->diffInDays($borrowing->due_date) }} hari</span>
                                @else
                                    <br><small class="text-muted">{{ now()->diffInDays($borrowing->due_date) }} hari lagi</small>
                                @endif
                            </td>
                            <td><span class="badge bg-info">Sedang Dipinjam</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="alert alert-warning mt-3">
                <i class="fas fa-info-circle"></i> <strong>Perhatian:</strong> Harap segera mengembalikan buku yang sudah jatuh tempo untuk menghindari denda.
            </div>
        </div>
    </div>
    @endif

    <!-- Laporan Bulanan -->
    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0"><i class="fas fa-calendar-alt"></i> Laporan Peminjaman Bulan {{ \Carbon\Carbon::parse($month)->format('F Y') }}</h5>
        </div>
        <div class="card-body">
            @if($borrowings->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-success">
                            <tr>
                                <th>No</th>
                                <th>ID Buku</th>
                                <th>Judul Buku</th>
                                <th>Penulis</th>
                                <th>Tgl Pinjam</th>
                                <th>Jatuh Tempo</th>
                                <th>Tgl Kembali</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($borrowings as $borrowing)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>#{{ $borrowing->book->id }}</strong></td>
                                <td>{{ $borrowing->book->title }}</td>
                                <td>{{ $borrowing->book->author }}</td>
                                <td>{{ $borrowing->borrow_date->format('d/m/Y') }}</td>
                                <td>{{ $borrowing->due_date->format('d/m/Y') }}</td>
                                <td>{{ $borrowing->return_date ? $borrowing->return_date->format('d/m/Y') : '-' }}</td>
                                <td>
                                    @if($borrowing->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($borrowing->status == 'approved')
                                        <span class="badge bg-info">Dipinjam</span>
                                    @elseif($borrowing->status == 'returned')
                                        <span class="badge bg-success">Dikembalikan</span>
                                    @else
                                        <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Summary -->
                <div class="row mt-4">
                    <div class="col-md-3">
                        <div class="text-center p-3 border rounded">
                            <h6 class="text-muted">Total Pinjam</h6>
                            <h3>{{ $borrowings->count() }}</h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center p-3 border rounded">
                            <h6 class="text-muted">Disetujui</h6>
                            <h3 class="text-success">{{ $borrowings->whereIn('status', ['approved', 'returned'])->count() }}</h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center p-3 border rounded">
                            <h6 class="text-muted">Dikembalikan</h6>
                            <h3 class="text-info">{{ $borrowings->where('status', 'returned')->count() }}</h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center p-3 border rounded">
                            <h6 class="text-muted">Ditolak</h6>
                            <h3 class="text-danger">{{ $borrowings->where('status', 'rejected')->count() }}</h3>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                    <p class="text-muted">Tidak ada data peminjaman untuk bulan ini</p>
                    <a href="{{ route('anggota.catalog') }}" class="btn btn-success">
                        <i class="fas fa-book"></i> Mulai Pinjam Buku
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
