<?php $__env->startSection('title', 'Edit Buku'); ?>

<?php $__env->startSection('content'); ?>
<h1 class="mt-4">Edit Buku</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="<?php echo e(route('petugas.dashboard')); ?>">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('petugas.books')); ?>">Kelola Buku</a></li>
    <li class="breadcrumb-item active">Edit Buku</li>
</ol>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-edit me-1"></i>
        Form Edit Buku
    </div>
    <div class="card-body">
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('petugas.books.update', $book)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Judul Buku <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="<?php echo e(old('title', $book->title)); ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Penulis <span class="text-danger">*</span></label>
                        <input type="text" name="author" class="form-control" value="<?php echo e(old('author', $book->author)); ?>" required>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">ISBN <span class="text-danger">*</span></label>
                        <input type="text" name="isbn" class="form-control" value="<?php echo e(old('isbn', $book->isbn)); ?>" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Penerbit <span class="text-danger">*</span></label>
                        <input type="text" name="publisher" class="form-control" value="<?php echo e(old('publisher', $book->publisher)); ?>" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Tahun <span class="text-danger">*</span></label>
                        <input type="number" name="year" class="form-control" value="<?php echo e(old('year', $book->year)); ?>" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Stok <span class="text-danger">*</span></label>
                        <input type="number" name="stock" class="form-control" value="<?php echo e(old('stock', $book->stock)); ?>" required>
                        <small class="text-muted">Saat ini tersedia: <?php echo e($book->available); ?></small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Harga Buku <span class="text-danger">*</span></label>
                        <input type="number" name="price" class="form-control" value="<?php echo e(old('price', $book->price)); ?>" required min="0" placeholder="Rp">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select name="category" class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Fiksi" <?php echo e(old('category', $book->category) == 'Fiksi' ? 'selected' : ''); ?>>Fiksi</option>
                            <option value="Non-Fiksi" <?php echo e(old('category', $book->category) == 'Non-Fiksi' ? 'selected' : ''); ?>>Non-Fiksi</option>
                            <option value="Sains" <?php echo e(old('category', $book->category) == 'Sains' ? 'selected' : ''); ?>>Sains</option>
                            <option value="Teknologi" <?php echo e(old('category', $book->category) == 'Teknologi' ? 'selected' : ''); ?>>Teknologi</option>
                            <option value="Sejarah" <?php echo e(old('category', $book->category) == 'Sejarah' ? 'selected' : ''); ?>>Sejarah</option>
                            <option value="Biografi" <?php echo e(old('category', $book->category) == 'Biografi' ? 'selected' : ''); ?>>Biografi</option>
                            <option value="Anak-anak" <?php echo e(old('category', $book->category) == 'Anak-anak' ? 'selected' : ''); ?>>Anak-anak</option>
                            <option value="Pendidikan" <?php echo e(old('category', $book->category) == 'Pendidikan' ? 'selected' : ''); ?>>Pendidikan</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Cover Gambar</label>
                        <input type="file" name="cover_image" id="cover_image" class="form-control" accept="image/*" onchange="previewCover(this)">
                        <?php if($book->cover_image): ?>
                            <small class="text-muted d-block mt-2 mb-2">Cover saat ini:</small>
                        <?php endif; ?>
                        <div id="coverPreview" style="width: 100px; height: 140px; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 12px rgba(139, 92, 246, 0.15); margin-top: 10px; <?php echo e($book->cover_image ? '' : 'display: none;'); ?>">
                            <?php if($book->cover_image): ?>
                                <img id="coverImage" src="<?php echo e(asset('storage/' . $book->cover_image)); ?>" alt="<?php echo e($book->title); ?>" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                            <?php else: ?>
                                <img id="coverImage" src="" alt="Preview" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="4"><?php echo e(old('description', $book->description)); ?></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?php echo e(route('petugas.books')); ?>" class="btn btn-secondary">
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.petugas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\SKRIPSI\Project\resources\views/petugas/books/edit.blade.php ENDPATH**/ ?>