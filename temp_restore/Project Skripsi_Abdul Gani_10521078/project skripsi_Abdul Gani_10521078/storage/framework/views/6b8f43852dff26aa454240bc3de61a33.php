<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('page-title', 'Dashboard'); ?>

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

    .stat-card.primary::before { background: #3b82f6; }
    .stat-card.success::before { background: #8b5cf6; }
    .stat-card.warning::before { background: #f59e0b; }
    .stat-card.danger::before { background: #ef4444; }

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

    .stat-icon.primary { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); }
    .stat-icon.success { background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); }
    .stat-icon.warning { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); }
    .stat-icon.danger { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); }

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

    .stat-trend.down {
        background: #fee2e2;
        color: #991b1b;
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

    /* Info Card */
    .info-card {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .info-card-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e2e8f0;
    }

    .info-card-header i {
        color: #8b5cf6;
        font-size: 1.4rem;
    }

    .info-card-header h5 {
        margin: 0;
        font-size: 1.2rem;
        font-weight: 700;
        color: #1e293b;
    }

    .info-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .info-list li {
        padding: 12px 0;
        display: flex;
        align-items: flex-start;
        gap: 12px;
        border-bottom: 1px solid #f1f5f9;
    }

    .info-list li:last-child {
        border-bottom: none;
    }

    .info-list i {
        color: #8b5cf6;
        margin-top: 3px;
    }

    .info-list strong {
        color: #1e293b;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Welcome Card -->
<div class="welcome-card">
    <div class="welcome-content">
        <h2>Selamat Datang, <?php echo e(auth()->user()->name); ?>! 👋</h2>
        <p>Kelola perpustakaan digital Anda dengan mudah dan efisien</p>
        
        <div class="welcome-features">
            
                
            </div>
            
        </div>
    </div>
</div>

<!-- Stats Grid -->
<div class="stats-grid">
    <!-- Total Users -->
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
        <div class="stat-value"><?php echo e($totalUsers); ?></div>
        <div class="stat-label">Total Users</div>
        <div class="stat-footer">
            
        </div>
    </div>

    <!-- Total Borrowings -->
    <div class="stat-card warning">
        <div class="stat-card-header">
            <div class="stat-icon warning">
                <i class="fas fa-exchange-alt"></i>
            </div>
            <div class="stat-trend up">
                <i class="fas fa-arrow-up"></i>
                <span>Active</span>
            </div>
        </div>
        <div class="stat-value"><?php echo e($totalBorrowings); ?></div>
        <div class="stat-label">Total Peminjaman</div>
        <div class="stat-footer">
            <a href="<?php echo e(route('admin.reports')); ?>">
                Lihat detail <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Pending Borrowings -->
    <div class="stat-card danger">
        <div class="stat-card-header">
            <div class="stat-icon danger">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-trend <?php echo e($pendingBorrowings > 0 ? 'up' : 'down'); ?>">
                <i class="fas fa-<?php echo e($pendingBorrowings > 0 ? 'exclamation' : 'check'); ?>-circle"></i>
                <span><?php echo e($pendingBorrowings > 0 ? 'Pending' : 'Clear'); ?></span>
            </div>
        </div>
        <div class="stat-value"><?php echo e($pendingBorrowings); ?></div>
        <div class="stat-label">Pending Borrowings</div>
        <div class="stat-footer">
            <a href="<?php echo e(route('admin.reports')); ?>">
                Lihat detail <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="info-card">
    <div class="info-card-header">
        <i class="fas fa-bolt"></i>
        <h5>Fitur Utama</h5>
    </div>
    <ul class="info-list">
        <li>
            <i class="fas fa-check-circle"></i>
            <div>
                <strong>Kelola Buku</strong> - Tambah, edit, dan hapus data buku dengan mudah
            </div>
        </li>
        <li>
            <i class="fas fa-check-circle"></i>
            <div>
                <strong>Kelola User</strong> - Manajemen petugas dan anggota perpustakaan
            </div>
        </li>
        <li>
            <i class="fas fa-check-circle"></i>
            <div>
                <strong>Laporan Peminjaman</strong> - Monitor dan analisis aktivitas peminjaman bulanan
            </div>
        </li>
        <li>
            <i class="fas fa-check-circle"></i>
            <div>
                <strong>Dashboard Real-time</strong> - Pantau statistik perpustakaan secara langsung
            </div>
        </li>
    </ul>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Skripsi\skripsi\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>