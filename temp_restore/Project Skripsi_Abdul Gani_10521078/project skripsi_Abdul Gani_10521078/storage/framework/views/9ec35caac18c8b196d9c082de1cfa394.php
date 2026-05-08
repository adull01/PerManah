<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title><?php echo $__env->yieldContent('title'); ?> - PerManah Member</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo e(asset('logo-MA.png')); ?>">
    <link rel="shortcut icon" type="image/png" href="<?php echo e(asset('logo-MA.png')); ?>">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f8fafc;
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: 280px;
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            padding: 0;
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
        }

        .sidebar-header {
            padding: 30px 25px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 15px;
            color: white;
            text-decoration: none;
        }

        .sidebar-brand-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
        }

        .sidebar-brand-text h4 {
            margin: 0;
            font-size: 1.3rem;
            font-weight: 800;
        }

        .sidebar-brand-text p {
            margin: 0;
            font-size: 0.75rem;
            opacity: 0.7;
        }

        .sidebar-menu {
            padding: 20px 15px;
            overflow-y: auto;
            height: calc(100vh - 250px);
        }

        .sidebar-menu::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }

        .menu-section-title {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.4);
            padding: 20px 15px 10px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            border-radius: 12px;
            margin-bottom: 5px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .menu-item i {
            width: 24px;
            margin-right: 12px;
            font-size: 1.1rem;
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(5px);
        }

        .menu-item.active {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
        }

        .sidebar-user {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px 25px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.2);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .user-details h6 {
            margin: 0;
            color: white;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .user-details p {
            margin: 0;
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.5);
        }

        .logout-btn {
            width: 100%;
            padding: 10px;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #ef4444;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .logout-btn:hover {
            background: #ef4444;
            color: white;
            border-color: #ef4444;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            min-height: 100vh;
            background: #f8fafc;
        }

        /* Topbar */
        .topbar {
            background: white;
            padding: 20px 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .topbar-left h5 {
            margin: 0;
            font-weight: 700;
            color: #1e293b;
        }

        .topbar-left p {
            margin: 0;
            font-size: 0.85rem;
            color: #64748b;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .topbar-time {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 20px;
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            border-radius: 12px;
            color: white;
        }

        .topbar-time i {
            font-size: 1.2rem;
        }

        .time-text h6 {
            margin: 0;
            font-size: 0.95rem;
            font-weight: 600;
        }

        .time-text p {
            margin: 0;
            font-size: 0.75rem;
            opacity: 0.9;
        }

        /* Content Area */
        .content-area {
            padding: 30px;
        }

        /* Alert Styling */
        .alert {
            border: none;
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: white;
        }

        .alert-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        /* Footer */
        .footer {
            background: white;
            padding: 20px 30px;
            text-align: center;
            color: #64748b;
            font-size: 0.85rem;
            border-top: 1px solid #e2e8f0;
        }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <a href="<?php echo e(route('anggota.dashboard')); ?>" class="sidebar-brand">
                <div class="sidebar-brand-icon">
                    <img src="<?php echo e(asset('images/logo-removebg-preview.png')); ?>" alt="Logo" width="45" height="45">
                    
                </div>
                <div class="sidebar-brand-text">
                    <h4>PerManah</h4>
                    <p>Member Portal</p>
                </div>
            </a>
        </div>

        <div class="sidebar-menu">
            <div class="menu-section-title">Menu Utama</div>
            <a href="<?php echo e(route('anggota.dashboard')); ?>" class="menu-item <?php echo e(request()->routeIs('anggota.dashboard') ? 'active' : ''); ?>">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <a href="<?php echo e(route('anggota.catalog')); ?>" class="menu-item <?php echo e(request()->routeIs('anggota.catalog*') ? 'active' : ''); ?>">
                <i class="fas fa-book"></i>
                <span>Katalog Buku</span>
            </a>
            <a href="<?php echo e(route('anggota.history')); ?>" class="menu-item <?php echo e(request()->routeIs('anggota.history') ? 'active' : ''); ?>">
                <i class="fas fa-history"></i>
                <span>Riwayat Peminjaman</span>
            </a>
            <a href="<?php echo e(route('anggota.profile')); ?>" class="menu-item <?php echo e(request()->routeIs('anggota.profile*') ? 'active' : ''); ?>">
                <i class="fas fa-user-circle"></i>
                <span>Profil Saya</span>
            </a>
        </div>

        <div class="sidebar-user">
            <div class="user-info">
                <div class="user-avatar">
                    <?php if(auth()->user()->profile_photo): ?>
                        <img src="<?php echo e(auth()->user()->profile_photo_url); ?>" alt="<?php echo e(auth()->user()->name); ?>" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                    <?php else: ?>
                        <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

                    <?php endif; ?>
                </div>
                <div class="user-details">
                    <h6><?php echo e(auth()->user()->name); ?></h6>
                    <p>Member</p>
                </div>
            </div>
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <div class="topbar-left">
                <h5><?php echo $__env->yieldContent('title'); ?></h5>
                <p>Selamat datang di portal anggota perpus</p>
            </div>
            <div class="topbar-right">
                <div class="topbar-time">
                    <i class="fas fa-clock"></i>
                    <div class="time-text">
                        <h6 id="current-time">00:00:00</h6>
                        <p id="current-date">Loading...</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="content-area">
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <?php echo e(session('error')); ?>

                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            
            <?php echo $__env->yieldContent('content'); ?>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p class="mb-0"><?php echo e(date('Y')); ?> PerManah - Perpustakaan MA Nurul Hikmah.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Real-time clock
        function updateTime() {
            const now = new Date();
            const time = now.toLocaleTimeString('id-ID');
            const date = now.toLocaleDateString('id-ID', { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });
            
            document.getElementById('current-time').textContent = time;
            document.getElementById('current-date').textContent = date;
        }
        
        updateTime();
        setInterval(updateTime, 1000);

        // Sweet Alert for Session Messages
        document.addEventListener('DOMContentLoaded', function() {
            <?php if(session('success')): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "<?php echo e(session('success')); ?>",
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            <?php endif; ?>

            <?php if(session('error')): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: "<?php echo e(session('error')); ?>",
                    confirmButtonColor: '#dc3545'
                });
            <?php endif; ?>

            <?php if(session('warning')): ?>
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian!',
                    text: "<?php echo e(session('warning')); ?>",
                    confirmButtonColor: '#ffc107'
                });
            <?php endif; ?>

            <?php if(session('info')): ?>
                Swal.fire({
                    icon: 'info',
                    title: 'Informasi',
                    text: "<?php echo e(session('info')); ?>",
                    confirmButtonColor: '#0d6efd'
                });
            <?php endif; ?>
        });
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Skripsi\skripsi\resources\views/layouts/anggota.blade.php ENDPATH**/ ?>