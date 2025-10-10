<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TreasurerNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'message',
        'data',
        'barangay',
        'read',
        'priority',
        'read_at'
    ];

    protected $casts = [
        'data' => 'array',
        'read' => 'boolean',
        'read_at' => 'datetime'
    ];

    // Scope for unread notifications
    public function scopeUnread($query)
    {
        return $query->where('read', false);
    }

    // Scope for read notifications
    public function scopeRead($query)
    {
        return $query->where('read', true);
    }

    // Scope by barangay
    public function scopeBarangay($query, $barangay)
    {
        return $query->where('barangay', $barangay);
    }

    // Scope by priority
    public function scopePriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    // Scope by type
    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Mark as read
    public function markAsRead()
    {
        $this->update([
            'read' => true,
            'read_at' => now()
        ]);
    }

    // Mark as unread
    public function markAsUnread()
    {
        $this->update([
            'read' => false,
            'read_at' => null
        ]);
    }
}
