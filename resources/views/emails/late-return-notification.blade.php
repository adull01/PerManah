<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keterlambatan Pengembalian Buku</title>
</head>
<body>
    <h2>Halo, {{ $user->name }}</h2>
    <p>Anda terlambat mengembalikan buku berikut:</p>
    <ul>
        <li><strong>Judul Buku:</strong> {{ $borrowing->book->title ?? '-' }}</li>
        <li><strong>Tanggal Pinjam:</strong> {{ $borrowing->borrow_date }}</li>
        <li><strong>Jatuh Tempo:</strong> {{ $borrowing->due_date }}</li>
        <li><strong>Hari Terlambat:</strong> {{ \Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($borrowing->due_date)) }}</li>
        <li><strong>Denda:</strong> Rp{{ number_format($borrowing->late_fee, 0, ',', '.') }}</li>
    </ul>
    <p>Segera kembalikan buku ke perpustakaan dan lunasi denda sesuai ketentuan.</p>
    <p>Terima kasih.</p>
</body>
</html>
