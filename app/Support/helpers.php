<?php

declare(strict_types=1);

function config(string $key): mixed
{
    static $cache = [];

    $segments = explode('.', $key);
    $file = array_shift($segments);

    if (!isset($cache[$file])) {
        $path = __DIR__ . '/../../config/' . $file . '.php';

        if (!file_exists($path)) {
            throw new RuntimeException("Config file not found: {$file}");
        }

        $cache[$file] = require $path;
    }

    if (empty($segments)) {
        return $cache[$file];
    }

    $value = $cache[$file];

    foreach ($segments as $segment) {
        if (!is_array($value) || !array_key_exists($segment, $value)) {
            return null;
        }

        $value = $value[$segment];
    }

    return $value;
}

function url(string $path = '/'): string
{
    $baseUrl = rtrim((string) config('app.base_url'), '/');
    $path = '/' . ltrim($path, '/');

    return $baseUrl . $path;
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function redirect(string $to): never
{
    header('Location: ' . $to);
    exit;
}
