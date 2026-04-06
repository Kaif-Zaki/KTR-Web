<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\Auth;
use App\Core\Csrf;
use App\Core\Session;
use App\Core\View;
use App\Model\AdminModel;

class AdminProfileController
{
    private AdminModel $admins;

    public function __construct()
    {
        $this->admins = new AdminModel();
    }

    public function show(): void
    {
        Auth::requireAdmin();
        $admin = $this->currentAdminOrLogout();

        View::render('admin/profile/show', [
            'admin' => $admin,
            'csrfToken' => Csrf::token(),
            'success' => Session::flash('success'),
            'error' => Session::flash('error'),
        ], 'layouts/admin');
    }

    public function updateEmail(): void
    {
        Auth::requireAdmin();

        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Invalid request token.');
            redirect('/admin/profile');
        }

        $admin = $this->currentAdminOrLogout();
        $newEmail = strtolower(trim((string) ($_POST['email'] ?? '')));
        $currentPassword = (string) ($_POST['current_password'] ?? '');

        if ($newEmail === '' || $currentPassword === '') {
            Session::flash('error', 'Email and current password are required.');
            redirect('/admin/profile');
        }

        if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
            Session::flash('error', 'Please enter a valid email address.');
            redirect('/admin/profile');
        }

        if ($newEmail === strtolower((string) $admin['email'])) {
            Session::flash('success', 'Email is already up to date.');
            redirect('/admin/profile');
        }

        if (!password_verify($currentPassword, $admin['password_hash'])) {
            Session::flash('error', 'Current password is incorrect.');
            redirect('/admin/profile');
        }

        if ($this->admins->emailExistsForAnotherAdmin($newEmail, (int) $admin['id'])) {
            Session::flash('error', 'This email is already used by another admin.');
            redirect('/admin/profile');
        }

        $this->admins->updateEmail((int) $admin['id'], $newEmail);
        Session::flash('success', 'Email updated successfully.');
        redirect('/admin/profile');
    }

    public function updatePassword(): void
    {
        Auth::requireAdmin();

        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Invalid request token.');
            redirect('/admin/profile');
        }

        $admin = $this->currentAdminOrLogout();

        $currentPassword = (string) ($_POST['current_password'] ?? '');
        $newPassword = (string) ($_POST['new_password'] ?? '');
        $confirmPassword = (string) ($_POST['new_password_confirmation'] ?? '');

        if ($currentPassword === '' || $newPassword === '' || $confirmPassword === '') {
            Session::flash('error', 'All password fields are required.');
            redirect('/admin/profile');
        }

        if (!password_verify($currentPassword, $admin['password_hash'])) {
            Session::flash('error', 'Current password is incorrect.');
            redirect('/admin/profile');
        }

        if ($newPassword !== $confirmPassword) {
            Session::flash('error', 'New password and confirmation do not match.');
            redirect('/admin/profile');
        }

        if (password_verify($newPassword, $admin['password_hash'])) {
            Session::flash('error', 'New password must be different from current password.');
            redirect('/admin/profile');
        }

        $this->admins->updatePassword((int) $admin['id'], password_hash($newPassword, PASSWORD_DEFAULT));
        Session::regenerate();
        Session::flash('success', 'Password updated successfully.');
        redirect('/admin/profile');
    }

    private function currentAdminOrLogout(): array
    {
        $sessionAdmin = Auth::admin();
        $admin = $sessionAdmin ? $this->admins->findById((int) $sessionAdmin['id']) : null;

        if ($admin === null) {
            Auth::logoutAdmin();
            redirect('/admin/login');
        }

        return $admin;
    }
}
