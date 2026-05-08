@extends('layouts.petugas')

@section('title', 'Edit Buku')

@section('content')
<h1 class="mt-4">Edit Buku</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('petugas.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('petugas.books') }}">Kelola Buku</a></li>
    <li class="breadcrumb-item active">Edit Buku</li>
</ol>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-edit me-1"></i>
        Form Edit Buku
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('petugas.books.update', $book) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Judul Buku <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $book->title) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Penulis <span class="text-danger">*</span></label>
                        <input type="text" name="author" class="form-control" value="{{ old('author', $book->author) }}" required>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">ISBN <span class="text-danger">*</span></label>
                        <input type="text" name="isbn" class="form-control" value="{{ old('isbn', $book->isbn) }}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Penerbit <span class="text-danger">*</span></label>
                        <input type="text" name="publisher" class="form-control" value="{{ old('publisher', $book->publisher) }}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Tahun <span class="text-danger">*</span></label>
                        <input type="number" name="year" class="form-control" value="{{ old('year', $book->year) }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Stok <span class="text-danger">*</span></label>
                        <input type="number" name="stock" class="form-control" value="{{ old('stock', $book->stock) }}" required>
                        <small class="text-muted">Saat ini tersedia: {{ $book->available }}</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select name="category" class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Fiksi" {{ old('category', $book->category) == 'Fiksi' ? 'selected' : '' }}>Fiksi</option>
                            <option value="Non-Fiksi" {{ old('category', $book->category) == 'Non-Fiksi' ? 'selected' : '' }}>Non-Fiksi</option>
                            <option value="Sains" {{ old('category', $book->category) == 'Sains' ? 'selected' : '' }}>Sains</option>
                            <option value="Teknologi" {{ old('category', $book->category) == 'Teknologi' ? 'selected' : '' }}>Teknologi</option>
                            <option value="Sejarah" {{ old('category', $book->category) == 'Sejarah' ? 'selected' : '' }}>Sejarah</option>
                            <option value="Biografi" {{ old('category', $book->category) == 'Biografi' ? 'selected' : '' }}>Biografi</option>
                            <option value="Anak-anak" {{ old('category', $book->category) == 'Anak-anak' ? 'selected' : '' }}>Anak-anak</option>
                            <option value="Pendidikan" {{ old('category', $book->category) == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Cover Gambar</label>
                        <input type="file" name="cover_image" id="cover_image" class="form-control" accept="image/*" onchange="previewCover(this)">
                        @if($book->cover_image)
                            <small class="text-muted d-block mt-2 mb-2">Cover saat ini:</small>
                        @endif
                        <div id="coverPreview" style="width: 100px; height: 140px; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 12px rgba(139, 92, 246, 0.15); margin-top: 10px; {{ $book->cover_image ? '' : 'display: none;' }}">
                            @if($book->cover_image)
                                <img id="coverImage" src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                            @else
                                <img id="coverImage" src="" alt="Preview" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description', $book->description) }}</textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('petugas.books') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Perubahan
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
