# Email Service Setup Guide

## Gmail SMTP Configuration (Recommended)

### Step 1: Enable 2-Factor Authentication
1. Go to your Google Account settings
2. Navigate to Security → 2-Step Verification
3. Enable 2-Step Verification

### Step 2: Generate App Password
1. Go to Security → App passwords
2. Select "Mail" and your device
3. Generate the app password (16 characters)
4. Copy this password

### Step 3: Add to .env file
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_16_character_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="Samaritan Bayanihan Inc."
```

## Alternative Email Services

### SendGrid
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your_sendgrid_api_key
MAIL_ENCRYPTION=tls
```

### Mailgun
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailgun.org
MAIL_PORT=587
MAIL_USERNAME=your_mailgun_username
MAIL_PASSWORD=your_mailgun_password
MAIL_ENCRYPTION=tls
```

## Test Email Configuration
Run this command to test your email setup:
```bash
php artisan tinker
```
Then in tinker:
```php
Mail::raw('Test email', function($message) {
    $message->to('test@example.com')->subject('Test');
});
```
