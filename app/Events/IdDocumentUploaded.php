<?php

namespace App\Events;

use App\Models\User;
use App\Models\AdminNotification;
use App\Models\TreasurerNotification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class IdDocumentUploaded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $documentType;

    /**
     * Create a new event instance.
     */
    public function __construct(User $user, $documentType)
    {
        $this->user = $user;
        $this->documentType = $documentType;
        
        // Create admin notification
        AdminNotification::create([
            'type' => 'id_uploaded',
            'title' => 'ID Document Uploaded',
            'message' => "Member '{$user->name}' has uploaded a {$documentType} document for verification.",
            'data' => [
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email,
                'document_type' => $documentType
            ],
            'priority' => 'high'
        ]);

        // Create treasurer notification for the specific barangay
        TreasurerNotification::create([
            'type' => 'id_uploaded',
            'title' => 'ID Document Uploaded in Your Barangay',
            'message' => "Member '{$user->name}' from {$user->barangay} has uploaded a {$documentType} document for verification.",
            'data' => [
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email,
                'document_type' => $documentType
            ],
            'barangay' => $user->barangay,
            'priority' => 'high'
        ]);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('admin-notifications'),
        ];
    }

    public function broadcastAs()
    {
        return 'id-document-uploaded';
    }
}
