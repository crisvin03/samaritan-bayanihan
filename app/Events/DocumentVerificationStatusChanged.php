<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DocumentVerificationStatusChanged implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $status;
    public $message;
    public $title;

    /**
     * Create a new event instance.
     */
    public function __construct($userId, $status, $message = null)
    {
        $this->userId = $userId;
        $this->status = $status;
        $this->title = $this->getTitle($status);
        $this->message = $message ?: $this->getDefaultMessage($status);
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('user.' . $this->userId),
        ];
    }

    /**
     * Get the data to broadcast.
     */
    public function broadcastWith(): array
    {
        return [
            'id' => uniqid(),
            'type' => 'document_verification',
            'title' => $this->title,
            'message' => $this->message,
            'status' => $this->status,
            'priority' => $this->status === 'approved' ? 'high' : 'normal',
            'created_at' => now()->toISOString(),
        ];
    }

    /**
     * Get the title based on status
     */
    private function getTitle($status)
    {
        switch ($status) {
            case 'approved':
                return 'Document Verification Approved';
            case 'rejected':
                return 'Document Verification Rejected';
            case 'pending':
                return 'Documents Under Review';
            default:
                return 'Document Status Update';
        }
    }

    /**
     * Get the default message based on status
     */
    private function getDefaultMessage($status)
    {
        switch ($status) {
            case 'approved':
                return 'Congratulations! Your documents have been verified and approved. You are now a verified member with full access to all features.';
            case 'rejected':
                return 'Your document verification has been rejected. Please review the feedback and upload new documents for verification.';
            case 'pending':
                return 'Your documents have been received and are now under review. We will notify you once the review is complete.';
            default:
                return 'Your document verification status has been updated.';
        }
    }
}
