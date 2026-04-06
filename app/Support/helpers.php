<?php

declare(strict_types=1);

function config(string $key): mixed
{
    static $cache = [];

    [$file, $item] = array_pad(explode('.', $key, 2), 2, null);

    if (!isset($cache[$file])) {
        $path = __DIR__ . '/../../config/' . $file . '.php';

        if (!file_exists($path)) {
            throw new RuntimeException("Config file not found: {$file}");
        }

        $cache[$file] = require $path;
    }

    if ($item === null) {
        return $cache[$file];
    }

    return $cache[$file][$item] ?? null;
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
