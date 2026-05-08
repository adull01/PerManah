<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtensionRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'borrowing_id',
        'user_id',
        'requested_days',
        'reason',
        'status',
        'processed_by',
        'processed_at',
        'rejection_reason',
    ];

    protected $casts = [
        'processed_at' => 'datetime',
    ];

    // Relasi ke peminjaman
    public function borrowing()
    {
        return $this->belongsTo(Borrowing::class);
    }

    // Relasi ke user yang mengajukan (anggota)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke user yang memproses (admin/petugas)
    public function processedBy()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }
}
