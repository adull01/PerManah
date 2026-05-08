<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemberitahuan Keterlambatan Pengembalian</title>
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
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }
        .content {
            padding: 30px;
        }
        .greeting {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
        }
        .info-box {
            background-color: #fef2f2;
            border-left: 4px solid #ef4444;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .info-box h3 {
            margin-top: 0;
            color: #b91c1c;
            font-size: 18px;
        }
        .info-box p {
            margin: 10px 0;
            color: #7f1d1d;
        }
        .book-details {
            background-color: #f3f4f6;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .detail-row {
            display: flex;
            margin-bottom: 10px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 10px;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: 600;
            width: 140px;
            color: #4b5563;
        }
        .detail-value {
            color: #1f2937;
            font-weight: 500;
        }
        .footer {
            background-color: #f9fafb;
            padding: 20px 30px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
            color: #666;
            font-size: 12px;
        }
        .btn-action {
            display: inline-block;
            background-color: #ef4444;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 6px;
            margin-top: 20px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>⚠️ Keterlambatan Pengembalian Buku</h1>
        </div>

        <div class="content">
            <div class="greeting">
                Halo {{ $borrowing->user->name }},
            </div>

            <p>
                Kami ingin memberitahukan bahwa Anda memiliki buku pinjaman yang telah melewati batas waktu pengembalian (Jatuh Tempo).
            </p>

            <div class="info-box">
                <h3>Total Denda Saat Ini: Rp {{ number_format($lateFee, 0, ',', '.') }}</h3>
                <p>Terlambat {{ $daysLate }} hari (Denda Rp 2.000 / hari)</p>
            </div>

            <div class="book-details">
                <div class="detail-row">
                    <div class="detail-label">Judul Buku</div>
                    <div class="detail-value">{{ $borrowing->book->title }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Tanggal Pinjam</div>
                    <div class="detail-value">{{ \Carbon\Carbon::parse($borrowing->borrow_date)->format('d/m/Y') }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Jatuh Tempo</div>
                    <div class="detail-value" style="color: #dc2626;">{{ \Carbon\Carbon::parse($borrowing->due_date)->format('d/m/Y') }}</div>
                </div>
            </div>

            <p>
                Mohon segera mengembalikan buku tersebut ke perpustakaan untuk menghindari akumulasi denda yang lebih besar.
            </p>

            <center>
                <a href="{{ route('anggota.unreturned') }}" class="btn-action">Lihat Detail Peminjaman</a>
            </center>
        </div>

        <div class="footer">
            <p>PerManah - Perpustakaan Digital</p>
            <p>Email ini dikirim secara otomatis oleh sistem.</p>
        </div>
    </div>
</body>
</html>
