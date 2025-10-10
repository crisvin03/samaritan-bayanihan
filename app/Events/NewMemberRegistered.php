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

class NewMemberRegistered implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    /**
     * Create a new event instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        
        // Create admin notification
        AdminNotification::create([
            'type' => 'new_member',
            'title' => 'New Member Registered',
            'message' => "A new member '{$user->name}' has registered and is waiting for verification.",
            'data' => [
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email,
                'barangay' => $user->barangay
            ],
            'priority' => 'normal'
        ]);

        // Create treasurer notification for the specific barangay
        TreasurerNotification::create([
            'type' => 'new_member',
            'title' => 'New Member in Your Barangay',
            'message' => "A new member '{$user->name}' from {$user->barangay} has registered and is waiting for verification.",
            'data' => [
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email,
                'barangay' => $user->barangay
            ],
            'barangay' => $user->barangay,
            'priority' => 'normal'
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
        return 'new-member-registered';
    }
}
