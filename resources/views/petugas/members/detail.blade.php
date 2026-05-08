@extends('layouts.petugas')

@section('title', 'Detail Anggota')

@section('content')
<h1 class="mt-4">Detail Anggota</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('petugas.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('petugas.members') }}">Daftar Anggota</a></li>
    <li class="breadcrumb-item active">Detail Anggota</li>
</ol>

<div class="row">
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <i class="fas fa-user me-1"></i>
                Informasi Anggota
            </div>
            <div class="card-body">
                @if($member->ktm_photo_url)
                <div class="text-center mb-3">
                    <a href="{{ $member->ktm_photo_url }}" onclick="event.preventDefault(); openKtmModal('{{ $member->ktm_photo_url }}');" role="button">
                        <img src="{{ $member->ktm_photo_url }}" alt="KTM {{ $member->name }}" style="max-width:100%; border-radius:8px; object-fit:cover;" loading="lazy">
                    </a>
                    {{--<div class="mt-2">
                        <a href="{{ $member->ktm_photo_url }}" onclick="event.preventDefault(); openKtmModal('{{ $member->ktm_photo_url }}');" role="button" class="btn btn-outline-primary btn-sm">Lihat KTM</a>
                    </div>--}}
                </div>
                @endif
                <table class="table table-sm">
                    <tr>
                        <th>Nama</th>
                        <td>{{ $member->name }}</td>
                    </tr>
                    <tr>
                        <th>NISN</th>
                        <td>{{ $member->nisn }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $member->email }}</td>
                    </tr>
                    <tr>
                        <th>Telepon</th>
                        <td>{{ $member->phone ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $member->address ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Tgl Bergabung</th>
                        <td>{{ $member->membership_date ? $member->membership_date->format('d F Y') : '-' }}</td>
                    </tr>
                    <tr>
                </table>
                <a href="{{ route('petugas.members') }}" class="btn btn-secondary w-100">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-history me-1"></i>
                Riwayat Peminjaman
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Buku</th>
                            <th>Tgl Pinjam</th>
                            <th>Jatuh Tempo</th>
                            <th>Tgl Kembali</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($borrowings as $borrowing)
                        <tr>
                            <td>{{ $borrowing->book->title }}</td>
                            <td>{{ $borrowing->borrow_date->format('d/m/Y') }}</td>
                            <td>{{ $borrowing->due_date->format('d/m/Y') }}</td>
                            <td>{{ $borrowing->return_date ? $borrowing->return_date->format('d/m/Y') : '-' }}</td>
                            <td>
                                @if($borrowing->is_lost)
                                    <span class="badge bg-dark">Hilang</span>
                                @elseif($borrowing->status == 'pending')
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
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada riwayat peminjaman</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <div class="mt-3">
                    {{ $borrowings->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

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
@endsection
