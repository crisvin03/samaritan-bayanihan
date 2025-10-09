<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Security Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains security-related configuration options for the
    | Samaritan Bayanihan application.
    |
    */

    'registration' => [
        'max_attempts_per_ip' => env('REGISTRATION_MAX_ATTEMPTS_PER_IP', 3),
        'max_attempts_per_hour' => env('REGISTRATION_MAX_ATTEMPTS_PER_HOUR', 5),
        'require_email_verification' => env('REQUIRE_EMAIL_VERIFICATION', true),
        'require_phone_verification' => env('REQUIRE_PHONE_VERIFICATION', true),
        'require_document_verification' => env('REQUIRE_DOCUMENT_VERIFICATION', true),
        'require_manual_approval' => env('REQUIRE_MANUAL_APPROVAL', true),
        'min_age' => env('MIN_REGISTRATION_AGE', 0),
    ],

    'verification' => [
        'email_token_expiry_hours' => env('EMAIL_TOKEN_EXPIRY_HOURS', 24),
        'phone_code_expiry_minutes' => env('PHONE_CODE_EXPIRY_MINUTES', 10),
        'max_verification_attempts' => env('MAX_VERIFICATION_ATTEMPTS', 3),
        'verification_attempt_cooldown_hours' => env('VERIFICATION_COOLDOWN_HOURS', 1),
    ],

    'documents' => [
        'max_file_size' => env('MAX_DOCUMENT_SIZE', 10240), // 10MB in KB
        'allowed_types' => ['jpg', 'jpeg', 'png', 'pdf'],
        'storage_path' => 'documents/verification',
    ],

    'rate_limiting' => [
        'login_attempts' => env('LOGIN_RATE_LIMIT', 5),
        'registration_attempts' => env('REGISTRATION_RATE_LIMIT', 3),
        'verification_attempts' => env('VERIFICATION_RATE_LIMIT', 3),
    ],

    'monitoring' => [
        'log_suspicious_activity' => env('LOG_SUSPICIOUS_ACTIVITY', true),
        'alert_on_multiple_registrations' => env('ALERT_MULTIPLE_REGISTRATIONS', true),
        'ip_blacklist' => env('IP_BLACKLIST', ''),
    ],
];
