<?php $__env->startSection('title', 'Kelola Peminjaman'); ?>
<?php $__env->startSection('page-title', 'Kelola Peminjaman'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Page Header */
    .page-header-custom {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        border-radius: 16px;
        padding: 30px;
        color: white;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
    }

    .page-header-custom h2 {
        font-size: 1.8rem;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .page-breadcrumb {
        display: flex;
        gap: 8px;
        align-items: center;
        font-size: 0.9rem;
        opacity: 0.9;
    }

    .page-breadcrumb a {
        color: white;
        text-decoration: none;
    }

    .page-breadcrumb a:hover {
        text-decoration: underline;
    }

    /* Content Card */
    .content-card {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .content-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 25px;
        padding-bottom: 20px;
        border-bottom: 2px solid #e2e8f0;
    }

    .content-card-title {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 0;
    }

    .content-card-title i {
        color: #8b5cf6;
        font-size: 1.5rem;
    }

    .content-card-title h5 {
        margin: 0;
        font-size: 1.3rem;
        font-weight: 700;
        color: #1e293b;
    }

    /* Modern Table */
    .modern-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: 0.9rem;
    }

    .modern-table thead th {
        background: #f8fafc;
        color: #475569;
        font-weight: 700;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 15px 12px;
        border-bottom: 2px solid #e2e8f0;
        white-space: nowrap;
        text-align: left;
    }

    .modern-table tbody td {
        padding: 15px 12px;
        border-bottom: 1px solid #f1f5f9;
        color: #1e293b;
        vertical-align: middle;
    }

    .modern-table tbody tr:hover {
        background: #f8fafc;
    }

    .modern-table tbody tr.highlight {
        background: #fef3c7;
    }

    .modern-table tbody tr.highlight:hover {
        background: #fde68a;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 6px;
        flex-wrap: nowrap;
        align-items: center;
    }

    .btn-action {
        padding: 6px 12px;
        font-size: 0.75rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        white-space: nowrap;
        cursor: pointer;
        line-height: 1.4;
    }

    .btn-action:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.18);
    }

    .btn-action i {
        font-size: 0.75rem;
    }

    .btn-approve {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }

    .btn-approve:hover {
        box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4);
    }

    .btn-reject {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }

    .btn-reject:hover {
        box-shadow: 0 6px 16px rgba(239, 68, 68, 0.4);
    }

    .btn-return {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: white;
    }

    .btn-return:hover {
        box-shadow: 0 6px 16px rgba(139, 92, 246, 0.4);
    }

    /* Badge Styles */
    .badge-custom {
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .badge-new {
        background: #fef3c7;
        color: #92400e;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }

    /* Status Badge Consistency */
    .modern-table .badge {
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.75rem;
        line-height: 1.4;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state i {
        font-size: 4rem;
        color: #cbd5e1;
        margin-bottom: 20px;
    }

    .empty-state h6 {
        color: #64748b;
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #94a3b8;
        margin-bottom: 0;
    }

    /* Modal Modern */
    .modal-content {
        border-radius: 16px;
        border: none;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: white;
        border-radius: 16px 16px 0 0;
        padding: 20px 25px;
        border: none;
    }

    .modal-header .modal-title {
        font-weight: 700;
        font-size: 1.2rem;
    }

    .modal-header .btn-close {
        filter: brightness(0) invert(1);
    }

    .modal-body {
        padding: 25px;
    }

    .modal-footer {
        padding: 20px 25px;
        border-top: 1px solid #e2e8f0;
    }

    /* Pagination Styles */
    .pagination {
        display: flex;
        gap: 8px;
        justify-content: center;
        margin: 0;
    }

    .pagination .page-item {
        list-style: none;
    }

    .pagination .page-link {
        padding: 10px 16px;
        border-radius: 10px;
        border: 2px solid #e2e8f0;
        color: #475569;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        text-decoration: none;
        background: white;
    }

    .pagination .page-link:hover {
        background: #f8fafc;
        border-color: #8b5cf6;
        color: #8b5cf6;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.2);
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        border-color: #8b5cf6;
        color: white;
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
    }

    .pagination .page-item.disabled .page-link {
        opacity: 0.5;
        cursor: not-allowed;
        background: #f1f5f9;
        border-color: #e2e8f0;
    }

    .pagination .page-item.disabled .page-link:hover {
        transform: none;
        box-shadow: none;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Page Header -->
<div class="page-header-custom">
    <h2><i class="fas fa-exchange-alt me-2"></i> Kelola Peminjaman</h2>
    <div class="page-breadcrumb">
        <a href="<?php echo e(route('petugas.dashboard')); ?>">Dashboard</a>
        <span>/</span>
        <span>Kelola Peminjaman</span>
    </div>
</div>

<!-- Content Card -->
<div class="content-card">
    <div class="content-card-header">
        <div class="content-card-title">
            <i class="fas fa-list"></i>
            <h5>Daftar Peminjaman Buku</h5>
        </div>
    </div>

    <div class="table-responsive">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Anggota</th>
                    <th>Peminjam</th>
                    <th>ID Buku</th>
                    <th>Buku</th>
                    <th>Tersedia</th>
                    <th>Tgl Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                    <th>Denda</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $borrowings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $borrowing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="<?php echo e($borrowing->status == 'pending' && $borrowing->notified_at ? 'highlight' : ''); ?> <?php echo e($borrowing->overdue_status == 'late' ? 'table-danger' : ''); ?>">
                    <td><?php echo e($loop->iteration + ($borrowings->currentPage() - 1) * $borrowings->perPage()); ?></td>
                    <td><strong>#<?php echo e($borrowing->user->id); ?></strong></td>
                    <td>
                        <strong><?php echo e($borrowing->user->name); ?></strong>
                        <?php if($borrowing->notified_at && $borrowing->status == 'pending'): ?>
                            <br><span class="badge-custom badge-new"><i class="fas fa-bell"></i> Baru</span>
                        <?php endif; ?>
                    </td>
                    <td><strong>#<?php echo e($borrowing->book->id); ?></strong></td>
                    <td>
                        <strong><?php echo e($borrowing->book->title); ?></strong>
                        <br><small class="text-muted"><?php echo e($borrowing->book->author); ?></small>
                    </td>
                    <td>
                        <?php if($borrowing->book->available > 0): ?>
                            <span class="badge bg-success"><?php echo e($borrowing->book->available); ?></span>
                        <?php else: ?>
                            <span class="badge bg-danger">0</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($borrowing->borrow_date->format('d/m/Y')); ?></td>
                    <td><?php echo e($borrowing->due_date->format('d/m/Y')); ?></td>
                    <td><?php echo e($borrowing->return_date ? $borrowing->return_date->format('d/m/Y') : '-'); ?></td>
                    <td>
                        <?php if($borrowing->is_lost): ?>
                            <span class="badge bg-dark">Hilang</span>
                        <?php elseif($borrowing->overdue_status == 'late'): ?>
                            <span class="badge bg-danger">
                                Terlambat
                                <?php
                                    $daysLate = \Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($borrowing->due_date));
                                ?>
                                (<?php echo e($daysLate); ?> hari)
                            </span>
                        <?php elseif($borrowing->status == 'pending'): ?>
                            <span class="badge bg-warning">Pending</span>
                        <?php elseif($borrowing->status == 'approved'): ?>
                            <span class="badge bg-info">Dipinjam</span>
                        <?php elseif($borrowing->status == 'returned'): ?>
                            <span class="badge bg-success">Dikembalikan</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Ditolak</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php
                            $lateFee = $borrowing->late_fee ?? 0;
                            $daysLate = 0;
                            $rate = 2000;
                            $isLost = $borrowing->is_lost ?? false;
                            
                            if (!$isLost) {
                                if ($borrowing->return_date) {
                                    // If returned, check if late
                                    if ($borrowing->due_date->lt($borrowing->return_date)) {
                                         $daysLate = $borrowing->due_date->startOfDay()->diffInDays($borrowing->return_date->startOfDay());
                                    }
                                } else {
                                    // If not returned, check against now
                                    if ($borrowing->due_date->lt(now())) {
                                        $daysLate = $borrowing->due_date->startOfDay()->diffInDays(now()->startOfDay());
                                    }
                                }
                                
                                // If calculated days > 0, show the formula
                                // Ensure lateFee reflects the calculation if the cron hasn't run yet for active loans
                                if (!$borrowing->return_date && $daysLate > 0) {
                                    $lateFee = $daysLate * $rate;
                                }
                            }

                            $replacementFee = $borrowing->replacement_fee ?? 0;
                            $displayFee = $isLost ? $replacementFee : $lateFee;
                        ?>

                        <?php if($displayFee > 0): ?>
                            <?php if($borrowing->is_fee_paid ?? false): ?>
                                <span class="badge bg-success" title="Lunas">Rp<?php echo e(number_format($displayFee, 0, ',', '.')); ?> (Lunas)</span>
                            <?php else: ?>
                                <span class="badge bg-danger" title="Belum Lunas">Rp<?php echo e(number_format($displayFee, 0, ',', '.')); ?></span>
                            <?php endif; ?>
                            <?php if(!$isLost && $daysLate > 0): ?>
                                <div class="mt-1">
                                    <small class="text-danger fw-bold" style="font-size: 0.7rem;">
                                        (<?php echo e($daysLate); ?> hari x Rp <?php echo e(number_format($rate, 0, ',', '.')); ?>)
                                    </small>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <span class="badge bg-secondary">Rp0</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($borrowing->status == 'pending'): ?>
                            <div class="action-buttons">
                                <form action="<?php echo e(route('petugas.borrowings.approve', $borrowing->id)); ?>" method="POST" class="m-0">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn-action btn-approve" onclick="return confirm('Setujui peminjaman ini?')">
                                        <i class="fas fa-check"></i>
                                        <span>Setujui</span>
                                    </button>
                                </form>
                                <button type="button" class="btn-action btn-reject" data-bs-toggle="modal" data-bs-target="#rejectModal<?php echo e($borrowing->id); ?>">
                                    <i class="fas fa-times"></i>
                                    <span>Tolak</span>
                                </button>
                            </div>

                            <!-- Reject Modal -->
                            <div class="modal fade" id="rejectModal<?php echo e($borrowing->id); ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="<?php echo e(route('petugas.borrowings.reject', $borrowing->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <div class="modal-header">
                                                <h5 class="modal-title">Tolak Peminjaman</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Alasan Penolakan</label>
                                                    <textarea name="notes" class="form-control" rows="3" placeholder="Tuliskan alasan penolakan..." required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger">Tolak Peminjaman</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php elseif($borrowing->status == 'approved'): ?>
                            <div class="action-buttons">
                                <form action="<?php echo e(route('petugas.borrowings.return', $borrowing->id)); ?>" method="POST" class="m-0">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn-action btn-return" onclick="return confirm('Proses pengembalian buku ini?')">
                                        <i class="fas fa-undo"></i>
                                        <span>Kembalikan</span>
                                    </button>
                                </form>
                                <button type="button" class="btn-action btn-reject" data-bs-toggle="modal" data-bs-target="#lostModal<?php echo e($borrowing->id); ?>">
                                    <i class="fas fa-book-dead"></i>
                                    <span>Tandai Hilang</span>
                                </button>
                                <?php
                                    $feeTotal = ($borrowing->is_lost ?? false)
                                        ? ($borrowing->replacement_fee ?? 0)
                                        : (($borrowing->late_fee ?? 0) + ($borrowing->replacement_fee ?? 0));
                                ?>
                                <?php if($feeTotal > 0 && !$borrowing->is_fee_paid): ?>
                                <button type="button" class="btn-action btn-approve" data-bs-toggle="modal" data-bs-target="#payModal<?php echo e($borrowing->id); ?>">
                                    <i class="fas fa-wallet"></i>
                                    <span>Catat Pembayaran</span>
                                </button>
                                <?php endif; ?>
                            </div>

                            <!-- Lost Modal -->
                            <div class="modal fade" id="lostModal<?php echo e($borrowing->id); ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="<?php echo e(route('petugas.borrowings.mark-lost', $borrowing->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <div class="modal-header">
                                                <h5 class="modal-title">Tandai Buku Hilang</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Anda akan menandai buku sebagai hilang. Isi nilai penggantian jika ingin menimpa harga buku.</p>
                                                <div class="mb-3">
                                                    <label class="form-label">Nilai Penggantian (Rp)</label>
                                                    <div class="form-control bg-light">
                                                        Rp <?php echo e(number_format($borrowing->book->price ?? 0, 0, ',', '.')); ?>

                                                    </div>
                                                    <input type="hidden" name="replacement_fee" value="<?php echo e($borrowing->book->price ?? 0); ?>">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Konfirmasi: tandai buku sebagai hilang?')">Tandai Hilang</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Payment Modal -->
                            <div class="modal fade" id="payModal<?php echo e($borrowing->id); ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="<?php echo e(route('petugas.payments.store')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="borrowing_id" value="<?php echo e($borrowing->id); ?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Catat Pembayaran untuk Peminjaman #<?php echo e($borrowing->id); ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Jumlah (Rp)</label>
                                                    <input type="number" name="amount" class="form-control" value="<?php echo e(($borrowing->is_lost ?? false) ? ($borrowing->replacement_fee ?? 0) : (($borrowing->late_fee ?? 0) + ($borrowing->replacement_fee ?? 0))); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Metode</label>
                                                    <input type="text" name="method" class="form-control">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan Pembayaran</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <span class="text-muted" style="padding: 0 14px;">-</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="11" class="p-0">
                        <div class="empty-state">
                            <i class="fas fa-inbox"></i>
                            <h6>Belum Ada Data Peminjaman</h6>
                            <p>Data peminjaman akan muncul di sini ketika ada permintaan</p>
                        </div>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <?php if($borrowings->hasPages()): ?>
    <div class="mt-4 d-flex justify-content-center">
        <?php echo e($borrowings->links('pagination::bootstrap-5')); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.petugas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\SKRIPSI\Project\resources\views/petugas/borrowings/index.blade.php ENDPATH**/ ?>