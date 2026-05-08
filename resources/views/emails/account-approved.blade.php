<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Anda Telah Disetujui</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
        }
        .info-box {
            background-color: #f0fdf4;
            border-left: 4px solid #10b981;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .info-box h3 {
            margin-top: 0;
            color: #059669;
        }
        .info-box p {
            margin: 10px 0;
            color: #333;
        }
        .credentials-box {
            background-color: #f3f4f6;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
        }
        .credential-item {
            margin: 12px 0;
            padding: 10px;
            background-color: white;
            border-radius: 4px;
        }
        .credential-label {
            font-weight: 600;
            color: #059669;
            font-size: 12px;
            text-transform: uppercase;
        }
        .credential-value {
            color: #333;
            font-size: 14px;
            word-break: break-all;
        }
        .footer {
            background-color: #f9fafb;
            padding: 20px 30px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
            color: #666;
            font-size: 12px;
        }
        .button {
            display: inline-block;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 4px;
            margin: 20px 0;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>🎉 Akun Anda Telah Disetujui</h1>
            <p>Selamat datang di PerManah</p>
        </div>

        <div class="content">
            <div class="greeting">
                Hai {{ $user->name }},
            </div>

            <p>
                Kami dengan senang hati mengumumkan bahwa akun Anda telah berhasil diverifikasi dan disetujui oleh petugas. 
                Anda sekarang bisa mengakses semua fitur di platform kami!
            </p>

            <div class="info-box">
                <h3>✓ Verifikasi Berhasil</h3>
                <p>Akun Anda telah diterima dan siap digunakan. Anda sekarang bisa login dan mulai meminjam buku dari koleksi kami yang lengkap.</p>
            </div>

            <h3 style="color: #059669; margin-top: 30px;">Detail Login Anda</h3>
            <div class="credentials-box">
                <div class="credential-item">
                    <div class="credential-label">Email</div>
                    <div class="credential-value">{{ $user->email }}</div>
                </div>
                <div class="credential-item">
                    <div class="credential-label">Password</div>
                    <div class="credential-value">{{ $password }}</div>
                </div>
            </div>

            <h3 style="color: #059669;">Langkah Selanjutnya</h3>
            <ol>
                <li>Login ke akun Anda menggunakan email dan password yang tersedia di atas</li>
                <li>Perbarui data profil Anda jika diperlukan</li>
                <li>Mulai jelajahi koleksi buku kami dan pinjam buku favorit Anda</li>
            </ol>

            <center>
                <a href="{{ url('/anggota/login') }}" class="button">Login Sekarang</a>
            </center>

            <p style="color: #666; font-size: 14px;">
                Jika Anda memiliki pertanyaan atau memerlukan bantuan, jangan ragu untuk menghubungi petugas kami.
            </p>
        </div>

        <div class="footer">
            <p>PerManah - Perpustakaan Digital</p>
            <p style="margin-top: 0;">Email ini dikirim secara otomatis. Mohon tidak membalas email ini.</p>
        </div>
    </div>
</body>
</html>
