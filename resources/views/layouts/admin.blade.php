<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>@yield('title') - Admin Panel</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logo-MA.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('logo-MA.png') }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
            padding: 14px 15px;
            margin: 5px 0;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            position: relative;
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(5px);
        }

        .menu-item.active {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4);
        }

        .menu-item i {
            width: 24px;
            font-size: 1.1rem;
            margin-right: 12px;
        }

        .menu-item span {
            font-weight: 600;
            font-size: 0.95rem;
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
            transition: all 0.3s ease;
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
            font-size: 1.5rem;
            font-weight: 800;
            color: #1e293b;
        }

        .topbar-left p {
            margin: 0;
            font-size: 0.9rem;
            color: #64748b;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .topbar-time {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 15px;
            background: #f1f5f9;
            border-radius: 10px;
            font-size: 0.85rem;
            color: #475569;
        }

        .user-menu {
            position: relative;
        }

        .user-menu-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .user-menu-btn:hover {
            border-color: #8b5cf6;
            background: #f5f3ff;
        }

        .user-menu-avatar {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 0.9rem;
        }

        .user-menu-name {
            font-weight: 600;
            color: #1e293b;
            font-size: 0.9rem;
        }

        /* Content Area */
        .content-area {
            padding: 30px;
        }

        /* Page Header */
        .page-header {
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .breadcrumb-custom {
            display: flex;
            gap: 8px;
            align-items: center;
            font-size: 0.9rem;
            color: #64748b;
        }

        .breadcrumb-custom a {
            color: #8b5cf6;
            text-decoration: none;
        }

        .breadcrumb-custom a:hover {
            text-decoration: underline;
        }

        /* Alerts */
        .alert-modern {
            border: none;
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .alert-modern i {
            font-size: 1.3rem;
        }

        .alert-success {
            background: linear-gradient(135deg, #ede9fe 0%, #ddd6fe 100%);
            color: #5b21b6;
        }

        .alert-danger {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-280px);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .topbar {
                padding: 15px 20px;
            }

            .content-area {
                padding: 20px;
            }

            .topbar-time {
                display: none;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('images/logo-removebg-preview.png') }}" alt="Logo" width="45" height="45">
                    {{--<i class="fas fa-book-reader"></i>--}}
                </div>
                <div class="sidebar-brand-text">
                    <h4>PerManah</h4>
                    <p>Admin Panel</p>
                </div>
            </a>
        </div>

        <div class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>

            {{-- <div class="menu-section-title">Management</div>

            <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>Kelola User</span>
            </a> --}}

            <div class="menu-section-title">Reports</div>
            
            <a href="{{ route('admin.reports') }}" class="menu-item {{ request()->routeIs('admin.reports') ? 'active' : '' }}">
                <i class="fas fa-chart-bar"></i>
                <span>Laporan Peminjaman</span>
            </a>

            <a href="{{ route('admin.editProfile') }}" class="menu-item {{ request()->routeIs('admin.editProfile') ? 'active' : '' }}">
                <i class="fas fa-user-edit"></i>
                <span>Edit Profil</span>
            </a>
        </div>

        <div class="sidebar-user">
            <div class="user-info">
                <div class="user-avatar">
                    @if(auth()->user()->profile_photo)
                        <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                    @else
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    @endif
                </div>
                <div class="user-details">
                    <h6>{{ auth()->user()->name }}</h6>
                    <p>Administrator</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
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
                <h5>@yield('page-title', 'Dashboard')</h5>
                <p id="currentDateTime"></p>
            </div>
            <div class="topbar-right">
                <div class="topbar-time">
                    <i class="fas fa-clock"></i>
                    <span id="currentTime"></span>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area">
            @if(session('success'))
                <div class="alert-modern alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="alert-modern alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </div>

        <!-- Footer -->
        <footer style="padding: 20px 30px; background: white; border-top: 1px solid #e2e8f0; text-align: center; color: #64748b; font-size: 0.85rem;">
            <p class="mb-0">{{ date('Y') }} PerManah - Perpustakaan MA Nurul Hikmah.</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Update time
        function updateTime() {
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const dateStr = now.toLocaleDateString('id-ID', options);
            const timeStr = now.toLocaleTimeString('id-ID');
            
            document.getElementById('currentDateTime').textContent = dateStr;
            document.getElementById('currentTime').textContent = timeStr;
        }
        
        updateTime();
        setInterval(updateTime, 1000);
    </script>
    @stack('scripts')
</body>
</html>
