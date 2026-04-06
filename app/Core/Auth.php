<?php

declare(strict_types=1);

namespace App\Core;

use App\Model\AdminModel;

class Auth
{
    public static function attemptAdminLogin(string $email, string $password): bool
    {
        $admin = (new AdminModel())->findByEmail($email);

        if ($admin === null || !password_verify($password, $admin['password_hash'])) {
            return false;
        }

        Session::regenerate();
        Session::set('admin_id', (int) $admin['id']);
        Session::set('admin_name', $admin['name']);

        return true;
    }

    public static function admin(): ?array
    {
        if (!Session::has('admin_id')) {
            return null;
        }

        return [
            'id' => Session::get('admin_id'),
            'name' => Session::get('admin_name'),
        ];
    }

    public static function checkAdmin(): bool
    {
        return self::admin() !== null;
    }

    public static function requireAdmin(): void
    {
        if (!self::checkAdmin()) {
            Session::flash('error', 'Please log in as admin.');
            redirect('/admin/login');
        }
    }

    public static function logoutAdmin(): void
    {
        Session::destroy();
    }
}
