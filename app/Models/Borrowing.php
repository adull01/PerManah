<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'borrow_date',
        'due_date',
        'return_date',
        'status',
        'notes',
        'processed_by',
        'terms_accepted',
        'notified_at',
        'rejection_reason',
        'late_fee',
        'is_lost',
        'replacement_fee',
        'is_fee_paid',
        'fee_paid_at',
    ];

    protected $casts = [
        'borrow_date' => 'date',
        'due_date' => 'date',
        'return_date' => 'date',
        'terms_accepted' => 'boolean',
        'notified_at' => 'datetime',
        'is_lost' => 'boolean',
        'late_fee' => 'integer',
        'replacement_fee' => 'integer',
        'is_fee_paid' => 'boolean',
        'fee_paid_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function processedBy()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    // Relasi ke extension requests
    public function extensionRequests()
    {
        return $this->hasMany(ExtensionRequest::class);
    }

    // Get latest extension request
    public function latestExtensionRequest()
    {
        return $this->hasOne(ExtensionRequest::class)->latestOfMany();
    }
}
