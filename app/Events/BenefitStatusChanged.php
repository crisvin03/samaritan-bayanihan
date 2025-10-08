<?php

namespace App\Events;

use App\Models\Benefit;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BenefitStatusChanged implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $benefit;
    public $user;
    public $oldStatus;
    public $newStatus;

    /**
     * Create a new event instance.
     */
    public function __construct(Benefit $benefit, User $user, string $oldStatus, string $newStatus)
    {
        $this->benefit = $benefit;
        $this->user = $user;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('user.' . $this->user->id),
        ];
    }

    /**
     * Get the data to broadcast.
     */
    public function broadcastWith(): array
    {
        $benefitType = ucfirst(str_replace('_', ' ', $this->benefit->benefit_type));
        $amount = number_format($this->benefit->requested_amount, 2);
        
        $message = match($this->newStatus) {
            'approved' => "Great news! Your {$benefitType} application has been approved for ₱{$amount}.",
            'rejected' => "Your {$benefitType} application has been reviewed. Please check the details for more information.",
            'disbursed' => "Your {$benefitType} benefit of ₱{$amount} has been disbursed.",
            default => "Your {$benefitType} application status has been updated to {$this->newStatus}."
        };

        return [
            'id' => $this->benefit->id,
            'title' => 'Benefit Update',
            'message' => $message,
            'type' => 'benefit_status',
            'priority' => $this->newStatus === 'approved' ? 'high' : 'medium',
            'data' => [
                'benefit_id' => $this->benefit->id,
                'old_status' => $this->oldStatus,
                'new_status' => $this->newStatus,
                'amount' => $this->benefit->requested_amount,
                'benefit_type' => $this->benefit->benefit_type,
            ],
            'created_at' => now()->toISOString(),
        ];
    }
}
