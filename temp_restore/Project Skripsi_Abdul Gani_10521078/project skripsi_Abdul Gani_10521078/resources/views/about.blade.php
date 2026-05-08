<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - PerManah</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logo-MA.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('logo-MA.png') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS -->
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
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        html { scroll-behavior: smooth; }
        .fade-in-up { opacity: 0; transform: translateY(20px); animation: fadeInUp 0.8s ease forwards; }
        @keyframes fadeInUp { to { opacity: 1; transform: translateY(0); } }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        
        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        }
    </style>
</head>
<body class="font-sans antialiased text-slate-700 bg-slate-50">

    <!-- Navbar -->
    <nav class="fixed top-0 w-full z-50 glass-nav">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-lg">
                        <img src="{{ asset('logo-MA.png') }}" alt="Logo MA" class="w-8 h-8 object-contain">
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-slate-900 tracking-tight">Per<span class="text-brand-600">Manah</span></h1>
                    </div>
                </div>
                
                <div class="hidden md:flex items-center space-x-10">
                    <div class="flex items-center space-x-8">
                        <a href="{{ route('landing') }}#beranda" class="text-sm font-bold text-slate-600 hover:text-brand-600 transition-colors">Beranda</a>
                        <a href="{{ route('landing') }}#fitur" class="text-sm font-bold text-slate-600 hover:text-brand-600 transition-colors">Fitur</a>
                        <a href="{{ route('landing') }}#layanan" class="text-sm font-bold text-slate-600 hover:text-brand-600 transition-colors">Layanan</a>
                        <a href="{{ route('about') }}" class="text-sm font-bold text-slate-600 hover:text-brand-600 transition-colors">Tentang Kami</a>
                        <a href="{{ route('landing') }}#statistik" class="text-sm font-bold text-slate-600 hover:text-brand-600 transition-colors">Statistik</a>
                    </div>
                    <div class="h-6 w-px bg-slate-200"></div>
                    <a href="{{ route('login') }}" class="px-6 py-2.5 rounded-xl bg-brand-600 text-white text-sm font-bold hover:bg-brand-700 transition-all shadow-lg shadow-brand-500/30">
                        Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <header class="relative pt-32 pb-20 overflow-hidden bg-slate-900">
        <div class="absolute inset-0 opacity-20">
            <img src="{{ asset('images/bg.jpeg') }}" class="w-full h-full object-cover" alt="Background">
        </div>
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900/50 to-slate-900"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4 fade-in-up">Tentang Kami</h1>
            <p class="text-brand-200 text-lg max-w-2xl mx-auto fade-in-up delay-100">Mengenal lebih dekat Perpustakaan Digital MA Nurul Hikmah, pusat literasi dan ilmu pengetahuan untuk masa depan.</p>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-20 pb-20">
        
        <!-- Quick Stats / Highlights -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">
            <div class="bg-white p-8 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 fade-in-up delay-200">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 text-xl">
                    <i class="fas fa-history"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Sejarah</h3>
                <p class="text-slate-500 leading-relaxed text-sm">Didirikan pada tahun 2018 sebagai jantung akademik MA Nurul Hikmah untuk menunjang proses belajar mengajar.</p>
            </div>
            <div class="bg-white p-8 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 fade-in-up delay-200">
                <div class="w-12 h-12 bg-brand-50 text-brand-600 rounded-2xl flex items-center justify-center mb-6 text-xl">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Lokasi</h3>
                <p class="text-slate-500 leading-relaxed text-sm">Berlokasi strategis di Jl. Pagaden Ciburuyan Nusawangi, Kawalu, Kota Tasikmalaya, Jawa Barat.</p>
            </div>
            <div class="bg-white p-8 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 fade-in-up delay-200">
                <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center mb-6 text-xl">
                    <i class="fas fa-bullseye"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Visi</h3>
                <p class="text-slate-500 leading-relaxed text-sm">Menjadi perpustakaan unggul dalam layanan informasi bagi generasi berilmu dan berakhlak mulia.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
            
            <!-- Left Column: Content -->
            <div class="space-y-12 fade-in-up delay-300">
                <section>
                    <h2 class="text-3xl font-extrabold text-slate-900 mb-6 flex items-center gap-4">
                        <span class="w-2 h-10 bg-brand-600 rounded-full"></span>
                        Profil Perpustakaan
                    </h2>
                    <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed space-y-4">
                        <p>
                            Perpustakaan MA Nurul Hikmah merupakan pusat sumber belajar bagi seluruh civitas madrasah, mulai dari siswa hingga tenaga pendidik. Sejak berdirinya pada 2 Juli 2018, kami berkomitmen untuk menyediakan akses literasi yang inklusif dan berkualitas.
                        </p>
                        <p>
                            Berada di bawah naungan Kementerian Agama Republik Indonesia, perpustakaan kami terus melakukan transformasi digital untuk meningkatkan efisiensi pengelolaan koleksi dan kemudahan akses informasi bagi para pembaca.
                        </p>
                    </div>
                </section>

                <section>
                    <h2 class="text-3xl font-extrabold text-slate-900 mb-6 flex items-center gap-4">
                        <span class="w-2 h-10 bg-brand-600 rounded-full"></span>
                        Misi Kami
                    </h2>
                    <div class="space-y-4">
                        <div class="flex gap-4 p-5 rounded-2xl bg-white border border-slate-100 shadow-sm transition-all hover:border-brand-200">
                            <div class="w-10 h-10 rounded-full bg-brand-50 text-brand-600 flex-shrink-0 flex items-center justify-center font-bold">1</div>
                            <p class="text-slate-600 text-sm italic">Menyediakan koleksi buku dan sumber belajar yang berkualitas untuk mendukung proses pembelajaran di madrasah.</p>
                        </div>
                        <div class="flex gap-4 p-5 rounded-2xl bg-white border border-slate-100 shadow-sm transition-all hover:border-brand-200">
                            <div class="w-10 h-10 rounded-full bg-brand-50 text-brand-600 flex-shrink-0 flex items-center justify-center font-bold">2</div>
                            <p class="text-slate-600 text-sm italic">Meningkatkan layanan peminjaman dan pengembalian buku yang cepat, tepat, dan mudah diakses.</p>
                        </div>
                        <div class="flex gap-4 p-5 rounded-2xl bg-white border border-slate-100 shadow-sm transition-all hover:border-brand-200">
                            <div class="w-10 h-10 rounded-full bg-brand-50 text-brand-600 flex-shrink-0 flex items-center justify-center font-bold">3</div>
                            <p class="text-slate-600 text-sm italic">Mengembangkan budaya literasi dan minat baca di lingkungan sekolah melalui fasilitas yang memadai.</p>
                        </div>
                        <div class="flex gap-4 p-5 rounded-2xl bg-white border border-slate-100 shadow-sm transition-all hover:border-brand-200">
                            <div class="w-10 h-10 rounded-full bg-brand-50 text-brand-600 flex-shrink-0 flex items-center justify-center font-bold">4</div>
                            <p class="text-slate-600 text-sm italic">Menciptakan lingkungan perpustakaan yang nyaman dan edukatif guna menunjang kegiatan belajar mandiri.</p>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Right Column: Visual/Details -->
            <div class="space-y-8 fade-in-up delay-300">
                <div class="bg-white p-1 rounded-[2rem] shadow-2xl overflow-hidden">
                    <img src="{{ asset('images/bg.jpeg') }}" class="w-full h-96 object-cover rounded-[1.8rem]" alt="Library Indoor">
                </div>
                
                <div class="bg-brand-900 p-8 rounded-[2rem] text-white">
                    <h4 class="text-xl font-bold mb-6 italic">Informasi Kontak</h4>
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center text-brand-300">
                                <i class="fas fa-map-marked-alt"></i>
                            </div>
                            <div>
                                <p class="text-xs text-brand-300 uppercase font-bold tracking-widest mb-1">Alamat</p>
                                <p class="text-sm leading-relaxed">Jl. Pagaden Ciburuyan Nusawangi, Kec. Kawalu, Kota Tasikmalaya, Jawa Barat.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center text-brand-300">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div>
                                <p class="text-xs text-brand-300 uppercase font-bold tracking-widest mb-1">Penanggung Jawab</p>
                                <p class="text-sm">Bapak Nurdin (Operator Sekolah)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <footer class="bg-white border-t border-slate-100 py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-slate-400 text-sm">{{ date('Y') }} PerManah - Perpustakaan MA Nurul Hikmah.</p>
        </div>
    </footer>

</body>
</html>
