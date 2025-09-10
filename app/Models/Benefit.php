<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Benefit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'benefit_type',
        'requested_amount',
        'reason',
        'supporting_documents',
        'status',
        'admin_notes',
        'reviewed_by',
        'reviewed_at',
        'approved_amount',
        'disbursed_at',
    ];

    protected $casts = [
        'supporting_documents' => 'array',
        'requested_amount' => 'decimal:2',
        'approved_amount' => 'decimal:2',
        'reviewed_at' => 'datetime',
        'disbursed_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reviewedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeForBarangay($query, $barangay)
    {
        return $query->whereHas('user', function ($q) use ($barangay) {
            $q->where('barangay', $barangay);
        });
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'under_review' => 'bg-blue-100 text-blue-800',
            'approved' => 'bg-green-100 text-green-800',
            'rejected' => 'bg-red-100 text-red-800',
            'disbursed' => 'bg-purple-100 text-purple-800',
        ];

        return $badges[$this->status] ?? 'bg-gray-100 text-gray-800';
    }
}