<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Welcome Card */
    .welcome-card {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        border-radius: 16px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(139, 92, 246, 0.2);
        color: white;
    }

    .welcome-card h2 {
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .welcome-card p {
        font-size: 1.1rem;
        opacity: 0.95;
        margin-bottom: 25px;
    }

    .welcome-features {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-top: 20px;
    }

    .welcome-feature-item {
        background: rgba(255, 255, 255, 0.1);
        padding: 15px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 12px;
        backdrop-filter: blur(10px);
    }

    .welcome-feature-item i {
        font-size: 1.5rem;
    }

    .welcome-feature-item span {
        font-size: 0.9rem;
        font-weight: 600;
    }

    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 15px;
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: white;
    }

    .stat-icon.green {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        box-shadow: 0 8px 20px rgba(139, 92, 246, 0.3);
    }

    .stat-icon.blue {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
    }

    .stat-icon.orange {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        box-shadow: 0 8px 20px rgba(245, 158, 11, 0.3);
    }

    .stat-content h3 {
        font-size: 2.2rem;
        font-weight: 800;
        color: #1e293b;
        margin: 0;
    }

    .stat-content p {
        color: #64748b;
        margin: 5px 0 0 0;
        font-size: 0.95rem;
        font-weight: 600;
    }

    .stat-footer {
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #e2e8f0;
        font-size: 0.85rem;
        color: #64748b;
    }

    /* Notification & Activity Cards */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .info-card {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
    }

    .info-card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e2e8f0;
    }

    .info-card-header i {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: white;
    }

    .info-card-header i.green {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    }

    .info-card-header i.blue {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    }

    .info-card-header h5 {
        margin: 0;
        font-weight: 700;
        color: #1e293b;
    }

    .announcement-item {
        padding: 15px;
        background: #f8fafc;
        border-radius: 12px;
        margin-bottom: 12px;
        border-left: 4px solid #8b5cf6;
    }

    .announcement-item:last-child {
        margin-bottom: 0;
    }

    .announcement-item h6 {
        color: #1e293b;
        font-weight: 700;
        margin-bottom: 8px;
        font-size: 0.95rem;
    }

    .announcement-item p {
        color: #64748b;
        margin: 0 0 8px 0;
        font-size: 0.85rem;
        line-height: 1.5;
    }

    .announcement-item small {
        color: #94a3b8;
        font-size: 0.75rem;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #94a3b8;
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 15px;
        opacity: 0.3;
    }

    .empty-state p {
        margin: 0;
        font-size: 0.9rem;
    }

    /* Action Button */
    .btn-action-dashboard {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: white;
        padding: 15px 30px;
        border-radius: 12px;
        border: none;
        font-weight: 700;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(139, 92, 246, 0.3);
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .btn-action-dashboard:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(139, 92, 246, 0.4);
        color: white;
    }

    .membership-badge {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Welcome Card -->
<div class="welcome-card">
    <h2><i class="fas fa-book-reader me-2"></i>Selamat Datang, <?php echo e(auth()->user()->name); ?>!</h2>
    <p>Jelajahi koleksi buku digital kami dan nikmati pengalaman membaca yang lebih baik</p>
    <div class="welcome-features">
        <div class="welcome-feature-item">
            <i class="fas fa-book"></i>
            <span>Ribuan Koleksi Buku</span>
        </div>
        <div class="welcome-feature-item">
            <i class="fas fa-clock"></i>
            <span>Peminjaman Mudah & Cepat</span>
        </div>
        <div class="welcome-feature-item">
            <i class="fas fa-history"></i>
            <span>Riwayat Lengkap</span>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-content">
                <h3><?php echo e($activeBorrowings); ?></h3>
                <p>Sedang Dipinjam</p>
            </div>
            <div class="stat-icon green">
                <i class="fas fa-book-open"></i>
            </div>
        </div>
        <div class="stat-footer">
            <i class="fas fa-info-circle me-1"></i> Buku yang sedang Anda pinjam saat ini
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-content">
                <h3><?php echo e($pendingRequests); ?></h3>
                <p>Permintaan Pending</p>
            </div>
            <div class="stat-icon blue">
                <i class="fas fa-clock"></i>
            </div>
        </div>
        <div class="stat-footer">
            <i class="fas fa-info-circle me-1"></i> Menunggu persetujuan petugas
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-content">
                <p style="margin-bottom: 8px;">Anggota Sejak</p>
                <div class="membership-badge">
                    <i class="fas fa-calendar-check me-1"></i>
                    <?php echo e(auth()->user()->created_at ? auth()->user()->created_at->format('d M Y') : '-'); ?>

                </div>
            </div>
            <div class="stat-icon orange">
                <i class="fas fa-user-check"></i>
            </div>
        </div>
        <div class="stat-footer">
            <i class="fas fa-info-circle me-1"></i> Terima kasih telah menjadi anggota setia
        </div>
    </div>
</div>

<!-- Notifications & Activity -->
<div class="info-grid">
    <!-- Announcements Card -->
    <div class="info-card">
        <div class="info-card-header">
            <i class="fas fa-bullhorn green"></i>
            <h5>Pengumuman Terbaru</h5>
        </div>
        <div class="info-card-body">
            <?php if($announcements->count() > 0): ?>
                <?php $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="announcement-item">
                    <h6><?php echo e($announcement->title); ?></h6>
                    <p><?php echo e(Str::limit($announcement->content, 100)); ?></p>
                    <small>
                        <i class="fas fa-calendar me-1"></i>
                        <?php echo e($announcement->created_at->format('d F Y')); ?>

                    </small>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <p>Tidak ada pengumuman terbaru</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Quick Actions Card -->
    <div class="info-card">
        <div class="info-card-header">
            <i class="fas fa-bolt blue"></i>
            <h5>Aksi Cepat</h5>
        </div>
        <div class="info-card-body">
            <div style="display: flex; flex-direction: column; gap: 12px;">
                <a href="<?php echo e(route('anggota.catalog')); ?>" class="btn btn-action-dashboard">
                    <i class="fas fa-book"></i>
                    <span>Jelajahi Katalog Buku</span>
                </a>
                <a href="<?php echo e(route('anggota.history')); ?>" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);" class="btn btn-action-dashboard">
                    <i class="fas fa-history"></i>
                    <span>Lihat Riwayat Peminjaman</span>
                </a>
            </div>
            <div style="margin-top: 20px; padding: 15px; background: #f0fdf4; border-radius: 12px; border: 1px solid #bbf7d0;">
                <p style="margin: 0; color: #166534; font-size: 0.85rem; display: flex; align-items: start; gap: 8px;">
                    <i class="fas fa-lightbulb" style="margin-top: 2px;"></i>
                    <span><strong>Tips:</strong> Pastikan mengembalikan buku tepat waktu untuk menghindari denda!</span>
                </p>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.anggota', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\SKRIPSI\Project\resources\views/anggota/dashboard.blade.php ENDPATH**/ ?>