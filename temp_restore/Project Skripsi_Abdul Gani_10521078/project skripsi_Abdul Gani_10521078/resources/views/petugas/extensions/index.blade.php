@extends('layouts.petugas')

@section('title', 'Permintaan Perpanjangan')
@section('page-title', 'Permintaan Perpanjangan')

@push('styles')
<style>
    /* Page Header */
    .page-header-custom {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        border-radius: 16px;
        padding: 30px;
        color: white;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
    }

    .page-header-custom h2 {
        font-size: 1.8rem;
        font-weight: 800;
        margin-bottom: 10px;
    }

    /* Statistics Cards */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 25px;
    }

    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }

    .stat-card-label {
        color: #64748b;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .stat-card-value {
        font-size: 2rem;
        font-weight: 800;
        color: #1e293b;
    }

    .stat-card.pending {
        border-left: 4px solid #f59e0b;
    }

    .stat-card.approved {
        border-left: 4px solid #10b981;
    }

    .stat-card.rejected {
        border-left: 4px solid #ef4444;
    }

    /* Filter Section */
    .filter-section {
        background: white;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    /* Content Card */
    .content-card {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    /* Modern Table */
    .modern-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: 0.9rem;
    }

    .modern-table thead th {
        background: #f8fafc;
        color: #475569;
        font-weight: 700;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 15px 12px;
        border-bottom: 2px solid #e2e8f0;
        white-space: nowrap;
    }

    .modern-table tbody td {
        padding: 15px 12px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .modern-table tbody tr:hover {
        background: #f8fafc;
    }

    /* Status Badges */
    .badge-pending {
        background: #fef3c7;
        color: #92400e;
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.75rem;
    }

    .badge-approved {
        background: #d1fae5;
        color: #065f46;
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.75rem;
    }

    .badge-rejected {
        background: #fee2e2;
        color: #991b1b;
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.75rem;
    }

    /* Action Buttons */
    .btn-action {
        padding: 6px 12px;
        border-radius: 6px;
        border: none;
        font-weight: 600;
        font-size: 0.8rem;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-approve {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }

    .btn-approve:hover {
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
        transform: translateY(-2px);
    }

    .btn-reject {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }

    .btn-reject:hover {
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
        transform: translateY(-2px);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state i {
        font-size: 4rem;
        color: #cbd5e1;
        margin-bottom: 20px;
    }

    .empty-state h6 {
        color: #64748b;
        font-size: 1.1rem;
        font-weight: 600;
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<div class="page-header-custom">
    <h2><i class="fas fa-calendar-plus me-2"></i>Permintaan Perpanjangan</h2>
    <p class="mb-0">Kelola permintaan perpanjangan waktu peminjaman dari anggota</p>
</div>

<!-- Statistics -->
<div class="stats-row">
    <div class="stat-card pending">
        <div class="stat-card-label">
            <i class="fas fa-clock me-1"></i> Menunggu
        </div>
        <div class="stat-card-value">{{ $pendingCount }}</div>
    </div>
    <div class="stat-card approved">
        <div class="stat-card-label">
            <i class="fas fa-check-circle me-1"></i> Disetujui
        </div>
        <div class="stat-card-value">{{ $approvedCount }}</div>
    </div>
    <div class="stat-card rejected">
        <div class="stat-card-label">
            <i class="fas fa-times-circle me-1"></i> Ditolak
        </div>
        <div class="stat-card-value">{{ $rejectedCount }}</div>
    </div>
</div>

<!-- Filter Section -->
<div class="filter-section">
    <form method="GET" action="{{ route('petugas.extensions') }}" class="row g-3">
        <div class="col-md-4">
            <label class="form-label fw-bold">Filter Status</label>
            <select name="status" class="form-select">
                <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-filter"></i> Filter
            </button>
        </div>
    </form>
</div>

<!-- Content Card -->
<div class="content-card">
    @if($extensions->count() > 0)
        <div class="table-responsive">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th>Jatuh Tempo</th>
                        <th>Durasi</th>
                        <th>Alasan</th>
                        <th>Status</th>
                        <th>Tanggal Ajukan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($extensions as $extension)
                    <tr>
                        <td>{{ $loop->iteration + ($extensions->currentPage() - 1) * $extensions->perPage() }}</td>
                        <td>
                            <div class="fw-bold text-dark">{{ $extension->user->name }}</div>
                            <div class="text-muted small">{{ $extension->user->email }}</div>
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $extension->borrowing->book->title }}</div>
                            <div class="text-muted small">{{ $extension->borrowing->book->author }}</div>
                        </td>
                        <td>
                            <span class="fw-bold">{{ $extension->borrowing->due_date->format('d/m/Y') }}</span>
                        </td>
                        <td>
                            <span class="badge bg-info text-dark">
                                <i class="fas fa-calendar-alt"></i> {{ $extension->requested_days }} Hari
                            </span>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="tooltip" title="{{ $extension->reason }}">
                                <i class="fas fa-info-circle"></i>
                            </button>
                        </td>
                        <td>
                            @if($extension->status == 'pending')
                                <span class="badge-pending">
                                    <i class="fas fa-clock"></i> Menunggu
                                </span>
                            @elseif($extension->status == 'approved')
                                <span class="badge-approved">
                                    <i class="fas fa-check-circle"></i> Disetujui
                                </span>
                            @else
                                <span class="badge-rejected">
                                    <i class="fas fa-times-circle"></i> Ditolak
                                </span>
                            @endif
                        </td>
                        <td>{{ $extension->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            @if($extension->status == 'pending')
                                <div class="d-flex gap-1">
                                    <form action="{{ route('petugas.extensions.approve', $extension->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn-action btn-approve" onclick="return confirm('Setujui perpanjangan ini?')">
                                            <i class="fas fa-check"></i> Setujui
                                        </button>
                                    </form>
                                    <button type="button" class="btn-action btn-reject" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $extension->id }}">
                                        <i class="fas fa-times"></i> Tolak
                                    </button>
                                </div>
                            @else
                                <span class="text-muted small">
                                    @if($extension->processedBy)
                                        Oleh: {{ $extension->processedBy->name }}
                                    @endif
                                </span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $extensions->links() }}
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-calendar-times"></i>
            <h6>Tidak Ada Permintaan Perpanjangan</h6>
            <p class="text-muted">Belum ada permintaan perpanjangan dari anggota</p>
        </div>
    @endif
</div>

<!-- Reject Modals -->
@foreach($extensions as $extension)
    @if($extension->status == 'pending')
        <div class="modal fade" id="rejectModal{{ $extension->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">
                            <i class="fas fa-times-circle me-2"></i>
                            Tolak Permintaan Perpanjangan
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('petugas.extensions.reject', $extension->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Informasi Permintaan</label>
                                <div class="p-3 bg-light rounded">
                                    <div><strong>Anggota:</strong> {{ $extension->user->name }}</div>
                                    <div><strong>Buku:</strong> {{ $extension->borrowing->book->title }}</div>
                                    <div><strong>Durasi:</strong> {{ $extension->requested_days }} Hari</div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="rejection_reason{{ $extension->id }}" class="form-label fw-bold">
                                    Alasan Penolakan <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control" id="rejection_reason{{ $extension->id }}" name="rejection_reason" rows="3" required placeholder="Jelaskan alasan penolakan..."></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times"></i> Batal
                            </button>
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-ban"></i> Tolak Permintaan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endforeach
@endsection

@push('scripts')
<script>
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
</script>
@endpush
