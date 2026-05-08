@extends('layouts.petugas')

@section('title', 'Daftar Anggota')
@section('page-title', 'Daftar Anggota')

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
        text-decoration: none;
        white-space: nowrap;
        cursor: pointer;
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
    }

    .btn-action i {
        font-size: 0.875rem;
    }

    .btn-detail {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
    }

    .btn-detail:hover {
        color: white;
        box-shadow: 0 6px 16px rgba(59, 130, 246, 0.4);
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

    /* KTM thumbnail and modal */
    .ktm-thumb {
        height:48px;
        width:72px;
        border-radius:6px;
        object-fit:cover;
        display:inline-block;
        border:1px solid #e6edf3;
        transition:transform .18s ease, box-shadow .18s ease;
    }

    .ktm-thumb-link:hover .ktm-thumb {
        transform:translateY(-4px) scale(1.03);
        box-shadow:0 8px 20px rgba(16,185,129,0.12);
    }

    .ktm-modal {
        position:fixed;
        inset:0;
        display:flex;
        align-items:center;
        justify-content:center;
        background:rgba(0,0,0,0.6);
        opacity:0;
        visibility:hidden;
        transition:opacity .18s ease, visibility .18s ease;
        z-index:1100;
        padding:20px;
    }

    .ktm-modal.visible {
        opacity:1;
        visibility:visible;
    }

    .ktm-modal-content {
        max-width:900px;
        width:100%;
        background:#fff;
        border-radius:10px;
        overflow:hidden;
        box-shadow:0 12px 40px rgba(2,6,23,0.4);
    }

    .ktm-modal-body img {
        width:100%;
        height:auto;
        display:block;
    }

    .ktm-modal-footer {
        padding:10px 14px;
        text-align:right;
        background:#fafafa;
    }

    .ktm-modal-close {
        background:transparent;
        border:none;
        font-size:16px;
        cursor:pointer;
        color:#334155;
        padding:6px 10px;
        border-radius:6px;
    }
</style>
@endpush

@push('scripts')
<script>
    function openKtmModal(url) {
        var modal = document.getElementById('ktmLightboxModal');
        var img = document.getElementById('ktmLightboxImage');
        var link = document.getElementById('ktmLightboxLink');
        img.src = url;
        link.href = url;
        modal.classList.add('visible');
        document.body.style.overflow = 'hidden';
    }

    function closeKtmModal() {
        var modal = document.getElementById('ktmLightboxModal');
        var img = document.getElementById('ktmLightboxImage');
        modal.classList.remove('visible');
        img.src = '';
        document.body.style.overflow = '';
    }

    document.addEventListener('click', function(e) {
        if (e.target && (e.target.id === 'ktmLightboxModal' || e.target.classList.contains('ktm-modal-close'))) {
            closeKtmModal();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeKtmModal();
    });
</script>
@endpush

@section('content')
<!-- Page Header -->
<div class="page-header-custom">
    <h2><i class="fas fa-users me-2"></i> Daftar Anggota</h2>
    <div class="page-breadcrumb">
        <a href="{{ route('petugas.dashboard') }}">Dashboard</a>
        <span>/</span>
        <span>Daftar Anggota</span>
    </div>
</div>

<!-- Content Card -->
<div class="content-card">
    <div class="content-card-header">
        <div class="content-card-title">
            <i class="fas fa-list"></i>
            <h5>Daftar Anggota Perpustakaan</h5>
        </div>
    </div>

    <div class="table-responsive">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NISN</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>KTM</th>
                    <th>Tgl Bergabung</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($members as $member)
                <tr>
                    <td><strong>{{ $loop->iteration + ($members->currentPage() - 1) * $members->perPage() }}</strong></td>
                    <td><strong>{{ $member->name }}</strong></td>
                    <td>{{ $member->nisn ?? '-' }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->phone ?? '-' }}</td>
                    <td>{{ Str::limit($member->address, 30) ?? '-' }}</td>
                    <td>
                        @if($member->ktm_photo_url)
                            <a href="{{ $member->ktm_photo_url }}" onclick="event.preventDefault(); openKtmModal('{{ $member->ktm_photo_url }}');" role="button" class="ktm-thumb-link">
                                <img src="{{ $member->ktm_photo_url }}" alt="KTM {{ $member->name }}" class="ktm-thumb" loading="lazy">
                            </a>
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $member->membership_date ? $member->membership_date->format('d/m/Y') : '-' }}</td>
                    <td>
                        <a href="{{ route('petugas.members.detail', $member) }}" class="btn-action btn-detail">
                            <i class="fas fa-eye"></i>
                            <span>Detail</span>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="p-0">
                        <div class="empty-state">
                            <i class="fas fa-users"></i>
                            <h6>Belum Ada Anggota</h6>
                            <p>Data anggota perpustakaan akan muncul di sini</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
            <!-- KTM Lightbox Modal -->
            <div id="ktmLightboxModal" class="ktm-modal" aria-hidden="true">
                <div class="ktm-modal-content">
                    <div class="ktm-modal-body">
                        <img id="ktmLightboxImage" src="" alt="KTM Preview">
                    </div>
                    <div class="ktm-modal-footer">
                        <a id="ktmLightboxLink" href="#" target="_blank" class="btn btn-sm btn-primary me-2">Buka di tab baru</a>
                        <button type="button" class="ktm-modal-close" aria-label="Tutup">Tutup</button>
                    </div>
                </div>
            </div>

    @if($members->hasPages())
    <div class="mt-4">
        {{ $members->links() }}
    </div>
    @endif
</div>
@endsection
