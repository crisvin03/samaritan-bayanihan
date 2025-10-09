<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class EmailVerificationCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'code',
        'expires_at',
        'is_used',
        'used_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'used_at' => 'datetime',
        'is_used' => 'boolean'
    ];

    /**
     * Get the user that owns the verification code.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if the code is expired.
     */
    public function isExpired()
    {
        return $this->expires_at->isPast();
    }

    /**
     * Check if the code is valid (not used and not expired).
     */
    public function isValid()
    {
        return !$this->is_used && !$this->isExpired();
    }

    /**
     * Mark the code as used.
     */
    public function markAsUsed()
    {
        $this->update([
            'is_used' => true,
            'used_at' => now()
        ]);
    }

    /**
     * Generate a new 6-digit verification code.
     */
    public static function generateCode()
    {
        return str_pad(random_int(100000, 999999), 6, '0', STR_PAD_LEFT);
    }

    /**
     * Create a new verification code for a user.
     */
    public static function createForUser($userId, $expiresInMinutes = 15)
    {
        // Invalidate any existing codes for this user
        self::where('user_id', $userId)
            ->where('is_used', false)
            ->update(['is_used' => true]);

        return self::create([
            'user_id' => $userId,
            'code' => self::generateCode(),
            'expires_at' => now()->addMinutes($expiresInMinutes)
        ]);
    }

    /**
     * Find a valid code for verification.
     */
    public static function findValidCode($code, $userId = null)
    {
        $query = self::where('code', $code)
            ->where('is_used', false)
            ->where('expires_at', '>', now());

        if ($userId) {
            $query->where('user_id', $userId);
        }

        return $query->first();
    }
}
