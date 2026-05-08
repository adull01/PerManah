@php
    use Carbon\Carbon;
@endphp
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Peminjaman - {{ Carbon::parse($month)->format('F Y') }}</title>
    <style>
        body { font-family: DejaVu Sans, Arial, sans-serif; color: #111827; font-size: 12px; }
        .header { text-align: center; margin-bottom: 10px; }
        .header h1 { margin: 0; font-size: 18px; }
        .muted { color: #6b7280; font-size: 11px; }
        .stats { display: flex; gap: 10px; margin: 8px 0 12px 0; }
        .stat { padding: 6px 8px; border: 1px solid #ddd; border-radius: 4px; }
        table { width: 100%; border-collapse: collapse; margin-top: 6px; }
        th, td { border: 1px solid #ddd; padding: 6px 8px; text-align: left; }
        th { background: #f3f4f6; }
    </style>
</head>
<body>
    <div class="header">
        <h1>PerManah - Laporan Peminjaman</h1>
        <div class="muted">Bulan: {{ Carbon::parse($month)->format('F Y') }} &nbsp;|&nbsp; Dicetak: {{ now()->format('d/m/Y H:i') }}</div>
    </div>

    <div class="stats">
        <div class="stat">Total: {{ $borrowings->count() }}</div>
        <div class="stat">Returned: {{ $borrowings->where('status','returned')->count() }}</div>
        <div class="stat">Active: {{ $borrowings->where('status','approved')->count() }}</div>
        <div class="stat">Rejected: {{ $borrowings->where('status','rejected')->count() }}</div>
        <div class="stat">Total Denda: {{ number_format($borrowings->sum('late_fee') + $borrowings->sum('replacement_fee'), 0, ',', '.') }}</div>
    </div>

    <h4 style="margin-bottom:6px">Buku Paling Sering Dipinjam</h4>
    <table>
        <thead>
            <tr>
                <th style="width:30px">No</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th style="width:70px">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mostBorrowedBooks as $book)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td class="center">{{ $book->borrowings_count }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="muted">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <h4 style="margin-top:10px;">Detail Peminjaman</h4>
    <table>
        <thead>
            <tr>
                <th style="width:30px">No</th>
                <th>Peminjam</th>
                <th>Buku</th>
                <th style="width:80px">Pinjam</th>
                <th style="width:80px">Due</th>
                <th style="width:80px">Kembali</th>
                <th style="width:70px">Status</th>
                <th style="width:90px">Denda (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($borrowings as $borrowing)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $borrowing->user->name }}<div class="muted">{{ $borrowing->user->email }}</div></td>
                <td>{{ $borrowing->book->title }}<div class="muted">{{ $borrowing->book->author }}</div></td>
                <td>{{ $borrowing->borrow_date->format('d/m/Y') }}</td>
                <td>{{ $borrowing->due_date->format('d/m/Y') }}</td>
                <td>{{ $borrowing->return_date ? $borrowing->return_date->format('d/m/Y') : '-' }}</td>
                <td>{{ ucfirst($borrowing->status) }}</td>
                <td>{{ number_format(($borrowing->late_fee ?? 0) + ($borrowing->replacement_fee ?? 0), 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="muted">Tidak ada data peminjaman</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
