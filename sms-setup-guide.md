# SMS Service Setup Guide

## Twilio SMS Configuration (Recommended)

### Step 1: Create Twilio Account
1. Go to [Twilio Console](https://console.twilio.com/)
2. Sign up for a free account
3. Get your Account SID and Auth Token from the dashboard

### Step 2: Get Phone Number
1. In Twilio Console, go to Phone Numbers → Manage → Buy a number
2. Choose a number with SMS capabilities
3. Note the phone number (format: +1234567890)

### Step 3: Add to .env file
```env
TWILIO_SID=your_twilio_account_sid
TWILIO_TOKEN=your_twilio_auth_token
TWILIO_FROM=+1234567890
```

### Step 4: Install Twilio SDK
```bash
composer require twilio/sdk
```

## Alternative SMS Services

### Vonage (Nexmo)
```env
VONAGE_API_KEY=your_api_key
VONAGE_API_SECRET=your_api_secret
VONAGE_FROM=your_vonage_number
```

### AWS SNS
```env
AWS_ACCESS_KEY_ID=your_aws_access_key
AWS_SECRET_ACCESS_KEY=your_aws_secret_key
AWS_DEFAULT_REGION=us-east-1
```

## Test SMS Configuration
Run this command to test SMS:
```bash
php artisan tinker
```
Then in tinker:
```php
// Test SMS sending
$user = new \App\Models\User();
$user->phone_number = '+639123456789';
$user->notify(new \App\Notifications\PhoneVerificationNotification());
```
