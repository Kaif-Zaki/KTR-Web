<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\Auth;
use App\Core\Csrf;
use App\Core\Session;
use App\Core\View;

class AdminAuthController
{
    public function showLogin(): void
    {
        if (Auth::checkAdmin()) {
            redirect('/admin');
        }

        View::render('admin/auth/login', [
            'error' => Session::flash('error'),
            'success' => Session::flash('success'),
            'csrfToken' => Csrf::token(),
            'pageTitle' => 'Admin Login',
        ], 'layouts/admin_auth');
    }

    public function login(): void
    {
        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Invalid request token. Please try again.');
            redirect('/admin/login');
        }

        $email = strtolower(trim((string) ($_POST['email'] ?? '')));
        $password = (string) ($_POST['password'] ?? '');

        if ($email === '' || $password === '') {
            Session::flash('error', 'Email and password are required.');
            redirect('/admin/login');
        }

        if (!Auth::attemptAdminLogin($email, $password)) {
            Session::flash('error', 'Invalid email or password.');
            redirect('/admin/login');
        }

        redirect('/admin');
    }

    public function logout(): void
    {
        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Invalid request token.');
            redirect('/admin');
        }

        Auth::logoutAdmin();
        redirect('/admin/login');
    }
}
