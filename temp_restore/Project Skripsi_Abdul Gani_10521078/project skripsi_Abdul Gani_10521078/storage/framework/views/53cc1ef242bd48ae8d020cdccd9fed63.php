<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PerManah - Gerbang Dunia Pengetahuan</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo e(asset('logo-MA.png')); ?>">
    <link rel="shortcut icon" type="image/png" href="<?php echo e(asset('logo-MA.png')); ?>">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS (CDN for immediate preview/compatibility) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f5f3ff',
                            100: '#ede9fe',
                            200: '#ddd6fe',
                            300: '#c4b5fd',
                            400: '#a78bfa',
                            500: '#8b5cf6',
                            600: '#7c3aed',
                            700: '#6d28d9',
                            800: '#5b21b6',
                            900: '#4c1d95',
                        },
                        dark: {
                            900: '#0f172a',
                            800: '#1e293b',
                            700: '#334155',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        /* Custom Utilities */
        .glass-nav {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        }
        
        .hero-pattern {
            background-color: #ffffff;
            background-image: radial-gradient(#8b5cf6 0.5px, transparent 0.5px), radial-gradient(#8b5cf6 0.5px, #ffffff 0.5px);
            background-size: 20px 20px;
            background-position: 0 0, 10px 10px;
            opacity: 0.1;
        }

        .scroll-smooth {
            scroll-behavior: smooth;
        }
        
        /* Infinite Scroll Animation */
        @keyframes scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        
        .animate-scroll {
            animation: scroll 40s linear infinite;
        }
        
        .pause-scroll {
            animation-play-state: paused;
        }

        /* Animation Classes */
        .fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="font-sans antialiased text-slate-600 bg-white scroll-smooth selection:bg-brand-500 selection:text-white">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 transition-all duration-300 glass-nav" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center shadow-lg">
                        <img src="<?php echo e(asset('logo-MA.png')); ?>" alt="Logo MA" class="w-8 h-8 object-contain">
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-slate-900 tracking-tight">Per<span class="text-brand-600">Manah</span></h1>
                    </div>
                </div>

                <!-- Desktop Menu -->
                 <div class="hidden md:flex items-center space-x-10">
                    <div class="flex items-center space-x-8">
                        <a href="<?php echo e(route('landing')); ?>#beranda" class="text-sm font-bold text-slate-600 hover:text-brand-600 transition-colors">Beranda</a>
                        <a href="<?php echo e(route('landing')); ?>#fitur" class="text-sm font-bold text-slate-600 hover:text-brand-600 transition-colors">Fitur</a>
                        <a href="<?php echo e(route('landing')); ?>#layanan" class="text-sm font-bold text-slate-600 hover:text-brand-600 transition-colors">Layanan</a>
                        <a href="<?php echo e(route('about')); ?>" class="text-sm font-bold text-slate-600 hover:text-brand-600 transition-colors">Tentang Kami</a>
                        <a href="<?php echo e(route('landing')); ?>#statistik" class="text-sm font-bold text-slate-600 hover:text-brand-600 transition-colors">Statistik</a>
                    </div>
                    <div class="h-6 w-px bg-slate-200"></div>
                    <a href="<?php echo e(route('login')); ?>" class="px-6 py-2.5 rounded-xl bg-brand-600 text-white text-sm font-bold hover:bg-brand-700 transition-all shadow-lg shadow-brand-500/30">
                        Login
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button class="text-slate-600 hover:text-brand-600 focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="relative overflow-hidden">
        <!-- Top Background Wrapper (Limited Height) -->
        <div class="absolute top-0 inset-x-0 h-[550px] z-0">
            <img src="<?php echo e(asset('images/bg.jpeg')); ?>" class="w-full h-full object-cover object-center" alt="Library Background">
            <div class="absolute inset-0 bg-slate-900/80 z-10"></div>
            <!-- Bottom Fade effect to blend with white background -->
            <div class="absolute bottom-0 inset-x-0 h-32 bg-gradient-to-t from-slate-50 to-transparent z-20"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-30 pt-32 pb-20 text-center">
            <span class="inline-block py-1 px-3 rounded-full bg-white/10 border border-white/20 text-brand-300 text-xs font-bold uppercase tracking-wider mb-6 fade-in-up backdrop-blur-sm">
                Selamat Datang di Portal Literasi Sekolah
            </span>
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold text-white tracking-tight leading-tight mb-8 fade-in-up delay-100">
                Jelajahi Ribuan <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-400 to-blue-300">Buku Digital</span><br>
                Tanpa Batas Waktu
            </h1>
            <p class="mt-4 max-w-2xl mx-auto text-xl text-slate-200 mb-10 fade-in-up delay-200">
                Akses perpustakaan modern dengan koleksi lengkap, mulai dari buku pelajaran, novel, hingga jurnal ilmiah secara digital di mana saja.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4 fade-in-up delay-300 mb-12">
                <a href="<?php echo e(route('login')); ?>" class="px-8 py-4 rounded-xl bg-brand-600 text-white font-bold text-lg hover:bg-brand-700 transition-all shadow-xl shadow-brand-500/20 hover:shadow-brand-500/40 hover:-translate-y-1">
                    <i class="fas fa-book-reader mr-2"></i> Mulai Membaca
                </a>
                <a href="#fitur" class="px-8 py-4 rounded-xl bg-white/10 border border-white/20 text-white font-bold text-lg hover:bg-white/20 backdrop-blur-md transition-all hover:-translate-y-1">
                    Pelajari Fitur
                </a>
            </div>
            
            <!-- Judul Dashboard Modern -->
             <h3 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4 fade-in-up delay-100">Dashboard Modern</h3>

            <!-- Preview Section (Now outside the main bg height) -->
            <div class="mt-8 max-w-5xl mx-auto fade-in-up delay-300">
            <div class="mt-20 relative mx-auto max-w-5xl fade-in-up delay-300">
                <div class="p-2 bg-slate-100 rounded-2xl shadow-2xl border border-slate-200/60">
                    <div class="bg-white rounded-xl overflow-hidden relative group">
                         
                        <!-- Placeholder for dashboard image -->
                       
                        <div class="absolute inset-0 bg-gradient-to-br from-slate-100 to-slate-50 flex items-center justify-center z-0">
                            <div class="text-center">
                                <div class="w-20 h-20 bg-brand-100 rounded-full flex items-center justify-center mx-auto mb-4 text-brand-600">
                                    <i class="fas fa-laptop-code text-3xl"></i>
                                </div>
                                <p class="text-slate-400 font-medium">Dashboard Anggota Modern</p>
                            </div>
                        </div>
                        <!-- Dashboard Preview Image -->
                        <img src="<?php echo e(asset('images/dashboard-preview.png')); ?>" alt="Dashboard Preview" class="w-full h-auto block relative z-10 transition-transform duration-500 group-hover:scale-[1.02]">
                    </div>
                </div>
            </div>
        </div>        
            <!-- New Book Slider Section in Hero -->
            <div class="mt-24 fade-in-up delay-300">
                <p class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-8">Koleksi Terbaru Kami</p>
                
                <div class="relative w-full overflow-hidden group">
                    <!-- Gradient Overlays for smooth fade effect at edges -->
                    <div class="absolute left-0 top-0 bottom-0 w-20 bg-gradient-to-r from-slate-50 to-transparent z-20 pointer-events-none"></div>
                    <div class="absolute right-0 top-0 bottom-0 w-20 bg-gradient-to-l from-slate-50 to-transparent z-20 pointer-events-none"></div>

                    <!-- Slider Container -->
                    <div class="flex gap-6 animate-scroll hover:pause-scroll w-[max-content]">
                        <!-- Original Set -->
                        <?php $__currentLoopData = $latestBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="w-32 md:w-40 flex-shrink-0 transition-transform duration-300 hover:scale-105 hover:-translate-y-2 cursor-pointer group/book" title="<?php echo e($book->title); ?>">
                            <div class="aspect-[2/3] rounded-lg shadow-md overflow-hidden bg-white border border-slate-200 relative text-left">
                                <?php if($book->cover_image): ?>
                                    <img src="<?php echo e(asset('storage/' . $book->cover_image)); ?>" alt="<?php echo e($book->title); ?>" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center bg-slate-100 text-slate-400">
                                        <i class="fas fa-book text-3xl"></i>
                                    </div>
                                <?php endif; ?>
                                <!-- Hover Overlay -->
                                <div class="absolute inset-0 bg-black/60 opacity-0 group-hover/book:opacity-100 transition-opacity flex items-center justify-center p-2">
                                    <p class="text-white text-xs font-semibold text-center line-clamp-3"><?php echo e($book->title); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <!-- Duplicate Set for Infinite Loop Effect -->
                        <?php $__currentLoopData = $latestBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="w-32 md:w-40 flex-shrink-0 transition-transform duration-300 hover:scale-105 hover:-translate-y-2 cursor-pointer group/book" aria-hidden="true">
                            <div class="aspect-[2/3] rounded-lg shadow-md overflow-hidden bg-white border border-slate-200 relative">
                                <?php if($book->cover_image): ?>
                                    <img src="<?php echo e(asset('storage/' . $book->cover_image)); ?>" alt="<?php echo e($book->title); ?>" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center bg-slate-100 text-slate-400">
                                        <i class="fas fa-book text-3xl"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section id="statistik" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Stat 1 -->
                <div class="p-8 rounded-2xl bg-slate-50 border border-slate-100 hover:shadow-lg transition-all group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-blue-100 text-blue-600 rounded-lg group-hover:scale-110 transition-transform">
                            <i class="fas fa-book text-2xl"></i>
                        </div>
                        <span class="text-sm font-bold text-slate-400 uppercase tracking-wider">Koleksi</span>
                    </div>
                    <h3 class="text-4xl font-extrabold text-slate-900 mb-1"><?php echo e($totalBooks); ?>+</h3>
                    <p class="text-slate-500 font-medium">Buku Tersedia</p>
                </div>

                <!-- Stat 2 -->
                <div class="p-8 rounded-2xl bg-slate-50 border border-slate-100 hover:shadow-lg transition-all group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-brand-100 text-brand-600 rounded-lg group-hover:scale-110 transition-transform">
                            <i class="fas fa-users text-2xl"></i>
                        </div>
                        <span class="text-sm font-bold text-slate-400 uppercase tracking-wider">Komunitas</span>
                    </div>
                    <h3 class="text-4xl font-extrabold text-slate-900 mb-1"><?php echo e($totalMembers); ?>+</h3>
                    <p class="text-slate-500 font-medium">Anggota Aktif</p>
                </div>

                <!-- Stat 3 -->
                <div class="p-8 rounded-2xl bg-slate-50 border border-slate-100 hover:shadow-lg transition-all group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-emerald-100 text-emerald-600 rounded-lg group-hover:scale-110 transition-transform">
                            <i class="fas fa-exchange-alt text-2xl"></i>
                        </div>
                        <span class="text-sm font-bold text-slate-400 uppercase tracking-wider">Aktivitas</span>
                    </div>
                    <h3 class="text-4xl font-extrabold text-slate-900 mb-1"><?php echo e($monthlyBorrowings); ?>+</h3>
                    <p class="text-slate-500 font-medium">Transaksi Bulan Ini</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="py-24 bg-slate-50 relative overflow-hidden">
        <!-- Decoration -->
        <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-slate-200 to-transparent"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-base font-bold text-brand-600 uppercase tracking-wide mb-2">Kenapa Memilih Kami?</h2>
                <h3 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">Fitur Unggulan Untuk Kenyamanan Anda</h3>
                <p class="text-lg text-slate-500">Kami menghadirkan pengalaman perpustakaan digital yang seamless, cepat, dan mudah digunakan oleh siapa saja.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 bg-brand-50 rounded-xl flex items-center justify-center text-brand-600 mb-6 font-bold text-2xl">
                        <i class="fas fa-search"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Pencarian Cerdas</h4>
                    <p class="text-slate-500 leading-relaxed">
                        Temukan buku favorit Anda dalam hitungan detik dengan sistem pencarian dan filter kategori yang canggih.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 mb-6 font-bold text-2xl">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Layanan 8/5</h4>
                    <p class="text-slate-500 leading-relaxed">
                        Akses katalog dan ajukan peminjaman kapan saja dan di mana saja tanpa terikat jam operasional fisik.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 bg-purple-50 rounded-xl flex items-center justify-center text-purple-600 mb-6 font-bold text-2xl">
                        <i class="fas fa-history"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Tracking Riwayat</h4>
                    <p class="text-slate-500 leading-relaxed">
                        Pantau status peminjaman, tanggal pengembalian, dan riwayat bacaan Anda secara real-time.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services / Roles Section -->
    <section id="layanan" class="py-24 bg-white border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-12 items-center">
                <div class="w-full md:w-1/2">
                    <div class="relative">
                        <div class="absolute inset-0 bg-brand-200 rounded-3xl transform rotate-6 scale-95 opacity-50"></div>
                        <div class="relative bg-gradient-to-br from-slate-900 to-slate-800 rounded-3xl p-10 text-white overflow-hidden shadow-2xl">
                            <!-- Texture -->
                            <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full blur-3xl -mr-32 -mt-32"></div>
                            
                            <h3 class="text-2xl font-bold mb-6">Portal Anggota</h3>
                            <ul class="space-y-4 mb-8">
                                <li class="flex items-center gap-3">
                                    <div class="w-6 h-6 rounded-full bg-brand-500 flex items-center justify-center text-xs">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <span class="text-slate-200">Akses ribuan koleksi buku</span>
                                </li>
                                <li class="flex items-center gap-3">
                                    <div class="w-6 h-6 rounded-full bg-brand-500 flex items-center justify-center text-xs">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <span class="text-slate-200">Peminjaman mudah & cepat</span>
                                </li>
                                <li class="flex items-center gap-3">
                                    <div class="w-6 h-6 rounded-full bg-brand-500 flex items-center justify-center text-xs">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <span class="text-slate-200">Bebas biaya pendaftaran</span>
                                </li>
                            </ul>

                            <a href="<?php echo e(route('anggota.register')); ?>" class="block w-full text-center py-3 bg-white text-slate-900 font-bold rounded-xl hover:bg-slate-100 transition-colors">
                                Daftar Sebagai Anggota
                            </a>
                            <p class="text-center text-sm text-slate-400 mt-4">Sudah punya akun? <a href="<?php echo e(route('anggota.login')); ?>" class="text-brand-400 hover:text-white underline">Masuk disini</a></p>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-1/2">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-6">Bergabunglah Bersama Ribuan Pembaca Lainnya</h2>
                    <p class="text-lg text-slate-500 mb-8 leading-relaxed">
                        Kami menyediakan platform literasi yang tidak hanya sekedar tempat meminjam buku, tetapi juga ruang untuk mengembangkan wawasan dan pengetahuan Anda.
                    </p>

                    <div class="grid grid-cols-2 gap-6">
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                            <div class="text-3xl font-bold text-brand-600 mb-1">FREE</div>
                            <div class="text-sm font-semibold text-slate-600">Akses Gratis</div>
                        </div>
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                            <div class="text-3xl font-bold text-brand-600 mb-1">100%</div>
                            <div class="text-sm font-semibold text-slate-600">Digital Access</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white pt-20 pb-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-16">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-lg bg-white flex items-center justify-center">
                            <img src="<?php echo e(asset('logo-MA.png')); ?>" alt="Logo MA" class="w-8 h-8 object-contain">
                        </div>
                        <h4 class="text-2xl font-bold">Per<span class="text-brand-400">Manah</span></h4>
                    </div>
                    <p class="text-slate-400 leading-relaxed max-w-sm mb-6">
                        Platform perpustakaan digital modern MA Nurul Hikmah yang didedikasikan untuk memajukan literasi dan memudahkan akses pengetahuan bagi semua.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-brand-600 hover:text-white transition-all">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-brand-600 hover:text-white transition-all">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-brand-600 hover:text-white transition-all">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h5 class="text-lg font-bold text-white mb-6">Navigasi</h5>
                    <ul class="space-y-4">
                        <li><a href="#beranda" class="text-slate-400 hover:text-brand-400 transition-colors">Beranda</a></li>
                        <li><a href="#fitur" class="text-slate-400 hover:text-brand-400 transition-colors">Fitur</a></li>
                        <li><a href="#layanan" class="text-slate-400 hover:text-brand-400 transition-colors">Layanan</a></li>
                        <li><a href="#statistik" class="text-slate-400 hover:text-brand-400 transition-colors">Statistik</a></li>
                        <li><a href="<?php echo e(route('about')); ?>" class="text-slate-400 hover:text-brand-400 transition-colors">Tentang Kami</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-slate-800 pt-8 text-center">
                <p class="text-slate-500 text-sm">
                    <?php echo e(date('Y')); ?> PerManah - Perpustakaan MA Nurul Hikmah.
                </p>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Script -->
    <script>
        const btn = document.querySelector('button.focus\\:outline-none');
        const menu = document.createElement('div');
        menu.className = 'md:hidden fixed inset-0 bg-white z-40 transform translate-x-full transition-transform duration-300 flex flex-col pt-24 px-6 gap-6';
        menu.innerHTML = `
            <a href="<?php echo e(route('landing')); ?>#beranda" class="text-xl font-bold text-slate-900" onclick="closeMenu()">Beranda</a>
            <a href="<?php echo e(route('landing')); ?>#fitur" class="text-xl font-bold text-slate-900" onclick="closeMenu()">Fitur</a>
            <a href="<?php echo e(route('landing')); ?>#layanan" class="text-xl font-bold text-slate-900" onclick="closeMenu()">Layanan</a>
            <a href="<?php echo e(route('about')); ?>" class="text-xl font-bold text-slate-900" onclick="closeMenu()">Tentang Kami</a>
            <a href="<?php echo e(route('login')); ?>" class="px-6 py-3 rounded-xl bg-brand-600 text-white font-bold text-center">Login</a>
            <button onclick="closeMenu()" class="absolute top-6 right-6 text-slate-500">
                <i class="fas fa-times text-2xl"></i>
            </button>
        `;
        document.body.appendChild(menu);

        btn.addEventListener('click', () => {
            menu.classList.remove('translate-x-full');
        });

        function closeMenu() {
            menu.classList.add('translate-x-full');
        }

        // Navbar Scroll Effect
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 20) {
                navbar.classList.add('shadow-md');
                navbar.classList.replace('bg-transparent', 'bg-white/90');
            } else {
                navbar.classList.remove('shadow-md');
            }
        });
    </script>
</body>
</html>
<?php /**PATH C:\Skripsi\skripsi\resources\views/landing.blade.php ENDPATH**/ ?>