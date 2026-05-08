@extends('layouts.petugas')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="h3 mb-0">
                    <i class="fas fa-hourglass-half text-warning"></i>
                    Daftar Anggota Menunggu Persetujuan
                </h1>
                <p class="text-muted mt-2">Kelola permintaan pendaftaran anggota baru</p>
            </div>
            <div class="col-md-4 text-end">
                <span class="badge bg-warning">{{ $pendingUsers->total() }} Menunggu Persetujuan</span>
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
                    <a href="{{ route('petugas.anggota.pending') }}" class="btn btn-secondary w-100">
                        <i class="fas fa-redo"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Pending Users Table -->
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
                        <th width="15%">Tanggal Pendaftaran</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($pendingUsers->count() > 0)
                        @foreach ($pendingUsers as $index => $user)
                            <tr>
                                <td class="fw-bold text-muted">{{ ($pendingUsers->currentPage() - 1) * 15 + $index + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-light rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                            <i class="fas fa-user text-primary"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $user->name }}</h6>
                                            <small class="text-muted">{{ $user->role }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <code class="bg-light p-2 rounded">{{ $user->nisn ?? '-' }}</code>
                                </td>
                                <td>{{ $user->phone ?? '-' }}</td>
                                <td>
                                    <small class="text-muted">
                                        {{ $user->created_at->format('d M Y H:i') }}
                                    </small>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <!-- View Details Button -->
                                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#userDetailsModal{{ $user->id }}" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <!-- Approve Button dengan Sweet Alert -->
                                        <form action="{{ route('petugas.anggota.approve', $user->id) }}" method="POST" class="d-inline approveForm">
                                            @csrf
                                            <button type="button" class="btn btn-sm btn-success approveBtn" data-user-id="{{ $user->id }}" data-user-email="{{ $user->email }}" title="Setujui">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <!-- Reject Button dengan Sweet Alert -->
                                        <button type="button" class="btn btn-sm btn-danger rejectBtn" data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}" data-user-email="{{ $user->email }}" data-route="{{ route('petugas.anggota.reject', $user->id) }}" title="Tolak">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- User Details Modal -->
                            <div class="modal fade" id="userDetailsModal{{ $user->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detail Anggota</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold">Nama Lengkap</label>
                                                    <p>{{ $user->name }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold">Email</label>
                                                    <p>{{ $user->email }}</p>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold">No. NISN</label>
                                                    <p>{{ $user->nisn ?? '-' }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold">No. Telepon</label>
                                                    <p>{{ $user->phone ?? '-' }}</p>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Alamat</label>
                                                <p>{{ $user->address ?? '-' }}</p>
                                            </div>
                                            @if ($user->ktm_photo)
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Foto KTM</label>
                                                    <div class="text-center">
                                                        <img src="{{ asset('storage/' . $user->ktm_photo) }}" alt="Foto KTM" class="img-fluid rounded" style="max-height: 300px;">
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Tanggal Pendaftaran</label>
                                                <p>{{ $user->created_at->format('d F Y H:i:s') }}</p>
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
                                    <p class="mt-3">Tidak ada anggota yang menunggu persetujuan</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if ($pendingUsers->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $pendingUsers->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

<style>
    .page-header {
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 1.5rem;
    }

    .btn-group .btn {
        padding: 0.35rem 0.5rem;
        font-size: 0.85rem;
    }

    .avatar-sm {
        background-color: #f0f0f0;
    }

    .table-hover tbody tr:hover {
        background-color: #f9f9f9;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle Approve Button with Sweet Alert
    document.querySelectorAll('.approveBtn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const userId = this.getAttribute('data-user-id');
            const userEmail = this.getAttribute('data-user-email');
            const form = this.closest('.approveForm');

            Swal.fire({
                icon: 'question',
                title: 'Konfirmasi Persetujuan',
                html: `<p>Apakah Anda yakin ingin <strong>menyetujui akun</strong> ini?</p>
                       <p class="text-muted" style="font-size: 0.9rem;">Email: <strong>${userEmail}</strong></p>
                       <p class="text-muted" style="font-size: 0.9rem;">Email notifikasi akan dikirim otomatis ke pengguna.</p>`,
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Setujui',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // Handle Reject Button Click with Sweet Alert Input
    document.querySelectorAll('.rejectBtn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const userId = this.getAttribute('data-user-id');
            const userName = this.getAttribute('data-user-name');
            const userEmail = this.getAttribute('data-user-email');
            const rejectRoute = this.getAttribute('data-route');

            Swal.fire({
                icon: 'question',
                title: 'Tolak Pendaftaran',
                html: `<p>Apakah Anda yakin ingin <strong>menolak akun</strong> ini?</p>
                       <p class="text-muted" style="font-size: 0.9rem;">Nama: <strong>${userName}</strong></p>
                       <p class="text-muted" style="font-size: 0.9rem;">Email: <strong>${userEmail}</strong></p>`,
                input: 'textarea',
                inputLabel: 'Alasan Penolakan',
                inputPlaceholder: 'Jelaskan alasan penolakan pendaftaran ini...',
                inputAttributes: {
                    maxlength: 500
                },
                inputValidator: (value) => {
                    if (!value || value.trim() === '') {
                        return 'Alasan penolakan tidak boleh kosong!';
                    }
                    if (value.trim().length < 10) {
                        return 'Alasan minimal harus 10 karakter!';
                    }
                    if (value.length > 500) {
                        return 'Alasan maksimal 500 karakter!';
                    }
                },
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Tolak & Hapus Akun',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed && result.value) {
                    console.log('Submitting rejection with reason:', result.value);
                    
                    // Create FormData with CSRF token and rejection reason
                    const formData = new FormData();
                    formData.append('rejection_reason', result.value);
                    formData.append('_token', document.querySelector('meta[name="csrf-token"]')?.content || '');
                    
                    // Submit using Fetch API
                    fetch(rejectRoute, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        console.log('Response status:', response.status);
                        if (response.ok || response.status === 302) {
                            // Success - reload page to show updated list
                            Swal.fire({
                                icon: 'success',
                                title: 'Akun Ditolak',
                                text: 'Email notifikasi penolakan telah dikirim dan akun telah dihapus.',
                                confirmButtonColor: '#10b981'
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            console.error('Response:', response);
                            return response.json();
                        }
                    })
                    .then(data => {
                        if (data?.message || data?.error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: data.message || data.error || 'Terjadi kesalahan'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan: ' + error.message
                        });
                    });
                }
            });
        });
    });
});
</script>
@endsection
