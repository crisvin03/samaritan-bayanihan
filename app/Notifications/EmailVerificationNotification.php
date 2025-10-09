<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class EmailVerificationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $verificationToken;

    public function __construct()
    {
        $this->verificationToken = Str::random(64);
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $verificationUrl = url('/verify-email?token=' . $this->verificationToken . '&email=' . urlencode($notifiable->email));
        
        return (new MailMessage)
            ->subject('Verify Your Email - Samaritan Bayanihan Inc.')
            ->greeting('Welcome to Samaritan Bayanihan Inc.!')
            ->line('Thank you for registering with our community savings program.')
            ->line('Please verify your email address to complete your registration and access all benefits.')
            ->action('Verify Email Address', $verificationUrl)
            ->line('This verification link will expire in 24 hours.')
            ->line('If you did not create an account, please ignore this email.')
            ->salutation('Best regards, Samaritan Bayanihan Inc. Team');
    }

    public function toArray($notifiable)
    {
        return [];
    }
}