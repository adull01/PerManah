@extends('layouts.admin')

@section('title', 'Laporan Denda Per Anggota')
@section('page-title', 'Laporan Denda Per Anggota')

@section('content')
<div class="breadcrumb-custom" style="margin-bottom: 25px;">
    <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
    <span>/</span>
    <a href="{{ route('admin.reports') }}">Laporan Peminjaman</a>
    <span>/</span>
    <span>Laporan Denda</span>
</div>

<!-- Page Title & Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="page-header-title">
        <h2 class="fw-bold text-slate-800 mb-0">Laporan Denda Per Anggota</h2>
        <p class="text-slate-500 mb-0">Ringkasan akumulasi denda anggota perpustakaan</p>
    </div>
    <a href="{{ route('admin.reports', ['month' => $month]) }}" class="btn btn-outline-secondary rounded-pill px-4">
        <i class="fas fa-arrow-left me-2"></i> Kembali ke Laporan
    </a>
</div>

<div class="filter-card">
    <div class="filter-header">
        <i class="fas fa-calendar-alt"></i>
        Filter Periode
    </div>
    <form action="{{ route('admin.reports.fees') }}" method="GET" class="row g-3 align-items-end">
        <div class="col-md-4">
            <label class="form-label" style="font-weight: 600; color: #475569;">Pilih Bulan</label>
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 rounded-start-10"><i class="fas fa-clock text-slate-400"></i></span>
                <input type="month" name="month" class="form-control border-start-0 rounded-end-10 py-2" value="{{ $month }}">
            </div>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100 rounded-10 py-2 fw-semibold" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); border: none;">
                <i class="fas fa-filter me-2"></i> Filter
            </button>
        </div>
    </form>
</div>

<div class="card border-0 shadow-sm rounded-16 overflow-hidden">
    <div class="card-header bg-white py-3 border-bottom border-light">
        <div class="d-flex align-items-center gap-2">
            <div class="bg-warning bg-opacity-10 p-2 rounded-lg">
                <i class="fas fa-coins text-warning"></i>
            </div>
            <h5 class="fw-bold text-slate-800 mb-0">Ringkasan Denda Bulan {{ \Carbon\Carbon::parse($month)->format('F Y') }}</h5>
        </div>
    </div>
    <div class="table-responsive p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4 border-0 py-3 text-slate-600 fw-bold text-uppercase small" style="width: 80px;">No</th>
                    <th class="border-0 py-3 text-slate-600 fw-bold text-uppercase small">Anggota</th>
                    <th class="border-0 py-3 text-slate-600 fw-bold text-uppercase small text-center">Peminjaman</th>
                    <th class="border-0 py-3 text-slate-600 fw-bold text-uppercase small text-end">Total Denda</th>
                    <th class="border-0 py-3 text-slate-600 fw-bold text-uppercase small text-end pe-4">Denda Belum Dibayar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($feesPerUser as $item)
                <tr>
                    <td class="ps-4">
                        <span class="text-slate-400 fw-bold">#{{ $loop->iteration }}</span>
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-indigo bg-opacity-10 text-indigo rounded-circle d-flex align-items-center justify-content-center fw-bold small" style="width: 38px; height: 38px;">
                                {{ strtoupper(substr($item->user->name, 0, 1)) }}
                            </div>
                            <div>
                                <h6 class="fw-bold text-slate-700 mb-0">{{ $item->user->name }}</h6>
                                <p class="text-slate-400 small mb-0">{{ $item->user->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <span class="badge bg-indigo bg-opacity-10 text-indigo rounded-pill px-3">{{ $item->totalBorrowings }}x</span>
                    </td>
                    <td class="text-end fw-bold text-slate-700">
                        Rp {{ number_format($item->totalFees, 0, ',', '.') }}
                    </td>
                    <td class="text-end pe-4">
                        @if($item->unpaidFees > 0)
                            <span class="text-danger fw-bold">Rp {{ number_format($item->unpaidFees, 0, ',', '.') }}</span>
                        @else
                            <span class="text-success fw-semibold"><i class="fas fa-check-circle me-1"></i> Lunas</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">
                        <div class="py-5 text-center">
                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-coins fa-2x text-slate-300"></i>
                            </div>
                            <h6 class="fw-bold text-slate-600">Tidak ada data denda</h6>
                            <p class="text-slate-400 small">Data denda untuk periode ini tidak ditemukan.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
    .rounded-start-10 { border-top-left-radius: 10px !important; border-bottom-left-radius: 10px !important; }
    .rounded-end-10 { border-top-right-radius: 10px !important; border-bottom-right-radius: 10px !important; }
    .rounded-10 { border-radius: 10px !important; }
    .rounded-16 { border-radius: 16px !important; }
    .text-slate-800 { color: #1e293b; }
    .text-slate-700 { color: #334155; }
    .text-slate-600 { color: #475569; }
    .text-slate-500 { color: #64748b; }
    .text-slate-400 { color: #94a3b8; }
    .text-slate-300 { color: #cbd5e1; }
    .text-indigo { color: #4f46e5; }
    .bg-indigo { background-color: #4f46e5; }
    .rounded-lg { border-radius: 0.5rem; }
</style>
@endsection
