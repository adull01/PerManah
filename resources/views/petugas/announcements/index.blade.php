@extends('layouts.petugas')

@section('title', 'Kelola Pengumuman')
@section('page-title', 'Kelola Pengumuman')

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

    .page-breadcrumb {
        display: flex;
        gap: 8px;
        align-items: center;
        font-size: 0.9rem;
        opacity: 0.9;
    }

    .page-breadcrumb a {
        color: white;
        text-decoration: none;
    }

    .page-breadcrumb a:hover {
        text-decoration: underline;
    }

    /* Content Card */
    .content-card {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .content-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 25px;
        padding-bottom: 20px;
        border-bottom: 2px solid #e2e8f0;
    }

    .content-card-title {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 0;
    }

    .content-card-title i {
        color: #8b5cf6;
        font-size: 1.5rem;
    }

    .content-card-title h5 {
        margin: 0;
        font-size: 1.3rem;
        font-weight: 700;
        color: #1e293b;
    }

    .btn-create {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: white;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-create:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(139, 92, 246, 0.4);
        color: white;
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
        text-align: left;
    }

    .modern-table tbody td {
        padding: 15px 12px;
        border-bottom: 1px solid #f1f5f9;
        color: #1e293b;
        vertical-align: middle;
    }

    .modern-table tbody tr:hover {
        background: #f8fafc;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 8px;
        flex-wrap: nowrap;
        align-items: center;
    }

    .btn-action {
        padding: 8px 14px;
        font-size: 0.813rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
        text-decoration: none;
        cursor: pointer;
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
    }

    .btn-action i {
        font-size: 0.875rem;
    }

    .btn-edit {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
    }

    .btn-edit:hover {
        color: white;
        box-shadow: 0 6px 16px rgba(245, 158, 11, 0.4);
    }

    .btn-delete {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }

    .btn-delete:hover {
        box-shadow: 0 6px 16px rgba(239, 68, 68, 0.4);
    }

    /* Badge Styles */
    .badge-status {
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.75rem;
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
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #94a3b8;
        margin-bottom: 0;
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<div class="page-header-custom">
    <h2><i class="fas fa-bullhorn me-2"></i> Kelola Pengumuman</h2>
    <div class="page-breadcrumb">
        <a href="{{ route('petugas.dashboard') }}">Dashboard</a>
        <span>/</span>
        <span>Kelola Pengumuman</span>
    </div>
</div>

<!-- Content Card -->
<div class="content-card">
    <div class="content-card-header">
        <div class="content-card-title">
            <i class="fas fa-list"></i>
            <h5>Daftar Pengumuman</h5>
        </div>
        <a href="{{ route('petugas.announcements.create') }}" class="btn-create">
            <i class="fas fa-plus"></i>
            <span>Buat Pengumuman</span>
        </a>
    </div>

    <div class="table-responsive">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Konten</th>
                    <th>Dibuat Oleh</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($announcements as $announcement)
                <tr>
                    <td><strong>{{ $loop->iteration + ($announcements->currentPage() - 1) * $announcements->perPage() }}</strong></td>
                    <td><strong>{{ $announcement->title }}</strong></td>
                    <td>{{ Str::limit($announcement->content, 50) }}</td>
                    <td>{{ $announcement->creator->name }}</td>
                    <td>
                        @if($announcement->is_active)
                            <span class="badge bg-success badge-status">Aktif</span>
                        @else
                            <span class="badge bg-secondary badge-status">Nonaktif</span>
                        @endif
                    </td>
                    <td>{{ $announcement->created_at->format('d/m/Y') }}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('petugas.announcements.edit', $announcement) }}" class="btn-action btn-edit">
                                <i class="fas fa-edit"></i>
                                <span>Edit</span>
                            </a>
                            <form action="{{ route('petugas.announcements.destroy', $announcement) }}" method="POST" class="m-0" onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete">
                                    <i class="fas fa-trash"></i>
                                    <span>Hapus</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="p-0">
                        <div class="empty-state">
                            <i class="fas fa-bullhorn"></i>
                            <h6>Belum Ada Pengumuman</h6>
                            <p>Klik tombol "Buat Pengumuman" untuk menambahkan pengumuman baru</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($announcements->hasPages())
    <div class="mt-4">
        {{ $announcements->links() }}
    </div>
    @endif
</div>
@endsection
