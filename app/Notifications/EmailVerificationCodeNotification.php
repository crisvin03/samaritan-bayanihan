<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailVerificationCodeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $code;
    public $expiresAt;

    /**
     * Create a new notification instance.
     */
    public function __construct($code, $expiresAt)
    {
        $this->code = $code;
        $this->expiresAt = $expiresAt;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Email Verification Code - Samaritan Bayanihan Inc.')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Thank you for registering with Samaritan Bayanihan Inc.')
            ->line('To complete your email verification, please use the following verification code:')
            ->line('**' . $this->code . '**')
            ->line('This code will expire in 15 minutes.')
            ->line('If you did not request this verification code, please ignore this email.')
            ->action('Verify Email', url('/verify-email'))
            ->line('For security reasons, please do not share this code with anyone.')
            ->salutation('Best regards, Samaritan Bayanihan Inc. Team');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable)
    {
        return [
            'code' => $this->code,
            'expires_at' => $this->expiresAt,
        ];
    }
}
