<?php

declare(strict_types=1);

namespace App\Core;

class Session
{
    public static function start(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            return;
        }

        session_name((string) config('app.session_name'));
        session_start();
    }

    public static function set(string $key, mixed $value): void
    {
        if (!isset($_SESSION) || !is_array($_SESSION)) {
            $_SESSION = [];
        }

        $_SESSION[$key] = $value;
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        if (!isset($_SESSION) || !is_array($_SESSION)) {
            return $default;
        }

        return $_SESSION[$key] ?? $default;
    }

    public static function has(string $key): bool
    {
        return isset($_SESSION) && is_array($_SESSION) && array_key_exists($key, $_SESSION);
    }

    public static function flash(string $key, ?string $value = null): ?string
    {
        if ($value !== null) {
            self::set('_flash_' . $key, $value);
            return null;
        }

        $flashKey = '_flash_' . $key;
        $message = self::get($flashKey);
        self::remove($flashKey);

        return is_string($message) ? $message : null;
    }

    public static function remove(string $key): void
    {
        if (!isset($_SESSION) || !is_array($_SESSION)) {
            return;
        }

        unset($_SESSION[$key]);
    }

    public static function regenerate(): void
    {
        session_regenerate_id(true);
    }

    public static function destroy(): void
    {
        if (!isset($_SESSION) || !is_array($_SESSION)) {
            $_SESSION = [];
        }

        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }

        session_destroy();
    }
}
