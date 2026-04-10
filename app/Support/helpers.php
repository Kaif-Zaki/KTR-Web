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
    if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
        return $path;
    }

    $baseUrl = rtrim((string) config('app.base_url'), '/');
    if ($baseUrl === '' || $baseUrl === '/') {
        $baseDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
        $baseUrl = $baseDir !== '/' ? rtrim($baseDir, '/') : '';
    }
    $path = '/' . ltrim($path, '/');

    return $baseUrl . $path;
}

function asset_url(string $path): string
{
    $assetPath = '/' . ltrim($path, '/');
    $fullPath = __DIR__ . '/../../' . ltrim($path, '/');

    $version = '';
    if (is_file($fullPath)) {
        $mtime = @filemtime($fullPath);
        if ($mtime !== false) {
            $version = '?v=' . $mtime;
        }
    }

    return url($assetPath . $version);
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function redirect(string $to): never
{
    $location = $to;
    if (!str_starts_with($to, 'http://') && !str_starts_with($to, 'https://')) {
        $location = url($to);
    }
    header('Location: ' . $location);
    exit;
}

function website_settings(): ?array
{
    static $settings = null;
    
    if ($settings === null) {
        try {
            $model = new \App\Models\WebsiteSettingsModel();
            $settings = $model->get() ?: [];
        } catch (\Throwable) {
            $settings = [];
        }
    }
    
    return $settings ?: null;
}
