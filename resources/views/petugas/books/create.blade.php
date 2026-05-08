@extends('layouts.petugas')

@section('title', 'Tambah Buku')

@section('content')
<h1 class="mt-4">Tambah Buku</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('petugas.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('petugas.books') }}">Kelola Buku</a></li>
    <li class="breadcrumb-item active">Tambah Buku</li>
</ol>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-plus me-1"></i>
        Form Tambah Buku
    </div>
    <div class="card-body">
        <!-- Form Import Excel Buku -->
        <div class="mb-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <i class="fas fa-file-excel me-1"></i> Import Buku dari Excel
                </div>
                <div class="card-body">
                    <form action="{{ route('petugas.books.import') }}" method="POST" enctype="multipart/form-data" class="row g-3 align-items-center">
                        @csrf
                        <div class="col-auto">
                            <input type="file" name="excel_file" class="form-control" accept=".xlsx,.xls" required>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-upload"></i> Import Excel
                            </button>
                        </div>
                        <div class="col-12 mt-2">
                            <small class="text-muted">Format kolom: judul_buku, penulis, isbn, penerbit, tahun, stok, kategori, deskripsi</small>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('petugas.books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Judul Buku <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Penulis <span class="text-danger">*</span></label>
                        <input type="text" name="author" class="form-control" value="{{ old('author') }}" required>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">ISBN <span class="text-danger">*</span></label>
                        <input type="text" name="isbn" class="form-control" value="{{ old('isbn') }}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Penerbit <span class="text-danger">*</span></label>
                        <input type="text" name="publisher" class="form-control" value="{{ old('publisher') }}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Tahun <span class="text-danger">*</span></label>
                        <input type="number" name="year" class="form-control" value="{{ old('year') }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Stok <span class="text-danger">*</span></label>
                        <input type="number" name="stock" class="form-control" value="{{ old('stock') }}" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Harga Buku <span class="text-danger">*</span></label>
                        <input type="number" name="price" class="form-control" value="{{ old('price') }}" required min="0" placeholder="Rp">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select name="category" class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Fiksi" {{ old('category') == 'Fiksi' ? 'selected' : '' }}>Fiksi</option>
                            <option value="Buku Pelajaran" {{ old('category') == 'Buku pelajaran' ? 'selected' : '' }}>Buku pelajaran</option>
                            <option value="Non-Fiksi" {{ old('category') == 'Non-Fiksi' ? 'selected' : '' }}>Non-Fiksi</option>
                            <option value="Sains" {{ old('category') == 'Sains' ? 'selected' : '' }}>Sains</option>
                            <option value="Teknologi" {{ old('category') == 'Teknologi' ? 'selected' : '' }}>Teknologi</option>
                            <option value="Sejarah" {{ old('category') == 'Sejarah' ? 'selected' : '' }}>Sejarah</option>
                            <option value="Biografi" {{ old('category') == 'Biografi' ? 'selected' : '' }}>Biografi</option>
                            <option value="Anak-anak" {{ old('category') == 'Anak-anak' ? 'selected' : '' }}>Anak-anak</option>
                            <option value="Pendidikan" {{ old('category') == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Cover Gambar</label>
                        <input type="file" name="cover_image" id="cover_image" class="form-control" accept="image/*" onchange="previewCover(this)">
                        <div id="coverPreview" style="width: 100px; height: 140px; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 12px rgba(139, 92, 246, 0.15); margin-top: 10px; display: none;">
                            <img id="coverImage" src="" alt="Preview" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('petugas.books') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewCover(input) {
    const preview = document.getElementById('coverPreview');
    const image = document.getElementById('coverImage');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            image.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
