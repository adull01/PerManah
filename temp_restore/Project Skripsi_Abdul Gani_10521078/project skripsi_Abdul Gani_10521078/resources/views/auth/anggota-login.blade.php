<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Anggota - Perpustakaan Digital</title>
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
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 20px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
        }

        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            min-height: 600px;
        }

        .login-left {
            flex: 1;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="50" height="50" patternUnits="userSpaceOnUse"><path d="M 50 0 L 0 0 0 50" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
        }

        .login-left-content {
            position: relative;
            z-index: 1;
        }

        .login-icon {
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
            backdrop-filter: blur(10px);
        }

        .login-icon i {
            font-size: 3.5rem;
            color: white;
        }

        .login-left h2 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 15px;
            line-height: 1.2;
        }

        .login-left .role-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 25px;
            backdrop-filter: blur(10px);
        }

        .login-left p {
            font-size: 1.1rem;
            line-height: 1.7;
            opacity: 0.95;
            margin-bottom: 30px;
        }

        .login-features {
            list-style: none;
            padding: 0;
        }

        .login-features li {
            padding: 12px 0;
            display: flex;
            align-items: center;
            font-size: 0.95rem;
            opacity: 0.9;
        }

        .login-features li i {
            margin-right: 12px;
            font-size: 1.1rem;
        }

        .login-right {
            flex: 1;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-header {
            margin-bottom: 40px;
        }

        .login-header h3 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 10px;
        }

        .login-header p {
            color: #64748b;
            font-size: 0.95rem;
        }

        .form-label {
            font-weight: 600;
            color: #334155;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            z-index: 10;
        }

        .input-group .form-control {
            padding-left: 45px;
        }

        .btn-login {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            width: 100%;
            margin-top: 10px;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
            color: white;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        .register-link p {
            color: #64748b;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .register-link a {
            color: #10b981;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .back-link {
            text-align: center;
            margin-top: 15px;
        }

        .back-link a {
            color: #64748b;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s ease;
        }

        .back-link a:hover {
            color: #10b981;
        }

        .alert {
            border-radius: 10px;
            border: none;
            padding: 12px 15px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                min-height: auto;
            }

            .login-left {
                padding: 40px 30px;
            }

            .login-left h2 {
                font-size: 2rem;
            }

            .login-right {
                padding: 40px 30px;
            }

            .login-features {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-container">
            <!-- Left Side - Branding -->
            <div class="login-left">
                <div class="login-left-content">
                    <div class="login-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <span class="role-badge">Anggota Perpustakaan</span>
                    <h2>Portal Anggota</h2>
                    <p>
                        Akses katalog buku lengkap dan pinjam buku favorit Anda dengan mudah
                    </p>
                    <ul class="login-features">
                        <li><i class="fas fa-check-circle"></i> Browse katalog buku lengkap</li>
                        <li><i class="fas fa-check-circle"></i> Request peminjaman online</li>
                        <li><i class="fas fa-check-circle"></i> Lihat riwayat peminjaman</li>
                        <li><i class="fas fa-check-circle"></i> Cek status pengembalian</li>
                    </ul>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="login-right">
                <div class="login-header">
                    <h3>Selamat Datang Kembali!</h3>
                    <p>Masuk ke akun Anda untuk mulai meminjam buku</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('anggota.login') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label">Email</label>
                        <div class="input-group">
                            <i class="fas fa-envelope input-icon"></i>
                            <input type="email" name="email" class="form-control" placeholder="anggota@email.com" value="{{ old('email') }}" required autofocus>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-login">
                        <i class="fas fa-sign-in-alt"></i> Masuk ke Dashboard
                    </button>
                </form>

                <div class="register-link">
                    <p>Belum punya akun?</p>
                    <a href="{{ route('anggota.register') }}">
                        <i class="fas fa-user-plus"></i> Daftar Sebagai Anggota Baru
                    </a>
                </div>

                <div class="back-link">
                    <a href="{{ route('landing') }}">
                        <i class="fas fa-arrow-left"></i> Kembali ke Halaman Utama
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Notifikasi Akun Pending - REMOVED, menggunakan Sweet Alert -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sweet Alert untuk notifikasi pending account
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('show_pending_modal'))
                const pendingEmail = "{{ session('pending_email') }}";
                Swal.fire({
                    icon: 'info',
                    title: 'Akun Sedang Ditinjau',
                    html: `<div class="text-start">
                        <p><strong>Terima kasih telah melakukan pendaftaran!</strong></p>
                        <p>Akun Anda telah berhasil dibuat dan sedang dalam proses peninjauan oleh petugas.</p>
                        <hr>
                        <p class="mb-2"><strong>📧 Email Terdaftar:</strong></p>
                        <p class="text-muted mb-3">${pendingEmail}</p>
                        <p><strong>Langkah selanjutnya:</strong></p>
                        <ul class="text-start">
                            <li>Tunggu email konfirmasi dari petugas (biasanya dalam 1-2 hari kerja)</li>
                            <li>Email tersebut akan berisi informasi lengkap akun dan cara login Anda</li>
                            <li>Setelah akun disetujui, Anda bisa langsung login dan mulai meminjam buku</li>
                        </ul>
                    </div>`,
                    confirmButtonColor: '#10b981',
                    confirmButtonText: 'Saya Mengerti',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                });
            @endif
        });
    </script>
</body>
</html>
