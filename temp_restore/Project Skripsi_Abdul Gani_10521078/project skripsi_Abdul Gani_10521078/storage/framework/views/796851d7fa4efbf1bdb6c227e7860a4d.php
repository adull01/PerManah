<?php $__env->startSection('title', 'Laporan Peminjaman'); ?>
<?php $__env->startSection('page-title', 'Laporan Peminjaman'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .filter-card {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        margin-bottom: 25px;
    }

    .filter-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
        font-size: 1.1rem;
        font-weight: 700;
        color: #1e293b;
    }

    .filter-header i {
        color: #8b5cf6;
    }

    .form-control-modern {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 12px 15px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .form-control-modern:focus {
        outline: none;
        border-color: #8b5cf6;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
    }

    .btn-filter {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(139, 92, 246, 0.3);
        color: white;
    }

    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 25px;
    }

    .stat-box {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .stat-box:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }

    .stat-box-label {
        color: #64748b;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .stat-box-value {
        font-size: 2rem;
        font-weight: 800;
        color: #1e293b;
    }

    .data-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        margin-bottom: 25px;
    }

    .data-card-header {
        padding: 20px 25px;
        border-bottom: 1px solid #e2e8f0;
    }

    .data-card-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .data-card-title i {
        color: #8b5cf6;
    }

    .table-modern {
        width: 100%;
        margin: 0;
    }

    .table-modern thead {
        background: #f8fafc;
    }

    .table-modern thead th {
        padding: 15px 20px;
        font-size: 0.85rem;
        font-weight: 700;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e2e8f0;
    }

    .table-modern tbody tr {
        transition: all 0.2s ease;
    }

    .table-modern tbody tr:hover {
        background: #f8fafc;
    }

    .table-modern tbody td {
        padding: 15px 20px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.9rem;
        color: #334155;
    }

    .badge-status {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
    }

    .badge-pending {
        background: #fef3c7;
        color: #92400e;
    }

    .badge-approved {
        background: #dbeafe;
        color: #1e40af;
    }

    .badge-returned {
        background: #ede9fe;
        color: #5b21b6;
    }

    .badge-rejected {
        background: #fee2e2;
        color: #991b1b;
    }

    .badge-count {
        background: #e0e7ff;
        color: #4338ca;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 700;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #64748b;
    }

    .empty-state i {
        font-size: 3rem;
        color: #cbd5e1;
        margin-bottom: 15px;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="breadcrumb-custom" style="margin-bottom: 25px;">
    <a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fas fa-home"></i> Dashboard</a>
    <span>/</span>
    <span>Laporan Peminjaman</span>
</div>

<!-- Filter Card -->
<div class="filter-card">
    <div class="filter-header">
        <i class="fas fa-filter"></i>
        Filter Laporan
    </div>
    <form action="<?php echo e(route('admin.reports')); ?>" method="GET" class="row g-3 align-items-end">
        <div class="col-md-3">
            <label class="form-label" style="font-weight: 600; color: #334155; margin-bottom: 8px;">Pilih Bulan</label>
            <input type="month" name="month" class="form-control-modern w-100" value="<?php echo e($month); ?>">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn-filter w-100">
                <i class="fas fa-search"></i> Filter
            </button>
        </div>
        <div class="col-md-7">
            <div class="d-flex flex-wrap justify-content-end gap-2">
                <a href="<?php echo e(route('admin.reports.print', ['month' => $month])); ?>" target="_blank" class="btn-filter" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                    <i class="fas fa-print"></i> Cetak Laporan
                </a>
                <a href="<?php echo e(route('admin.reports.pdf', ['month' => $month])); ?>" class="btn-filter" style="background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);" target="_blank">
                    <i class="fas fa-file-pdf"></i> Ekspor PDF
                </a>
                <a href="<?php echo e(route('admin.reports.fees', ['month' => $month])); ?>" class="btn-filter" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                    <i class="fas fa-coins"></i> Laporan Denda
                </a>
            </div>
        </div>
    </form>
</div>

<!-- Stats Row -->
<div class="stats-row">
    <div class="stat-box" style="border-left: 4px solid #3b82f6;">
        <div class="stat-box-label">Total Peminjaman</div>
        <div class="stat-box-value"><?php echo e($borrowings->count()); ?></div>
    </div>
    <div class="stat-box" style="border-left: 4px solid #8b5cf6;">
        <div class="stat-box-label">Sudah Dikembalikan</div>
        <div class="stat-box-value"><?php echo e($borrowings->where('status', 'returned')->count()); ?></div>
    </div>
    <div class="stat-box" style="border-left: 4px solid #f59e0b;">
        <div class="stat-box-label">Masih Dipinjam</div>
        <div class="stat-box-value"><?php echo e($borrowings->where('status', 'approved')->count()); ?></div>
    </div>
    <div class="stat-box" style="border-left: 4px solid #ef4444;">
        <div class="stat-box-label">Ditolak</div>
        <div class="stat-box-value"><?php echo e($borrowings->where('status', 'rejected')->count()); ?></div>
    </div>
    <div class="stat-box" style="border-left: 4px solid #ef3b3b;">
        <div class="stat-box-label">Total Denda (Rp)</div>
        <div class="stat-box-value"><?php echo e(number_format($borrowings->sum('late_fee') + $borrowings->sum('replacement_fee'), 0, ',', '.')); ?></div>
    </div>
</div>

<!-- Most Borrowed Books -->
<div class="data-card">
    <div class="data-card-header">
        <div class="data-card-title">
            <i class="fas fa-chart-bar"></i>
            Buku Paling Sering Dipinjam
        </div>
    </div>
    <div class="table-responsive">
        <table class="table-modern">
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th style="width: 180px; text-align: center;">Jumlah Peminjaman</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $mostBorrowedBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><strong><?php echo e($book->title); ?></strong></td>
                    <td><?php echo e($book->author); ?></td>
                    <td style="text-align: center;">
                        <span class="badge-count"><?php echo e($book->borrowings_count); ?>x</span>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="4">
                        <div class="empty-state">
                            <i class="fas fa-chart-bar"></i>
                            <p>Tidak ada data</p>
                        </div>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Detail Peminjaman -->
<div class="data-card">
    <div class="data-card-header">
        <div class="data-card-title">
            <i class="fas fa-list"></i>
            Detail Peminjaman Bulan <?php echo e(\Carbon\Carbon::parse($month)->format('F Y')); ?>

        </div>
    </div>
    <div class="table-responsive">
        <table class="table-modern">
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Peminjam</th>
                    <th>Buku</th>
                    <th style="width: 130px;">Tanggal Pinjam</th>
                    <th style="width: 130px;">Jatuh Tempo</th>
                    <th style="width: 130px;">Tanggal Kembali</th>
                    <th style="width: 140px; text-align: center;">Status</th>
                    <th style="width: 120px; text-align: right;">Denda (Rp)</th>
                    <th>Diproses Oleh</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $borrowings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $borrowing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td>
                        <strong><?php echo e($borrowing->user->name); ?></strong><br>
                        <small style="color: #64748b;"><?php echo e($borrowing->user->email); ?></small>
                    </td>
                    <td>
                        <strong><?php echo e($borrowing->book->title); ?></strong><br>
                        <small style="color: #64748b;"><?php echo e($borrowing->book->author); ?></small>
                    </td>
                    <td>
                        <i class="fas fa-calendar-alt" style="color: #64748b;"></i>
                        <?php echo e($borrowing->borrow_date->format('d/m/Y')); ?>

                    </td>
                    <td>
                        <i class="fas fa-clock" style="color: #f59e0b;"></i>
                        <?php echo e($borrowing->due_date->format('d/m/Y')); ?>

                    </td>
                    <td>
                        <?php if($borrowing->return_date): ?>
                            <i class="fas fa-check-circle" style="color: #8b5cf6;"></i>
                            <?php echo e($borrowing->return_date->format('d/m/Y')); ?>

                        <?php else: ?>
                            <span style="color: #94a3b8;">-</span>
                        <?php endif; ?>
                    </td>
                    <td style="text-align: center;">
                        <?php if($borrowing->status == 'pending'): ?>
                            <span class="badge-status badge-pending">
                                <i class="fas fa-hourglass-half"></i> Pending
                            </span>
                        <?php elseif($borrowing->status == 'approved'): ?>
                            <span class="badge-status badge-approved">
                                <i class="fas fa-book-reader"></i> Dipinjam
                            </span>
                        <?php elseif($borrowing->status == 'returned'): ?>
                            <span class="badge-status badge-returned">
                                <i class="fas fa-check-circle"></i> Dikembalikan
                            </span>
                        <?php else: ?>
                            <span class="badge-status badge-rejected">
                                <i class="fas fa-times-circle"></i> Ditolak
                            </span>
                        <?php endif; ?>
                    </td>
                    <td style="text-align: right;">
                        <?php
                            $lateFee = $borrowing->late_fee ?? 0;
                            $daysLate = 0;
                            $rate = 2000;
                            
                            if ($borrowing->return_date) {
                                if ($borrowing->due_date->lt($borrowing->return_date)) {
                                     $daysLate = $borrowing->due_date->startOfDay()->diffInDays($borrowing->return_date->startOfDay());
                                }
                            } else {
                                if ($borrowing->due_date->lt(now())) {
                                    $daysLate = $borrowing->due_date->startOfDay()->diffInDays(now()->startOfDay());
                                }
                            }
                            
                            if (!$borrowing->return_date && $daysLate > 0) {
                                $lateFee = $daysLate * $rate;
                            }

                            $totalFee = $lateFee + ($borrowing->replacement_fee ?? 0);
                        ?>
                        <?php echo e($totalFee > 0 ? number_format($totalFee, 0, ',', '.') : '-'); ?>

                        <?php if($daysLate > 0): ?>
                            <br>
                            <small class="text-danger" style="font-size: 0.75rem;">
                                (<?php echo e($daysLate); ?> hari x Rp <?php echo e(number_format($rate, 0, ',', '.')); ?>)
                            </small>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($borrowing->processedBy): ?>
                            <strong><?php echo e($borrowing->processedBy->name); ?></strong><br>
                            <small style="color: #64748b;"><?php echo e(ucfirst($borrowing->processedBy->role)); ?></small>
                        <?php else: ?>
                            <span style="color: #94a3b8;">-</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8">
                        <div class="empty-state">
                            <i class="fas fa-inbox"></i>
                            <p>Tidak ada data peminjaman</p>
                        </div>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const monthInput = document.querySelector('input[name="month"]');
        const actionLinks = document.querySelectorAll('.d-flex.justify-content-end a');

        function updateUrls() {
            const selectedMonth = monthInput.value;
            actionLinks.forEach(link => {
                const url = new URL(link.href);
                url.searchParams.set('month', selectedMonth);
                link.href = url.toString();
            });
        }

        if (monthInput) {
            monthInput.addEventListener('change', updateUrls);
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Skripsi\skripsi\resources\views/admin/reports.blade.php ENDPATH**/ ?>