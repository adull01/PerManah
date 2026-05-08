<?php $__env->startSection('title', 'Riwayat Peminjaman'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        border-radius: 16px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(139, 92, 246, 0.2);
        color: white;
    }

    .page-header h2 {
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .page-header p {
        margin: 0;
        opacity: 0.95;
        font-size: 1.05rem;
    }

    /* Table Card */
    .table-card {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
    }

    /* Modern Table */
    .modern-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .modern-table thead th {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: white;
        font-weight: 700;
        padding: 15px;
        text-align: left;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .modern-table thead th:first-child {
        border-radius: 12px 0 0 0;
    }

    .modern-table thead th:last-child {
        border-radius: 0 12px 0 0;
    }

    .modern-table tbody tr {
        transition: all 0.3s ease;
    }

    .modern-table tbody tr:hover {
        background: #f8fafc;
        transform: scale(1.01);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .modern-table tbody td {
        padding: 18px 15px;
        border-bottom: 1px solid #e2e8f0;
        color: #1e293b;
        font-size: 0.9rem;
    }

    .modern-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Book Info */
    .book-info-title {
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 4px;
        font-size: 0.95rem;
    }

    .book-info-author {
        color: #64748b;
        font-size: 0.8rem;
    }

    /* Status Badges */
    .status-badge {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .status-badge.pending {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
    }

    .status-badge.approved {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
    }

    .status-badge.returned {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }

    .status-badge.lost {
        background: linear-gradient(135deg, #111827 0%, #1f2937 100%);
        color: white;
    }

    .status-badge.rejected {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }

    /* Book ID Badge */
    .book-id-badge {
        padding: 6px 12px;
        background: linear-gradient(135deg, #94a3b8 0%, #64748b 100%);
        color: white;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 700;
        display: inline-block;
    }

    /* Notes Button */
    .btn-notes {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.75rem;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-notes:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 30px;
    }

    .empty-state i {
        font-size: 4rem;
        color: #cbd5e1;
        margin-bottom: 20px;
    }

    .empty-state h5 {
        color: #64748b;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .empty-state p {
        color: #94a3b8;
        margin-bottom: 25px;
    }

    .btn-start {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: white;
        border: none;
        padding: 12px 28px;
        border-radius: 10px;
        font-weight: 700;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 8px 20px rgba(139, 92, 246, 0.3);
    }

    .btn-start:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(139, 92, 246, 0.4);
        color: white;
    }

    /* Extension Button */
    .btn-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        border: none;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
    }

    /* Modal Styling */
    .modal-content {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
        border-radius: 16px 16px 0 0;
        padding: 20px 25px;
    }

    /* Pagination */
    .pagination {
        justify-content: center;
        gap: 8px;
        margin-top: 25px;
    }

    .pagination .page-link {
        border: 2px solid #e2e8f0;
        color: #64748b;
        border-radius: 8px;
        padding: 8px 14px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .pagination .page-link:hover {
        border-color: #8b5cf6;
        color: #8b5cf6;
        background: #f5f3ff;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        border-color: #8b5cf6;
        color: white;
    }

    /* Date styling */
    .date-text {
        font-weight: 600;
        color: #475569;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .table-responsive {
            overflow-x: auto;
        }
        
        .modern-table {
            min-width: 900px;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Page Header -->
<div class="page-header">
    <h2><i class="fas fa-history me-2"></i>Riwayat Peminjaman</h2>
    <p>Lihat semua aktivitas peminjaman buku Anda</p>
</div>

<!-- Table Card -->
<div class="table-card">
    <?php if($borrowings->count() > 0): ?>
        <div class="table-responsive">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th style="width: 100px;">ID Buku</th>
                        <th>Informasi Buku</th>
                        <th style="width: 130px;">Tanggal Pinjam</th>
                        <th style="width: 130px;">Jatuh Tempo</th>
                        <th style="width: 130px;">Tanggal Kembali</th>
                        <th style="width: 140px;">Status</th>
                        <th style="width: 120px; text-align: right;">Denda (Rp)</th>
                        <th style="width: 100px; text-align: center;">Catatan</th>
                        <th style="width: 220px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $borrowings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $borrowing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->iteration + ($borrowings->currentPage() - 1) * $borrowings->perPage()); ?></td>
                        <td>
                            <span class="book-id-badge"><?php echo e($borrowing->book->id); ?></span>
                        </td>
                        <td>
                            <div class="book-info-title"><?php echo e($borrowing->book->title); ?></div>
                            <div class="book-info-author"><?php echo e($borrowing->book->author); ?></div>
                        </td>
                        <td>
                            <span class="date-text"><?php echo e($borrowing->borrow_date->format('d/m/Y')); ?></span>
                        </td>
                        <td>
                            <span class="date-text"><?php echo e($borrowing->due_date->format('d/m/Y')); ?></span>
                        </td>
                        <td>
                            <span class="date-text"><?php echo e($borrowing->return_date ? $borrowing->return_date->format('d/m/Y') : '-'); ?></span>
                        </td>
                        <td>
                            <?php if($borrowing->is_lost): ?>
                                <span class="status-badge lost">
                                    <i class="fas fa-book-dead"></i>
                                    <span>Hilang</span>
                                </span>
                            <?php elseif($borrowing->status == 'pending'): ?>
                                <span class="status-badge pending">
                                    <i class="fas fa-clock"></i>
                                    <span>Pending</span>
                                </span>
                            <?php elseif($borrowing->status == 'approved'): ?>
                                <span class="status-badge approved">
                                    <i class="fas fa-book-open"></i>
                                    <span>Dipinjam</span>
                                </span>
                            <?php elseif($borrowing->status == 'returned'): ?>
                                <span class="status-badge returned">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Dikembalikan</span>
                                </span>
                            <?php else: ?>
                                <span class="status-badge rejected">
                                    <i class="fas fa-times-circle"></i>
                                    <span>Ditolak</span>
                                </span>
                            <?php endif; ?>
                        </td>
                        <td style="text-align: right;">
                            <?php
                                // Calculate displayed fee: if returned use stored fees, otherwise compute current late fee
                                $storedLate = $borrowing->late_fee ?? 0;
                                $storedReplace = $borrowing->replacement_fee ?? 0;
                                $daysLate = 0;
                                $rate = 2000;
                                
                                if($borrowing->return_date) {
                                    $displayFee = $storedLate + $storedReplace;
                                    if ($borrowing->due_date->lt($borrowing->return_date)) {
                                         $daysLate = $borrowing->due_date->startOfDay()->diffInDays($borrowing->return_date->startOfDay());
                                    }
                                } else {
                                    // Active loan
                                    if(now()->gt($borrowing->due_date)) {
                                        $daysLate = now()->startOfDay()->diffInDays($borrowing->due_date->startOfDay());
                                    }
                                    $displayFee = ($daysLate * $rate) + ($borrowing->is_lost ? ($borrowing->replacement_fee ?? 0) : 0);
                                }
                            ?>
                            
                            <?php if($displayFee > 0): ?>
                                <span><?php echo e(number_format($displayFee,0,',','.')); ?></span>
                                <?php if($daysLate > 0): ?>
                                    <br>
                                    <small class="text-danger" style="font-size: 0.75rem;">
                                        (<?php echo e($daysLate); ?> hari x Rp 2.000)
                                    </small>
                                <?php endif; ?>
                                <?php if($borrowing->is_lost): ?>
                                    <br><small class="text-muted">(Termasuk Ganti Rugi)</small>
                                <?php endif; ?>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td style="text-align: center;">
                            <?php if($borrowing->notes): ?>
                                <button type="button" class="btn-notes" data-bs-toggle="tooltip" data-bs-placement="left" title="<?php echo e($borrowing->notes); ?>">
                                    <i class="fas fa-info-circle"></i>
                                </button>
                            <?php else: ?>
                                <span style="color: #cbd5e1;">-</span>
                            <?php endif; ?>
                        </td>
                        <td style="text-align: center;">
                            <?php if($borrowing->status == 'approved' && !$borrowing->return_date): ?>
                                <div style="display: flex; gap: 6px; justify-content: center; flex-wrap: wrap;">
                                    <?php
                                        $hasPendingExtension = $borrowing->extensionRequests()->where('status', 'pending')->exists();
                                        $approvedExtensions = $borrowing->extensionRequests()->where('status', 'approved')->count();
                                    ?>
                                    
                                    <?php if($hasPendingExtension): ?>
                                        <span class="badge bg-warning text-dark" style="padding: 6px 12px;">
                                            <i class="fas fa-clock"></i> Menunggu
                                        </span>
                                    <?php elseif($approvedExtensions >= 2): ?>
                                        <span class="badge bg-secondary" data-bs-toggle="tooltip" title="Maksimal 2x perpanjangan" style="padding: 6px 12px;">
                                            <i class="fas fa-ban"></i> Max
                                        </span>
                                    <?php else: ?>
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#extendModal<?php echo e($borrowing->id); ?>" style="white-space: nowrap;">
                                            <i class="fas fa-calendar-plus"></i> Perpanjang
                                        </button>
                                    <?php endif; ?>
                                    
                                    <!-- Tombol Kembalikan -->
                                    
                                </div>
                            <?php else: ?>
                                <span style="color: #cbd5e1;">-</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            <?php echo e($borrowings->links()); ?>

        </div>
    <?php else: ?>
        <div class="empty-state">
            <i class="fas fa-inbox"></i>
            <h5>Belum Ada Riwayat Peminjaman</h5>
            <p>Anda belum pernah meminjam buku. Mulai jelajahi katalog kami!</p>
            <a href="<?php echo e(route('anggota.catalog')); ?>" class="btn-start">
                <i class="fas fa-book"></i>
                <span>Mulai Pinjam Buku</span>
            </a>
        </div>
    <?php endif; ?>
</div>

<!-- Extension Modals -->
<?php $__currentLoopData = $borrowings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $borrowing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($borrowing->status == 'approved' && !$borrowing->return_date): ?>
        <div class="modal fade" id="extendModal<?php echo e($borrowing->id); ?>" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="fas fa-calendar-plus me-2"></i>
                            Ajukan Perpanjangan Peminjaman
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="<?php echo e(route('anggota.borrowings.request-extension', $borrowing->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Informasi Buku</label>
                                <div class="p-3 bg-light rounded">
                                    <div class="fw-bold text-dark"><?php echo e($borrowing->book->title); ?></div>
                                    <div class="text-muted small"><?php echo e($borrowing->book->author); ?></div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Tanggal Jatuh Tempo Saat Ini</label>
                                <div class="p-2 bg-warning bg-opacity-10 rounded text-center">
                                    <i class="fas fa-calendar-alt me-2"></i>
                                    <span class="fw-bold"><?php echo e($borrowing->due_date->format('d F Y')); ?></span>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="requested_days<?php echo e($borrowing->id); ?>" class="form-label fw-bold">
                                    Pilih Durasi Perpanjangan <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" id="requested_days<?php echo e($borrowing->id); ?>" name="requested_days" required>
                                    <option value="">-- Pilih Durasi --</option>
                                    <option value="3">3 Hari</option>
                                    <option value="5">5 Hari</option>
                                    <option value="7">7 Hari</option>
                                </select>
                                <div class="form-text">
                                    <i class="fas fa-info-circle"></i>
                                    Tanggal jatuh tempo akan otomatis diperpanjang sesuai pilihan Anda
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="reason<?php echo e($borrowing->id); ?>" class="form-label fw-bold">
                                    Alasan Perpanjangan <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control" id="reason<?php echo e($borrowing->id); ?>" name="reason" rows="3" required placeholder="Jelaskan alasan Anda mengajukan perpanjangan..."></textarea>
                                <div class="form-text">Maksimal 500 karakter</div>
                            </div>
                            
                            <div class="alert alert-info mb-0">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <strong>Catatan:</strong> Maksimal perpanjangan adalah <strong>2 kali</strong> per peminjaman. Permintaan akan diproses oleh admin/petugas.
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times"></i> Batal
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> Kirim Permintaan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.anggota', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\SKRIPSI\Project\resources\views/anggota/history.blade.php ENDPATH**/ ?>