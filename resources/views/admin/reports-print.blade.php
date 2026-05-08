@php
    use Carbon\Carbon;
@endphp
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Laporan Peminjaman - {{ Carbon::parse($month)->format('F Y') }}</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; color: #111827; margin: 20px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 24px; }
        .header p { margin: 0; color: #6b7280; }
        .stats { display: flex; gap: 20px; margin: 20px 0; }
        .stat { padding: 10px 15px; border: 1px solid #e5e7eb; border-radius: 6px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #e5e7eb; padding: 8px 10px; text-align: left; font-size: 12px; }
        th { background: #f3f4f6; }
        .center { text-align: center; }
        .muted { color: #6b7280; font-size: 12px; }
        @media print {
            a { display: none; }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>PerManah - Laporan Peminjaman</h1>
        <p>Bulan: {{ Carbon::parse($month)->format('F Y') }}</p>
        <p class="muted">Dicetak: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    @php
        $totalDenda = $borrowings->sum(function ($b) {
            return ($b->is_lost ?? false)
                ? ($b->replacement_fee ?? 0)
                : (($b->late_fee ?? 0) + ($b->replacement_fee ?? 0));
        });
    @endphp
    <div class="stats">
        <div class="stat">
            <strong>Total Peminjaman</strong>
            <div>{{ $borrowings->count() }}</div>
        </div>
        <div class="stat">
            <strong>Sudah Dikembalikan</strong>
            <div>{{ $borrowings->where('status', 'returned')->count() }}</div>
        </div>
        <div class="stat">
            <strong>Masih Dipinjam</strong>
            <div>{{ $borrowings->where('status', 'approved')->count() }}</div>
        </div>
        <div class="stat">
            <strong>Ditolak</strong>
            <div>{{ $borrowings->where('status', 'rejected')->count() }}</div>
        </div>
        <div class="stat">
            <strong>Total Denda (Rp)</strong>
            <div>{{ number_format($totalDenda, 0, ',', '.') }}</div>
        </div>
    </div>

    <h3>Buku Paling Sering Dipinjam</h3>
    <table>
        <thead>
            <tr>
                <th style="width:40px">No</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th style="width:120px">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mostBorrowedBooks as $book)
            <tr>
                <td class="center">{{ $loop->iteration }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td class="center">{{ $book->borrowings_count }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="center muted">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <h3 style="margin-top:20px">Detail Peminjaman</h3>
    <table>
        <thead>
            <tr>
                <th style="width:40px">No</th>
                <th>Peminjam</th>
                <th>Buku</th>
                <th style="width:110px">Tanggal Pinjam</th>
                <th style="width:110px">Jatuh Tempo</th>
                <th style="width:110px">Tanggal Kembali</th>
                <th style="width:100px">Status</th>
                <th style="width:120px; text-align: right;">Denda (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($borrowings as $borrowing)
            <tr>
                <td class="center">{{ $loop->iteration }}</td>
                <td>{{ $borrowing->user->name }} <div class="muted">{{ $borrowing->user->email }}</div></td>
                <td>{{ $borrowing->book->title }} <div class="muted">{{ $borrowing->book->author }}</div></td>
                <td class="center">{{ $borrowing->borrow_date->format('d/m/Y') }}</td>
                <td class="center">{{ $borrowing->due_date->format('d/m/Y') }}</td>
                <td class="center">{{ $borrowing->return_date ? $borrowing->return_date->format('d/m/Y') : '-' }}</td>
                <td class="center">{{ $borrowing->is_lost ? 'Hilang' : ucfirst($borrowing->status) }}</td>
                <td class="center">@php $fee = ($borrowing->is_lost ?? false) ? ($borrowing->replacement_fee ?? 0) : (($borrowing->late_fee ?? 0) + ($borrowing->replacement_fee ?? 0)); @endphp {{ $fee > 0 ? number_format($fee,0,',','.') : '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="center muted">Tidak ada data peminjaman</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <script>
        window.addEventListener('load', function(){
            setTimeout(function(){ window.print(); }, 300);
        });
    </script>
</body>
</html>
