@extends('layouts.anggota')

@section('title', 'Buku Belum Dikembalikan')

@section('content')
<div class="hero-section">
    <div class="container">
        <h1><i class="fas fa-exclamation-triangle"></i> Buku Belum Dikembalikan</h1>
        <p class="lead">Daftar buku yang sedang Anda pinjam</p>
    </div>
</div>

<div class="container">
    <div class="card">
        <div class="card-body">
            @if($borrowings->count() > 0)
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                Anda memiliki <strong>{{ $borrowings->count() }}</strong> buku yang belum dikembalikan.
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-success">
                        <tr>
                            <th>No</th>
                            <th>ID Buku</th>
                            <th>Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Jatuh Tempo</th>
                            <th>Status</th>
                            <th class="text-end">Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($borrowings as $borrowing)
                        @php
                            $isLate = now()->gt($borrowing->due_date);
                            $daysRemaining = now()->diffInDays($borrowing->due_date, false);
                        @endphp
                        <tr class="{{ $isLate ? 'table-danger' : '' }}">
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-center">
                                <span class="badge bg-info">{{ $borrowing->book->id }}</span>
                            </td>
                            <td>
                                <strong>{{ $borrowing->book->title }}</strong><br>
                                <small class="text-muted">{{ $borrowing->book->author }}</small>
                            </td>
                            <td>{{ $borrowing->borrow_date->format('d/m/Y') }}</td>
                            <td>
                                {{ $borrowing->due_date->format('d/m/Y') }}
                                @if($isLate)
                                    <br><small class="text-danger">
                                        <i class="fas fa-exclamation-circle"></i> Terlambat {{ abs($daysRemaining) }} hari
                                    </small>
                                @elseif($daysRemaining <= 3)
                                    <br><small class="text-warning">
                                        <i class="fas fa-clock"></i> {{ $daysRemaining }} hari lagi
                                    </small>
                                @endif
                            </td>
                            <td>
                                @if($isLate)
                                    <span class="badge bg-danger">
                                        <i class="fas fa-exclamation-triangle"></i> Terlambat
                                    </span>
                                @elseif($daysRemaining <= 3)
                                    <span class="badge bg-warning">
                                        <i class="fas fa-clock"></i> Segera Jatuh Tempo
                                    </span>
                                @else
                                    <span class="badge bg-success">
                                        <i class="fas fa-check"></i> Normal
                                    </span>
                                @endif
                            </td>
                            <td class="text-end">
                                @php
                                    $lateDaysNow = now()->gt($borrowing->due_date) ? now()->startOfDay()->diffInDays($borrowing->due_date->startOfDay()) : 0;
                                    $currentLateFee = $lateDaysNow * 2000;
                                @endphp
                                @if($currentLateFee > 0)
                                    <span class="fw-bold">{{ number_format($currentLateFee,0,',','.') }}</span>
                                    <br>
                                    <small class="text-danger" style="font-size: 0.75rem;">
                                        ({{ $lateDaysNow }} hari x Rp 2.000)
                                    </small>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="alert alert-warning mt-4">
                <h6><i class="fas fa-info-circle me-2"></i>Informasi Penting:</h6>
                <ul class="mb-0">
                    <li>Harap kembalikan buku tepat waktu</li>
                    <li>Denda keterlambatan: <strong>Rp 2.000/hari</strong></li>
                    <li>Hubungi petugas jika memerlukan perpanjangan</li>
                </ul>
            </div>
            @else
            <div class="text-center py-5">
                <i class="fas fa-check-circle fa-4x text-success mb-3"></i>
                <h5>Tidak Ada Buku yang Belum Dikembalikan</h5>
                <p class="text-muted">Semua buku sudah dikembalikan tepat waktu!</p>
                <a href="{{ route('anggota.catalog') }}" class="btn btn-success mt-3">
                    <i class="fas fa-book"></i> Pinjam Buku Lagi
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
