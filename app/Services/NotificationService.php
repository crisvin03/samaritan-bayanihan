<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use App\Events\NewAnnouncementNotification;
use App\Events\BenefitStatusChanged;
use App\Events\ContributionStatusChanged;
use Illuminate\Support\Facades\Broadcast;

class NotificationService
{
    /**
     * Create a notification for a new announcement
     */
    public function createAnnouncementNotification($announcement)
    {
        // Get all active members
        $members = User::whereHas('role', function($query) {
            $query->where('name', 'member');
        })->where('status', 'active')->get();

        foreach ($members as $member) {
            $notification = $member->notifications()->create([
                'type' => 'announcement',
                'title' => 'New Announcement',
                'message' => $announcement->content,
                'data' => [
                    'announcement_id' => $announcement->id,
                    'title' => $announcement->title,
                ],
                'priority' => 'high',
            ]);
        }

        // Broadcast the event
        broadcast(new NewAnnouncementNotification($announcement));
    }

    /**
     * Create a notification for benefit status change
     */
    public function createBenefitStatusNotification($benefit, $oldStatus, $newStatus)
    {
        $benefitType = ucfirst(str_replace('_', ' ', $benefit->benefit_type));
        $amount = number_format($benefit->requested_amount, 2);
        
        $message = match($newStatus) {
            'approved' => "Great news! Your {$benefitType} application has been approved for ₱{$amount}.",
            'rejected' => "Your {$benefitType} application has been reviewed. Please check the details for more information.",
            'disbursed' => "Your {$benefitType} benefit of ₱{$amount} has been disbursed.",
            default => "Your {$benefitType} application status has been updated to {$newStatus}."
        };

        $notification = $benefit->user->notifications()->create([
            'type' => 'benefit_status',
            'title' => 'Benefit Update',
            'message' => $message,
            'data' => [
                'benefit_id' => $benefit->id,
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
                'amount' => $benefit->requested_amount,
                'benefit_type' => $benefit->benefit_type,
            ],
            'priority' => $newStatus === 'approved' ? 'high' : 'medium',
        ]);

        // Broadcast the event
        broadcast(new BenefitStatusChanged($benefit, $benefit->user, $oldStatus, $newStatus));

        return $notification;
    }

    /**
     * Create a notification for contribution status change
     */
    public function createContributionStatusNotification($contribution, $oldStatus, $newStatus)
    {
        $amount = "₱" . number_format($contribution->amount, 2);
        
        $message = match($newStatus) {
            'validated' => "Your contribution of {$amount} has been successfully validated.",
            'rejected' => "Your contribution of {$amount} requires attention. Please contact support.",
            default => "Your contribution of {$amount} status has been updated to {$newStatus}."
        };

        $notification = $contribution->user->notifications()->create([
            'type' => 'contribution_status',
            'title' => 'Contribution Update',
            'message' => $message,
            'data' => [
                'contribution_id' => $contribution->id,
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
                'amount' => $contribution->amount,
            ],
            'priority' => $newStatus === 'validated' ? 'medium' : 'low',
        ]);

        // Broadcast the event
        broadcast(new ContributionStatusChanged($contribution, $contribution->user, $oldStatus, $newStatus));

        return $notification;
    }

    /**
     * Mark notification as read
     */
    public function markAsRead($notificationId, $userId)
    {
        $notification = Notification::where('id', $notificationId)
            ->where('notifiable_id', $userId)
            ->where('notifiable_type', User::class)
            ->first();

        if ($notification) {
            $notification->markAsRead();
            return true;
        }

        return false;
    }

    /**
     * Mark all notifications as read for a user
     */
    public function markAllAsRead($userId)
    {
        return Notification::where('notifiable_id', $userId)
            ->where('notifiable_type', User::class)
            ->where('read', false)
            ->update([
                'read' => true,
                'read_at' => now()
            ]);
    }

    /**
     * Clear all notifications for a user
     */
    public function clearAll($userId)
    {
        return Notification::where('notifiable_id', $userId)
            ->where('notifiable_type', User::class)
            ->delete();
    }

    /**
     * Get unread notification count for a user
     */
    public function getUnreadCount($userId)
    {
        return Notification::where('notifiable_id', $userId)
            ->where('notifiable_type', User::class)
            ->where('read', false)
            ->count();
    }
}
