<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pendaftaran</title>
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
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
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
            background-color: #fee2e2;
            border-left: 4px solid #ef4444;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .info-box h3 {
            margin-top: 0;
            color: #dc2626;
        }
        .info-box p {
            margin: 10px 0;
            color: #7f1d1d;
        }
        .details-box {
            background-color: #f3f4f6;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .detail-item {
            margin: 12px 0;
            padding: 10px;
            background-color: white;
            border-radius: 4px;
        }
        .detail-label {
            font-weight: 600;
            color: #dc2626;
            font-size: 12px;
            text-transform: uppercase;
        }
        .detail-value {
            color: #333;
            font-size: 14px;
            word-break: break-word;
            margin-top: 5px;
        }
        .footer {
            background-color: #f9fafb;
            padding: 20px 30px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
            color: #666;
            font-size: 12px;
        }
        .reason-section {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .reason-section h4 {
            margin-top: 0;
            color: #dc2626;
        }
        .reason-text {
            background-color: white;
            padding: 15px;
            border-radius: 4px;
            color: #333;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>⛔ Pendaftaran Ditolak</h1>
            <p>Status Akun Anda</p>
        </div>

        <div class="content">
            <div class="greeting">
                Hai {{ $user->name }},
            </div>

            <p>
                Kami telah meninjau aplikasi pendaftaran Anda untuk BookHive, namun sayangnya akun Anda tidak dapat disetujui pada saat ini.
            </p>

            <div class="info-box">
                <h3>✗ Pendaftaran Ditolak</h3>
                <p>Akun Anda telah ditinjau oleh petugas kami dan tidak memenuhi kriteria yang diperlukan untuk saat ini.</p>
            </div>

            <h3 style="color: #dc2626;">Detail Akun</h3>
            <div class="details-box">
                <div class="detail-item">
                    <div class="detail-label">Email</div>
                    <div class="detail-value">{{ $user->email }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Nama Lengkap</div>
                    <div class="detail-value">{{ $user->name }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">No. NISN</div>
                    <div class="detail-value">{{ $user->nisn ?? 'Tidak tersedia' }}</div>
                </div>
            </div>

            <div class="reason-section">
                <h4>Alasan Penolakan</h4>
                <div class="reason-text">
                    {{ $rejectionReason }}
                </div>
            </div>

            <h3 style="color: #dc2626;">Apa yang Bisa Anda Lakukan?</h3>
            <ul>
                <li>Periksa kembali informasi yang Anda berikan saat pendaftaran</li>
                <li>Pastikan semua dokumen (Foto KTM) jelas dan dapat dibaca</li>
                <li>Jika Anda merasa ada kesalahan, silakan hubungi petugas kami untuk informasi lebih lanjut</li>
                <li>Anda dapat mencoba mendaftar kembali dengan data yang lebih lengkap</li>
            </ul>

            <p style="color: #666; font-size: 14px;">
                Jika Anda memiliki pertanyaan tentang penolakan ini atau ingin mengajukan banding, 
                silakan hubungi petugas perpustakaan kami melalui email atau langsung ke kantor.
            </p>
        </div>

        <div class="footer">
            <p>PerManah - Perpustakaan Digital</p>
            <p style="margin-top: 0;">Email ini dikirim secara otomatis. Mohon tidak membalas email ini.</p>
        </div>
    </div>
</body>
</html>
