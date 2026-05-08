<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Portal - PerManah</title>
    
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        .login-bg {
            background: radial-gradient(circle at top right, #ede9fe, transparent),
                        radial-gradient(circle at bottom left, #f5f3ff, transparent);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body class="font-sans antialiased text-slate-600 login-bg min-h-screen flex items-center justify-center p-4">

    <div class="max-w-5xl w-full flex flex-col md:flex-row glass-card rounded-3xl overflow-hidden shadow-2xl border border-white/50">
        
        <!-- Left Side - Visual & Info -->
        <div class="hidden md:flex md:w-1/2 bg-gradient-to-br from-brand-600 to-brand-800 p-12 text-white flex-col justify-between relative overflow-hidden">
            <!-- Decorative circle -->
            <div class="absolute -top-20 -left-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-brand-400/20 rounded-full blur-3xl"></div>
            
            <div class="relative z-10">
                <a href="{{ route('landing') }}" class="flex items-center gap-2 mb-12 group">
                    <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center backdrop-blur-md group-hover:bg-white/30 transition-all">
                        <i class="fas fa-arrow-left text-sm"></i>
                    </div>
                    <span class="text-sm font-bold uppercase tracking-widest opacity-80 group-hover:opacity-100 italic transition-opacity">Kembali</span>
                </a>

                <div class="mb-8">
                    <div class="w-16 h-16 rounded-2xl bg-white shadow-xl flex items-center justify-center mb-6">
                        <img src="{{ asset('logo-MA.png') }}" alt="Logo MA" class="w-12 h-12 object-contain">
                    </div>
                    <h2 class="text-4xl font-extrabold leading-tight mb-4 tracking-tight">Portal Akses<br>PerManah</h2>
                    <p class="text-brand-100 text-lg leading-relaxed">Satu pintu untuk semua layanan literasi. Masuk untuk mengakses katalog, peminjaman, dan laporan Anda.</p>
                </div>

                <ul class="space-y-4">
                    <li class="flex items-center gap-3">
                        <div class="w-6 h-6 rounded-full bg-emerald-400/20 flex items-center justify-center text-emerald-400">
                            <i class="fas fa-check text-[10px]"></i>
                        </div>
                        <span class="text-sm font-medium">Akses Katalog Digital Lengkap</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <div class="w-6 h-6 rounded-full bg-emerald-400/20 flex items-center justify-center text-emerald-400">
                            <i class="fas fa-check text-[10px]"></i>
                        </div>
                        <span class="text-sm font-medium">Kelola Peminjaman Real-time</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <div class="w-6 h-6 rounded-full bg-emerald-400/20 flex items-center justify-center text-emerald-400">
                            <i class="fas fa-check text-[10px]"></i>
                        </div>
                        <span class="text-sm font-medium">Laporan Aktivitas & Riwayat</span>
                    </li>
                </ul>
            </div>

            <div class="relative z-10 pt-10 border-t border-white/10">
                <p class="text-xs font-semibold text-brand-200 uppercase tracking-widest text-center">© {{ date('Y') }} Ma Nurul Hikmah</p>
            </div>
        </div>

        <!-- Right Side - Form -->
        <div class="w-full md:w-1/2 p-8 md:p-16 bg-white/40">
            <div class="max-w-md mx-auto h-full flex flex-col justify-center">
                <!-- Mobile Logo (only visible on mobile) -->
                <div class="md:hidden flex flex-col items-center mb-8">
                    <div class="w-14 h-14 rounded-2xl bg-white flex items-center justify-center mb-4 shadow-xl border border-slate-100">
                        <img src="{{ asset('logo-MA.png') }}" alt="Logo MA" class="w-10 h-10 object-contain">
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900">Portal PerManah</h2>
                </div>

                <div class="mb-10 text-center md:text-left">
                    <h3 class="text-3xl font-extrabold text-slate-900 mb-2">Selamat Datang</h3>
                    <p class="text-slate-500">Silakan masukkan akun Anda untuk masuk ke sistem.</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-100 text-red-600 text-sm flex gap-3 animate-pulse">
                        <i class="fas fa-exclamation-circle mt-0.5"></i>
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-600 text-sm flex gap-3">
                        <i class="fas fa-check-circle mt-0.5"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-700 mb-2 tracking-wide uppercase italic">Alamat Email</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-600 transition-colors">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <input type="email" name="email" id="email" 
                                class="block w-full pl-11 pr-4 py-4 rounded-xl bg-white border border-slate-200 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all shadow-sm"
                                placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label for="password" class="block text-sm font-bold text-slate-700 tracking-wide uppercase italic">Kata Sandi</label>
                            {{-- <a href="#" class="text-xs font-bold text-brand-600 hover:text-brand-700">Lupa Password?</a> --}}
                        </div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-600 transition-colors">
                                <i class="fas fa-lock"></i>
                            </div>
                            <input type="password" name="password" id="password" 
                                class="block w-full pl-11 pr-4 py-4 rounded-xl bg-white border border-slate-200 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all shadow-sm"
                                placeholder="••••••••" required>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="w-4 h-4 text-brand-600 border-slate-300 rounded focus:ring-brand-500">
                        <label for="remember" class="ml-2 text-sm text-slate-500 font-medium cursor-pointer">Ingat saya untuk sesi berikutnya</label>
                    </div>

                    <button type="submit" class="w-full py-4 bg-brand-600 text-white font-bold rounded-xl shadow-lg shadow-brand-500/30 hover:bg-brand-700 hover:shadow-brand-500/50 hover:-translate-y-0.5 transition-all text-lg flex items-center justify-center gap-3">
                        Masuk Sekarang <i class="fas fa-sign-in-alt"></i>
                    </button>
                </form>

                <div class="mt-10 pt-8 border-t border-slate-200 text-center">
                    <p class="text-slate-500 mb-4">Belum memiliki akun anggota?</p>
                    <a href="{{ route('anggota.register') }}" class="inline-block px-6 py-3 rounded-xl border-2 border-slate-200 text-slate-700 font-bold hover:bg-slate-50 hover:border-brand-300 hover:text-brand-600 transition-all">
                        Daftar Sebagai Anggota Baru
                    </a>
                </div>
                
                <div class="mt-6 md:hidden text-center">
                    <a href="{{ route('landing') }}" class="text-slate-500 font-bold text-sm hover:text-brand-600">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if(session('show_pending_modal'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'info',
                title: 'Pendaftaran Berhasil!',
                html: `
                    <div class="text-left space-y-4">
                        <p class="text-slate-600 leading-relaxed">Akun <strong>{{ session('pending_email') }}</strong> telah terdaftar dan saat ini sedang dalam <strong>tahap verifikasi</strong> oleh petugas kami.</p>
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-100 italic text-sm text-slate-500">
                            Silakan tunggu email konfirmasi persetujuan akun Anda sebelum dapat melakukan login.
                        </div>
                    </div>
                `,
                confirmButtonText: 'Tutup & Tunggu',
                confirmButtonColor: '#8b5cf6',
                customClass: {
                    container: 'font-sans',
                    popup: 'rounded-3xl p-8',
                    confirmButton: 'px-8 py-3 rounded-xl font-bold'
                }
            });
        });
    </script>
    @endif
</body>
</html>
