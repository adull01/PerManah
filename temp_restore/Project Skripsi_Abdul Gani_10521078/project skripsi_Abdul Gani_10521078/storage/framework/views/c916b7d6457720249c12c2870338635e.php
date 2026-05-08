<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('page-title', 'Dashboard Petugas'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        opacity: 0.1;
        transform: translate(30%, -30%);
    }

    .stat-card.warning::before { background: #f59e0b; }
    .stat-card.info::before { background: #3b82f6; }
    .stat-card.success::before { background: #10b981; }
    .stat-card.primary::before { background: #8b5cf6; }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .stat-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 15px;
    }

    .stat-icon {
        width: 55px;
        height: 55px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        color: white;
    }

    .stat-icon.warning { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); }
    .stat-icon.info { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); }
    .stat-icon.success { background: linear-gradient(135deg, #10b981 0%, #059669 100%); }
    .stat-icon.primary { background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); }

    .stat-trend {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 4px 8px;
        border-radius: 6px;
    }

    .stat-trend.up {
        background: #d1fae5;
        color: #065f46;
    }

    .stat-trend.pending {
        background: #fef3c7;
        color: #92400e;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 5px;
    }

    .stat-label {
        color: #64748b;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .stat-footer {
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #e2e8f0;
    }

    .stat-footer a {
        color: #64748b;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 5px;
        transition: all 0.2s;
    }

    .stat-footer a:hover {
        color: #8b5cf6;
        gap: 8px;
    }

    /* Welcome Card */
    .welcome-card {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        border-radius: 16px;
        padding: 35px;
        color: white;
        position: relative;
        overflow: hidden;
        margin-bottom: 30px;
    }

    .welcome-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="50" height="50" patternUnits="userSpaceOnUse"><path d="M 50 0 L 0 0 0 50" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        opacity: 0.3;
    }

    .welcome-content {
        position: relative;
        z-index: 1;
    }

    .welcome-card h2 {
        font-size: 1.8rem;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .welcome-card p {
        opacity: 0.95;
        font-size: 1.05rem;
        margin-bottom: 20px;
    }

    .welcome-features {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-top: 25px;
    }

    .feature-item {
        background: rgba(255, 255, 255, 0.15);
        padding: 15px;
        border-radius: 12px;
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .feature-icon {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .feature-text h6 {
        margin: 0;
        font-size: 0.9rem;
        font-weight: 700;
    }

    .feature-text p {
        margin: 0;
        font-size: 0.75rem;
        opacity: 0.9;
    }

    /* Notification Card */
    .notification-card {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
        border-left: 4px solid #f59e0b;
    }

    .notification-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e2e8f0;
    }

    .notification-header h5 {
        margin: 0;
        font-size: 1.2rem;
        font-weight: 700;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .notification-badge {
        background: #ef4444;
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 700;
    }

    /* Action Button Dashboard */
    .btn-action-dashboard {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 10px;
        font-size: 0.875rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-action-dashboard:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
    }

    .btn-process {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: white;
    }

    .btn-process:hover {
        color: white;
        box-shadow: 0 6px 16px rgba(139, 92, 246, 0.4);
    }

    /* Modern Table */
    .modern-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .modern-table thead th {
        background: #f8fafc;
        color: #475569;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 15px;
        border-bottom: 2px solid #e2e8f0;
        white-space: nowrap;
    }

    .modern-table tbody td {
        padding: 15px;
        border-bottom: 1px solid #f1f5f9;
        color: #1e293b;
    }

    .modern-table tbody tr:hover {
        background: #f8fafc;
    }

    .modern-table tbody tr.highlight {
        background: #fef3c7;
    }

    .info-alert {
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        border-radius: 12px;
        padding: 15px;
        margin-top: 15px;
        color: #1e40af;
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }

    .info-alert i {
        margin-top: 2px;
    }

    /* Activity Card */
    .activity-card {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .activity-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e2e8f0;
    }

    .activity-header i {
        color: #8b5cf6;
        font-size: 1.4rem;
    }

    .activity-header h5 {
        margin: 0;
        font-size: 1.2rem;
        font-weight: 700;
        color: #1e293b;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Welcome Card -->
<div class="welcome-card">
    <div class="welcome-content">
        <h2>Selamat Datang, <?php echo e(auth()->user()->name); ?>! 👋</h2>
        <p>Kelola peminjaman dan anggota perpustakaan dengan efisien</p>
        
        <div class="welcome-features">
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-exchange-alt"></i>
                </div>
                <div class="feature-text">
                    <h6>Peminjaman</h6>
                    <p>Kelola peminjaman buku</p>
                </div>
            </div>
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <div class="feature-text">
                    <h6>Pengumuman</h6>
                    <p>Buat pengumuman</p>
                </div>
            </div>
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="feature-text">
                    <h6>Anggota</h6>
                    <p>Monitor anggota</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Grid -->
<div class="stats-grid">
    <!-- Pending Borrowings -->
    <div class="stat-card warning">
        <div class="stat-card-header">
            <div class="stat-icon warning">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-trend pending">
                <i class="fas fa-exclamation-circle"></i>
                <span>Pending</span>
            </div>
        </div>
        <div class="stat-value"><?php echo e($pendingBorrowings); ?></div>
        <div class="stat-label">Permintaan Pending</div>
        <div class="stat-footer">
            <a href="<?php echo e(route('petugas.borrowings')); ?>">
                Proses sekarang <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Active Borrowings -->
    <div class="stat-card info">
        <div class="stat-card-header">
            <div class="stat-icon info">
                <i class="fas fa-book-open"></i>
            </div>
            <div class="stat-trend up">
                <i class="fas fa-arrow-up"></i>
                <span>Active</span>
            </div>
        </div>
        <div class="stat-value"><?php echo e($activeBorrowings); ?></div>
        <div class="stat-label">Sedang Dipinjam</div>
        <div class="stat-footer">
            <a href="<?php echo e(route('petugas.borrowings')); ?>">
                Lihat detail <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Total Members -->
    <div class="stat-card success">
        <div class="stat-card-header">
            <div class="stat-icon success">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-trend up">
                <i class="fas fa-arrow-up"></i>
                <span>Growing</span>
            </div>
        </div>
        <div class="stat-value"><?php echo e($totalAnggota); ?></div>
        <div class="stat-label">Total Anggota</div>
        <div class="stat-footer">
            <a href="<?php echo e(route('petugas.members')); ?>">
                Lihat detail <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

<!-- Notifikasi Peminjaman Baru -->
<?php if($newNotifications->count() > 0): ?>
<div class="notification-card">
    <div class="notification-header">
        <h5>
            <i class="fas fa-bell"></i> Notifikasi Permintaan Peminjaman Baru
        </h5>
        <span class="notification-badge"><?php echo e($newNotifications->count()); ?></span>
    </div>
    <div class="table-responsive">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>ID Buku</th>
                    <th>Peminjam (ID Anggota)</th>
                    <th>Buku</th>
                    <th>Waktu Request</th>
                    <th>Ketersediaan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $newNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $borrowing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="highlight">
                    <td><strong>#<?php echo e($borrowing->book->id); ?></strong></td>
                    <td>
                        <strong><?php echo e($borrowing->user->name); ?></strong><br>
                        <small class="text-muted">ID: #<?php echo e($borrowing->user->id); ?></small>
                    </td>
                    <td><?php echo e($borrowing->book->title); ?></td>
                    <td>
                        <?php if($borrowing->notified_at): ?>
                            <i class="fas fa-clock"></i> <?php echo e($borrowing->notified_at->diffForHumans()); ?><br>
                            <small class="text-muted"><?php echo e($borrowing->notified_at->format('d/m/Y H:i')); ?></small>
                        <?php else: ?>
                            <i class="fas fa-clock"></i> <?php echo e($borrowing->created_at->diffForHumans()); ?><br>
                            <small class="text-muted"><?php echo e($borrowing->created_at->format('d/m/Y H:i')); ?></small>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($borrowing->book->available > 0): ?>
                            <span class="badge bg-success">Tersedia: <?php echo e($borrowing->book->available); ?></span>
                        <?php else: ?>
                            <span class="badge bg-danger">Stok Habis</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo e(route('petugas.borrowings')); ?>" class="btn-action-dashboard btn-process">
                            <i class="fas fa-arrow-right"></i>
                            <span>Proses</span>
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <div class="info-alert">
        <i class="fas fa-info-circle"></i>
        <span>Harap segera proses permintaan peminjaman ini. Cek ketersediaan buku sebelum approve.</span>
    </div>
</div>
<?php endif; ?>

<!-- Aktivitas Peminjaman Terbaru -->
<div class="activity-card">
    <div class="activity-header">
        <i class="fas fa-history"></i>
        <h5>Aktivitas Peminjaman Terbaru</h5>
    </div>
    <div class="table-responsive">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>ID Buku</th>
                    <th>Peminjam</th>
                    <th>Buku</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $recentBorrowings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $borrowing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><strong>#<?php echo e($borrowing->book->id); ?></strong></td>
                    <td><?php echo e($borrowing->user->name); ?></td>
                    <td><?php echo e($borrowing->book->title); ?></td>
                    <td><?php echo e($borrowing->created_at->diffForHumans()); ?></td>
                    <td>
                        <?php if($borrowing->status == 'pending'): ?>
                            <span class="badge bg-warning">Pending</span>
                        <?php elseif($borrowing->status == 'approved'): ?>
                            <span class="badge bg-info">Dipinjam</span>
                        <?php elseif($borrowing->status == 'returned'): ?>
                            <span class="badge bg-success">Dikembalikan</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Ditolak</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="text-center" style="padding: 40px;">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <p class="text-muted mb-0">Belum ada aktivitas peminjaman</p>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.petugas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Skripsi\skripsi\resources\views/petugas/dashboard.blade.php ENDPATH**/ ?>