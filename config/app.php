<?php

declare(strict_types=1);

return [
    'name' => (string) env('APP_NAME', 'Kottramulla United Welfare Society'),
    'base_url' => (string) env('APP_URL', '/'),
    'timezone' => (string) env('APP_TIMEZONE', 'Asia/Colombo'),
    'session_name' => (string) env('SESSION_NAME', 'kottramulla_session'),
    'admin_route_prefix' => '/admin',
];
