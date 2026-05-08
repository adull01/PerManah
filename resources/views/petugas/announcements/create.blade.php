@extends('layouts.petugas')

@section('title', 'Buat Pengumuman')
@section('page-title', 'Buat Pengumuman')

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

    /* Form Card */
    .form-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .form-card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 25px;
        padding-bottom: 20px;
        border-bottom: 2px solid #e2e8f0;
    }

    .form-card-header i {
        color: #8b5cf6;
        font-size: 1.5rem;
    }

    .form-card-header h5 {
        margin: 0;
        font-size: 1.3rem;
        font-weight: 700;
        color: #1e293b;
    }

    /* Form Styling */
    .form-label {
        font-weight: 600;
        color: #475569;
        margin-bottom: 8px;
    }

    .form-control {
        border-radius: 10px;
        border: 2px solid #e2e8f0;
        padding: 10px 15px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #8b5cf6;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
    }

    /* Button Styling */
    .form-actions {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 2px solid #e2e8f0;
    }

    .btn-form {
        padding: 10px 24px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.938rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        border: none;
        text-decoration: none;
    }

    .btn-form:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
    }

    .btn-back {
        background: #f1f5f9;
        color: #475569;
    }

    .btn-back:hover {
        background: #e2e8f0;
        color: #1e293b;
    }

    .btn-submit {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: white;
    }

    .btn-submit:hover {
        box-shadow: 0 6px 16px rgba(139, 92, 246, 0.4);
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<div class="page-header-custom">
    <h2><i class="fas fa-plus me-2"></i> Buat Pengumuman</h2>
    <div class="page-breadcrumb">
        <a href="{{ route('petugas.dashboard') }}">Dashboard</a>
        <span>/</span>
        <a href="{{ route('petugas.announcements') }}">Kelola Pengumuman</a>
        <span>/</span>
        <span>Buat Pengumuman</span>
    </div>
</div>

<div class="form-card">
    <div class="form-card-header">
        <i class="fas fa-file-alt"></i>
        <h5>Form Buat Pengumuman Baru</h5>
    </div>

    <div class="form-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('petugas.announcements.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Judul Pengumuman <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Konten <span class="text-danger">*</span></label>
                <textarea name="content" class="form-control" rows="6" required>{{ old('content') }}</textarea>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_active" class="form-check-input" id="isActive" {{ old('is_active', true) ? 'checked' : '' }}>
                <label class="form-check-label" for="isActive">
                    Aktifkan pengumuman ini
                </label>
            </div>

            <div class="form-actions">
                <a href="{{ route('petugas.announcements') }}" class="btn-form btn-back">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali</span>
                </a>
                <button type="submit" class="btn-form btn-submit">
                    <i class="fas fa-save"></i>
                    <span>Simpan Pengumuman</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
