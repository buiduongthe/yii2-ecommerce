<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'user.passwordResetTokenExpire' => 3600,
    'user.passwordMinLength' => 8,
    'images'                        => [
        'sizes' => [
            'THUMB'  => ['width' => 120, 'height' => 90],
        ],
    ],
    'verify_phone_number' => '123456',
    'current_time'                      => round ( microtime(true) * 1000),
];
