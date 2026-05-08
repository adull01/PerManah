<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Anggota - PerManah</title>
    
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
        .register-bg {
            background: radial-gradient(circle at top left, #ede9fe, transparent),
                        radial-gradient(circle at bottom right, #f5f3ff, transparent);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
        /* Custom scrollbar for form */
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }
    </style>
</head>
<body class="font-sans antialiased text-slate-600 register-bg min-h-screen flex items-center justify-center p-4">

    <div class="max-w-6xl w-full flex flex-col md:flex-row glass-card rounded-3xl overflow-hidden shadow-2xl border border-white/50">
        
        <!-- Left Side - Info -->
        <div class="hidden md:flex md:w-5/12 bg-gradient-to-br from-brand-600 to-brand-800 p-12 text-white flex-col justify-between relative overflow-hidden">
            <div class="absolute -top-20 -left-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            
            <div class="relative z-10">
                <a href="{{ route('login') }}" class="flex items-center gap-2 mb-12 group">
                    <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center backdrop-blur-md group-hover:bg-white/30 transition-all">
                        <i class="fas fa-arrow-left text-sm"></i>
                    </div>
                    <span class="text-sm font-bold uppercase tracking-widest opacity-80 group-hover:opacity-100 italic transition-opacity">Kembali ke Login</span>
                </a>

                <div class="mb-10">
                    <h2 class="text-4xl font-extrabold leading-tight mb-6 tracking-tight">Menjadi Bagian Dari Komunitas Kami</h2>
                    <p class="text-brand-100 text-lg leading-relaxed mb-10">Bergabunglah dengan ribuan pembaca lainnya dan nikmati akses penuh ke berbagai koleksi literatur kami.</p>
                </div>

                <div class="space-y-8">
                    <div class="flex gap-4">
                        <div class="w-12 h-12 rounded-xl bg-white/10 flex-shrink-0 flex items-center justify-center text-xl">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-white mb-1 tracking-wide">Data Terjamin</h4>
                            <p class="text-brand-200 text-sm">Privasi dan data Anda aman bersama sistem verifikasi kami.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-12 h-12 rounded-xl bg-white/10 flex-shrink-0 flex items-center justify-center text-xl">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-white mb-1 tracking-wide">Proses Cepat</h4>
                            <p class="text-brand-200 text-sm">Verifikasi akun manual oleh petugas dalam waktu singkat.</p>
                        </div>
                    </div>
                </div>
            </div>

            <p class="relative z-10 text-xs font-semibold text-brand-200 uppercase tracking-widest text-center mt-10">PerManah - MA Nurul Hikmah</p>
        </div>

        <!-- Right Side - Registration Form -->
        <div class="w-full md:w-7/12 bg-white/40 flex flex-col h-[85vh] md:h-auto overflow-hidden">
            <div class="overflow-y-auto custom-scrollbar p-8 md:p-14 flex-1">
                <div class="max-w-lg mx-auto">
                    <div class="mb-10">
                        <h3 class="text-3xl font-extrabold text-slate-900 mb-2">Pendaftaran Anggota</h3>
                        <p class="text-slate-500">Lengkapi formulir di bawah ini dengan data yang valid.</p>
                    </div>

                    @if ($errors->any())
                        <div class="mb-8 p-5 rounded-2xl bg-red-50 border border-red-100 text-red-600 text-sm">
                            <h4 class="font-bold mb-2 flex items-center gap-2">
                                <i class="fas fa-exclamation-circle"></i> Mohon perbaiki kesalahan berikut:
                            </h4>
                            <ul class="list-disc list-inside space-y-1 opacity-90">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('anggota.register.post') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        
                        <!-- Personal Info Group -->
                        <div class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-extrabold text-slate-700 mb-2 tracking-widest uppercase italic">Nama Lengkap *</label>
                                    <input type="text" name="name" class="w-full px-4 py-3.5 rounded-xl bg-white border border-slate-200 focus:ring-2 focus:ring-brand-500 outline-none transition-all shadow-sm" placeholder="Contoh: Abdul Gani" value="{{ old('name') }}" required>
                                </div>
                                <div>
                                    <label class="block text-xs font-extrabold text-slate-700 mb-2 tracking-widest uppercase italic">NISN / ID Identitas *</label>
                                    <input type="text" id="nisn" name="nisn" class="w-full px-4 py-3.5 rounded-xl bg-white border border-slate-200 focus:ring-2 focus:ring-brand-500 outline-none transition-all shadow-sm" placeholder="10 Digit Angka" value="{{ old('nisn') }}" maxlength="10" pattern="[0-9]{10}" inputmode="numeric" required>
                                    <small class="text-xs text-slate-500 mt-1 block">Hanya angka, tepat 10 digit</small>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-extrabold text-slate-700 mb-2 tracking-widest uppercase italic">Alamat Email *</label>
                                <input type="email" name="email" class="w-full px-4 py-3.5 rounded-xl bg-white border border-slate-200 focus:ring-2 focus:ring-brand-500 outline-none transition-all shadow-sm" placeholder="nama@email.com" value="{{ old('email') }}" required>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-extrabold text-slate-700 mb-2 tracking-widest uppercase italic">No. Telepon</label>
                                    <input type="text" id="phone" name="phone" class="w-full px-4 py-3.5 rounded-xl bg-white border border-slate-200 focus:ring-2 focus:ring-brand-500 outline-none transition-all shadow-sm" placeholder="08xxxxxxxxxx" value="{{ old('phone') }}" maxlength="13" pattern="[0-9]*" inputmode="numeric">
                                    <small class="text-xs text-slate-500 mt-1 block">Hanya angka, maksimal 13 digit</small>
                                </div>
                                <div>
                                    <label class="block text-xs font-extrabold text-slate-700 mb-2 tracking-widest uppercase italic">Unggah Identitas (KTM/Kartu Pelajar) *</label>
                                    <input type="file" name="ktm_photo" accept="image/*" class="w-full px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 transition-all shadow-sm" required>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-extrabold text-slate-700 mb-2 tracking-widest uppercase italic">Alamat Lengkap</label>
                                <textarea name="address" rows="2" class="w-full px-4 py-3.5 rounded-xl bg-white border border-slate-200 focus:ring-2 focus:ring-brand-500 outline-none transition-all shadow-sm resize-none" placeholder="Masukkan alamat lengkap rumah Anda">{{ old('address') }}</textarea>
                            </div>
                        </div>

                        <!-- Password Group -->
                        <div class="pt-4 border-t border-slate-200 space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-extrabold text-slate-700 mb-2 tracking-widest uppercase italic">Kata Sandi *</label>
                                    <input type="password" name="password" class="w-full px-4 py-3.5 rounded-xl bg-white border border-slate-200 focus:ring-2 focus:ring-brand-500 outline-none transition-all shadow-sm" placeholder="Minimal 8 karakter" required>
                                </div>
                                <div>
                                    <label class="block text-xs font-extrabold text-slate-700 mb-2 tracking-widest uppercase italic">Konfirmasi Sandi *</label>
                                    <input type="password" name="password_confirmation" class="w-full px-4 py-3.5 rounded-xl bg-white border border-slate-200 focus:ring-2 focus:ring-brand-500 outline-none transition-all shadow-sm" placeholder="Ulangi kata sandi" required>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 p-4 bg-brand-50/50 rounded-2xl border border-brand-100 mb-4">
                            <div class="w-5 h-5 rounded flex items-center justify-center bg-brand-600 text-white text-[10px]">
                                <i class="fas fa-info"></i>
                            </div>
                            <p class="text-xs text-brand-800 font-medium">Akun akan aktif setelah diverifikasi oleh petugas secara manual.</p>
                        </div>

                        <button type="submit" class="w-full py-4 bg-brand-600 text-white font-bold rounded-xl shadow-lg shadow-brand-500/30 hover:bg-brand-700 hover:shadow-brand-500/50 hover:-translate-y-1 transition-all text-lg tracking-wide">
                            Daftar Sekarang
                        </button>
                    </form>

                    <div class="mt-10 text-center">
                        <p class="text-slate-500 text-sm">Sudah terdaftar? <a href="{{ route('login') }}" class="font-bold text-brand-600 hover:text-brand-700">Masuk Portal</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Validasi NISN - Hanya angka, tepat 10 digit
        const nisnInput = document.getElementById('nisn');
        if (nisnInput) {
            nisnInput.addEventListener('input', function(e) {
                // Hapus semua karakter yang bukan angka
                this.value = this.value.replace(/[^0-9]/g, '');
                
                // Batasi maksimal 10 digit
                if (this.value.length > 10) {
                    this.value = this.value.slice(0, 10);
                }
            });

            // Mencegah input huruf dengan keyboard
            nisnInput.addEventListener('keypress', function(e) {
                // Hanya izinkan angka (0-9)
                if (e.which < 48 || e.which > 57) {
                    e.preventDefault();
                }
            });

            // Mencegah paste text yang bukan angka
            nisnInput.addEventListener('paste', function(e) {
                e.preventDefault();
                const pastedText = (e.clipboardData || window.clipboardData).getData('text');
                const numbersOnly = pastedText.replace(/[^0-9]/g, '').slice(0, 10);
                this.value = numbersOnly;
            });
        }

        // Validasi No. Telepon - Hanya angka, maksimal 13 digit
        const phoneInput = document.getElementById('phone');
        if (phoneInput) {
            phoneInput.addEventListener('input', function(e) {
                // Hapus semua karakter yang bukan angka
                this.value = this.value.replace(/[^0-9]/g, '');
                
                // Batasi maksimal 13 digit
                if (this.value.length > 13) {
                    this.value = this.value.slice(0, 13);
                }
            });

            // Mencegah input huruf dengan keyboard
            phoneInput.addEventListener('keypress', function(e) {
                // Hanya izinkan angka (0-9)
                if (e.which < 48 || e.which > 57) {
                    e.preventDefault();
                }
            });

            // Mencegah paste text yang bukan angka
            phoneInput.addEventListener('paste', function(e) {
                e.preventDefault();
                const pastedText = (e.clipboardData || window.clipboardData).getData('text');
                const numbersOnly = pastedText.replace(/[^0-9]/g, '').slice(0, 13);
                this.value = numbersOnly;
            });
        }
    </script>

</body>
</html>
