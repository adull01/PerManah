@extends('layouts.petugas')

@section('title','Ledger Pembayaran')
@section('page-title','Ledger Pembayaran')

@section('content')
<style>
    .payments-summary .card { border-radius: .7rem; }
    .payments-summary .card .card-title { font-size: 1.6rem; font-weight:700 }
    .table-hover tbody tr:hover { background-color: #f8f9fb; }
    .small-muted { color: #6c757d; font-size: .85rem }
</style>

<div class="page-header-custom">
    <h2><i class="fas fa-wallet"></i> Ledger Pembayaran</h2>
    <p class="small-muted">Catat dan telusuri pembayaran denda / penggantian buku dengan cepat.</p>
</div>

<div class="content-card">
    <div class="content-card-header d-flex justify-content-between align-items-center">
        <div class="content-card-title d-flex align-items-center"><i class="fas fa-list me-2"></i><h5 class="mb-0">Daftar Pembayaran</h5></div>
        <form class="d-flex" method="GET" action="{{ route('petugas.payments') }}">
            <input type="month" name="month" class="form-control form-control-sm me-2" value="{{ request('month') }}">
            <input type="search" name="q" class="form-control form-control-sm me-2" placeholder="Cari user atau ID" value="{{ request('q') }}">
            <button class="btn btn-sm btn-outline-secondary me-2">Filter</button>
            <a href="{{ route('petugas.payments') }}" class="btn btn-sm btn-light">Reset</a>
        </form>
    </div>

    <div class="p-3">
        <div class="row payments-summary mb-3 g-3">
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="small-muted mb-1">Total Entri</h6>
                        <div class="d-flex align-items-end justify-content-between">
                            <div>
                                <div class="card-title">{{ $payments->total() }}</div>
                                <div class="small-muted">Jumlah baris (semua halaman)</div>
                            </div>
                            <div class="text-primary display-6"><i class="fas fa-clipboard-list"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="small-muted mb-1">Total (halaman ini)</h6>
                        <div class="d-flex align-items-end justify-content-between">
                            <div>
                                <div class="card-title">Rp {{ number_format($payments->sum('amount'),0,',','.') }}</div>
                                <div class="small-muted">Total pembayaran pada halaman ini</div>
                            </div>
                            <div class="text-success display-6"><i class="fas fa-wallet"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <h6 class="small-muted mb-2">Aksi Cepat</h6>
                        <div class="d-flex gap-2">
                            <a href="#create-payment" class="btn btn-primary btn-sm">Catat Pembayaran</a>
                            <a href="{{ route('petugas.payments') }}" class="btn btn-outline-secondary btn-sm">Lihat Semua</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('petugas.payments.store') }}" method="POST" class="row g-2 align-items-end mb-3" id="create-payment">
            @csrf
            <div class="col-md-3">
                <label class="form-label">ID Peminjaman (opsional)</label>
                <input type="number" name="borrowing_id" class="form-control form-control-sm">
            </div>
            <div class="col-md-3">
                <label class="form-label">Jumlah (Rp)</label>
                <input type="number" name="amount" class="form-control form-control-sm" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Metode</label>
                <input type="text" name="method" class="form-control form-control-sm">
            </div>
            <div class="col-md-3 d-flex">
                <button class="btn btn-primary w-100 btn-sm">Catat Pembayaran</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width:60px">No</th>
                        <th>User</th>
                        <th style="width:120px">Borrowing ID</th>
                        <th style="width:160px">Jumlah (Rp)</th>
                        <th style="width:140px">Metode</th>
                        <th style="width:160px">Tercatat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                    <tr>
                        <td>{{ $loop->iteration + ($payments->currentPage()-1)*$payments->perPage() }}</td>
                        <td>
                            <div class="fw-bold">{{ $payment->user->name }}</div>
                            <div class="small-muted">{{ $payment->user->email }}</div>
                        </td>
                        <td class="text-center">{{ $payment->borrowing_id ?? '-' }}</td>
                        <td class="text-end">Rp {{ number_format($payment->amount,0,',','.') }}</td>
                        <td>{{ $payment->method ?? '-' }}</td>
                        <td>{{ $payment->paid_at ? $payment->paid_at->format('d/m/Y H:i') : $payment->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">{{ $payments->links() }}</div>
    </div>
    
</div>
@endsection
