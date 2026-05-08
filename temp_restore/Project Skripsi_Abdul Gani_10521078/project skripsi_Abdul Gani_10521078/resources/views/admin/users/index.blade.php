@extends('layouts.admin')

@section('title', 'Kelola User')
@section('page-title', 'Kelola User')

@push('styles')
<style>
    .page-header-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .btn-add {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(139, 92, 246, 0.3);
        color: white;
    }

    .data-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .data-card-header {
        padding: 20px 25px;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .data-card-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .data-card-title i {
        color: #8b5cf6;
    }

    .search-box {
        position: relative;
        width: 300px;
    }

    .search-box input {
        width: 100%;
        padding: 10px 15px 10px 40px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .search-box input:focus {
        outline: none;
        border-color: #8b5cf6;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
    }

    .search-box i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
    }

    .table-modern {
        width: 100%;
        margin: 0;
    }

    .table-modern thead {
        background: #f8fafc;
    }

    .table-modern thead th {
        padding: 15px 20px;
        font-size: 0.85rem;
        font-weight: 700;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e2e8f0;
    }

    .table-modern tbody tr {
        transition: all 0.2s ease;
    }

    .table-modern tbody tr:hover {
        background: #f8fafc;
    }

    .table-modern tbody td {
        padding: 18px 20px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.9rem;
        color: #334155;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 1rem;
    }

    .user-info {
        display: inline-block;
        vertical-align: middle;
        margin-left: 12px;
    }

    .user-info strong {
        display: block;
        color: #1e293b;
        font-weight: 600;
    }

    .user-info small {
        color: #64748b;
        font-size: 0.85rem;
    }

    .badge-modern {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
    }

    .badge-id {
        background: #dbeafe;
        color: #1e40af;
    }

    .badge-petugas {
        background: #dbeafe;
        color: #1e40af;
    }

    .badge-anggota {
        background: #ede9fe;
        color: #5b21b6;
    }

    .btn-action {
        padding: 8px 12px;
        border-radius: 8px;
        border: none;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        text-decoration: none;
        margin: 2px;
    }

    .btn-action.btn-edit {
        background: #fef3c7;
        color: #92400e;
    }

    .btn-action.btn-edit:hover {
        background: #fde047;
        transform: translateY(-2px);
    }

    .btn-action.btn-delete {
        background: #fee2e2;
        color: #991b1b;
    }

    .btn-action.btn-delete:hover {
        background: #fca5a5;
        transform: translateY(-2px);
    }

    .pagination-wrapper {
        padding: 20px 25px;
        border-top: 1px solid #e2e8f0;
        display: flex;
        justify-content: center;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #64748b;
    }

    .empty-state i {
        font-size: 4rem;
        color: #cbd5e1;
        margin-bottom: 20px;
    }

    .empty-state h5 {
        font-size: 1.2rem;
        font-weight: 700;
        color: #475569;
        margin-bottom: 10px;
    }

    .empty-state p {
        font-size: 0.95rem;
    }
</style>
@endpush

@section('content')
<div class="page-header-actions">
    <div class="breadcrumb-custom">
        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
        <span>/</span>
        <span>Kelola User</span>
    </div>
    <a href="{{ route('admin.users.create') }}" class="btn-add">
        <i class="fas fa-user-plus"></i>
        Tambah User Baru
    </a>
</div>

<div class="data-card">
    <div class="data-card-header">
        <div class="data-card-title">
            <i class="fas fa-users"></i>
            Daftar User (Petugas & Anggota)
        </div>
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Cari user...">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table-modern">
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th style="width: 80px;">ID</th>
                    <th>Nama & Email</th>
                    <th style="width: 120px;">Role</th>
                    <th style="width: 150px;">Telepon</th>
                    <th style="width: 150px;">Bergabung</th>
                    <th style="width: 160px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                    <td>
                        <span class="badge-modern badge-id">{{ $user->id }}</span>
                    </td>
                    <td>
                        <div class="user-avatar">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="user-info">
                            <strong>{{ $user->name }}</strong>
                            <small>{{ $user->email }}</small>
                        </div>
                    </td>
                    <td>
                        @if($user->role == 'petugas')
                            <span class="badge-modern badge-petugas">
                                <i class="fas fa-user-tie"></i> Petugas
                            </span>
                        @else
                            <span class="badge-modern badge-anggota">
                                <i class="fas fa-user"></i> Anggota
                            </span>
                        @endif
                    </td>
                    <td>
                        @if($user->phone)
                            <i class="fas fa-phone-alt" style="color: #8b5cf6;"></i> {{ $user->phone }}
                        @else
                            <span style="color: #94a3b8;">-</span>
                        @endif
                    </td>
                    <td>
                        <i class="fas fa-calendar-alt" style="color: #64748b;"></i>
                        {{ $user->created_at->format('d M Y') }}
                    </td>
                    <td style="text-align: center;">
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn-action btn-edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <i class="fas fa-users"></i>
                            <h5>Belum Ada Data User</h5>
                            <p>Silakan tambahkan user baru untuk memulai</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
    <div class="pagination-wrapper">
        {{ $users->links() }}
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    // Simple search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toUpperCase();
        let table = document.querySelector('.table-modern tbody');
        let tr = table.getElementsByTagName('tr');

        for (let i = 0; i < tr.length; i++) {
            let td = tr[i].getElementsByTagName('td');
            let found = false;
            
            for (let j = 0; j < td.length; j++) {
                if (td[j]) {
                    let txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
            }
            
            tr[i].style.display = found ? '' : 'none';
        }
    });
</script>
@endpush

