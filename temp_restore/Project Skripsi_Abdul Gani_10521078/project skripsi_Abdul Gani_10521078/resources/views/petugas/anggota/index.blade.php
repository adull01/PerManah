@extends('layouts.petugas')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="h3 mb-0">
                    <i class="fas fa-users text-success"></i>
                    Daftar Anggota Terdaftar
                </h1>
                <p class="text-muted mt-2">Kelola data anggota yang sudah disetujui</p>
            </div>
            <div class="col-md-4 text-end">
                <span class="badge bg-success">{{ $members->total() }} Anggota</span>
                <a href="{{ route('petugas.anggota.pending') }}" class="btn btn-warning btn-sm ms-2">
                    <i class="fas fa-hourglass-half"></i>
                    Pending ({{ \App\Models\User::where('role', 'anggota')->where('status', 'pending')->count() }})
                </a>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama atau email..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('petugas.anggota.all') }}" class="btn btn-secondary w-100">
                        <i class="fas fa-redo"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Members Table -->
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%">#</th>
                        <th width="20%">Nama</th>
                        <th width="20%">Email</th>
                        <th width="15%">NISN</th>
                        <th width="15%">No. Telepon</th>
                        <th width="12%">Tanggal Terdaftar</th>
                        <th width="8%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($members->count() > 0)
                        @foreach ($members as $index => $member)
                            <tr>
                                <td class="fw-bold text-muted">{{ ($members->currentPage() - 1) * 15 + $index + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                            <i class="fas fa-user text-success"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $member->name }}</h6>
                                            <small class="text-muted">{{ $member->role }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $member->email }}</td>
                                <td>
                                    <code class="bg-light p-2 rounded">{{ $member->nisn ?? '-' }}</code>
                                </td>
                                <td>{{ $member->phone ?? '-' }}</td>
                                <td>
                                    <small class="text-muted">
                                        {{ $member->created_at->format('d M Y') }}
                                    </small>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#memberDetailsModal{{ $member->id }}" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Member Details Modal -->
                            <div class="modal fade" id="memberDetailsModal{{ $member->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success bg-opacity-10">
                                            <h5 class="modal-title">Detail Anggota</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold">Nama Lengkap</label>
                                                    <p>{{ $member->name }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold">Email</label>
                                                    <p>{{ $member->email }}</p>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold">No. NISN</label>
                                                    <p>{{ $member->nisn ?? '-' }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold">No. Telepon</label>
                                                    <p>{{ $member->phone ?? '-' }}</p>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Alamat</label>
                                                <p>{{ $member->address ?? '-' }}</p>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold">Status</label>
                                                    <p>
                                                        <span class="badge bg-success">
                                                            <i class="fas fa-check-circle"></i>
                                                            {{ ucfirst($member->status) }}
                                                        </span>
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold">Tanggal Terdaftar</label>
                                                    <p>{{ $member->created_at->format('d F Y') }}</p>
                                                </div>
                                            </div>
                                            @if ($member->ktm_photo)
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Foto KTM</label>
                                                    <div class="text-center">
                                                        <img src="{{ asset('storage/' . $member->ktm_photo) }}" alt="Foto KTM" class="img-fluid rounded" style="max-height: 300px;">
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Statistik Peminjaman</label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="bg-light p-3 rounded text-center">
                                                            <h5 class="text-info mb-0">{{ $member->borrowings()->count() }}</h5>
                                                            <small class="text-muted">Total Peminjaman</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="bg-light p-3 rounded text-center">
                                                            <h5 class="text-warning mb-0">{{ $member->activeBorrowings()->count() }}</h5>
                                                            <small class="text-muted">Sedang Dipinjam</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-inbox" style="font-size: 3rem;"></i>
                                    <p class="mt-3">Tidak ada anggota yang terdaftar</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if ($members->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $members->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

<style>
    .page-header {
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 1.5rem;
    }

    .avatar-sm {
        background-color: #f0f0f0;
    }

    .table-hover tbody tr:hover {
        background-color: #f9f9f9;
    }
</style>
@endsection
