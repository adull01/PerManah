<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'nisn',
        'email',
        'password',
        'role',
        'phone',
        'address',
        'membership_date',
        'profile_photo',
        'ktm_photo',
        'status',
        'rejection_reason',
        'rejection_date',
        'plain_password',
        // pastikan profile_photo bisa diisi
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'plain_password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'membership_date' => 'date',
            'rejection_date' => 'datetime',
        ];
    }

    /**
     * Get the borrowings for the user.
     */
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    /**
     * Get the active borrowings for the user.
     */
    public function activeBorrowings()
    {
        return $this->hasMany(Borrowing::class)->where('status', 'approved');
    }

    /**
     * Get the pending borrowings for the user.
     */
    public function pendingBorrowings()
    {
        return $this->hasMany(Borrowing::class)->where('status', 'pending');
    }

    /**
     * Get announcements created by the user
     */
    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'created_by');
    }

    /**
     * Get the user's profile photo URL.
     */
    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_photo) {
            return asset('storage/' . $this->profile_photo);
        }
        
        // Default avatar SVG
        return asset('images/default-avatar.svg');
    }

    /**
     * Get the KTM photo URL if uploaded.
     */
    public function getKtmPhotoUrlAttribute()
    {
        if ($this->ktm_photo) {
            return asset('storage/' . $this->ktm_photo);
        }

        return null;
    }
}
