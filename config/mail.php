<?php

declare(strict_types=1);

return [
    'enabled' => (bool) env('MAIL_ENABLED', false),
    'driver' => (string) env('MAIL_DRIVER', 'emailjs'),
    'contact_admin_email' => (string) env('CONTACT_ADMIN_EMAIL', ''),
    'from_email' => (string) env('MAIL_FROM_EMAIL', 'noreply@example.com'),
    'from_name' => (string) env('MAIL_FROM_NAME', 'Kottramulla United Welfare Society'),
    'emailjs' => [
        'endpoint' => (string) env('EMAILJS_ENDPOINT', 'https://api.emailjs.com/api/v1.0/email/send'),
        'service_id' => (string) env('EMAILJS_SERVICE_ID', ''),
        'template_id' => (string) env('EMAILJS_TEMPLATE_ID', ''),
        'contact_template_id' => (string) env('EMAILJS_CONTACT_TEMPLATE_ID', ''),
        'public_key' => (string) env('EMAILJS_PUBLIC_KEY', ''),
        'private_key' => (string) env('EMAILJS_PRIVATE_KEY', ''),
        'timeout' => (int) env('EMAILJS_TIMEOUT', 12),
    ],
];
