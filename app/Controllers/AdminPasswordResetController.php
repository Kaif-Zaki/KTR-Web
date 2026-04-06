<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Csrf;
use App\Core\EmailJsMailer;
use App\Core\Session;
use App\Core\View;
use App\Models\AdminModel;
use App\Models\AdminPasswordResetModel;

class AdminPasswordResetController
{
    private AdminModel $admins;
    private AdminPasswordResetModel $resets;
    private EmailJsMailer $mailer;

    public function __construct()
    {
        $this->admins = new AdminModel();
        $this->resets = new AdminPasswordResetModel();
        $this->mailer = new EmailJsMailer();
    }

    public function showForgotForm(): void
    {
        View::render('admin/auth/forgot_password', [
            'error' => Session::flash('error'),
            'success' => Session::flash('success'),
            'csrfToken' => Csrf::token(),
            'pageTitle' => 'Forgot Password',
        ], 'admin/layouts/admin_auth');
    }

    public function requestResetCode(): void
    {
        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Invalid request token. Please try again.');
            redirect('/admin/forgot-password');
        }

        $email = strtolower(trim((string) ($_POST['email'] ?? '')));

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Session::flash('error', 'Please enter a valid email address.');
            redirect('/admin/forgot-password');
        }

        $admin = $this->admins->findByEmail($email);

        if ($admin !== null) {
            $code = (string) random_int(100000, 999999);
            $expiresMinutes = 15;
            $expiresAt = date('Y-m-d H:i:s', time() + ($expiresMinutes * 60));

            $this->resets->invalidateActiveTokens((int) $admin['id']);
            $resetId = $this->resets->createToken((int) $admin['id'], hash('sha256', $code), $expiresAt);
            $sent = $this->mailer->sendPasswordResetCode($email, $code, $expiresMinutes);

            if (!$sent) {
                $this->resets->markUsed($resetId);
                Session::flash('error', 'Unable to send reset email right now. Check EmailJS keys/service/template settings.');
                redirect('/admin/forgot-password');
            }
        }

        Session::flash('success', 'If the email exists, a reset code has been sent.');
        redirect('/admin/reset-password');
    }

    public function showResetForm(): void
    {
        View::render('admin/auth/reset_password', [
            'error' => Session::flash('error'),
            'success' => Session::flash('success'),
            'csrfToken' => Csrf::token(),
            'prefillEmail' => (string) ($_GET['email'] ?? ''),
            'pageTitle' => 'Reset Password',
        ], 'admin/layouts/admin_auth');
    }

    public function resetPassword(): void
    {
        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Invalid request token. Please try again.');
            redirect('/admin/reset-password');
        }

        $email = strtolower(trim((string) ($_POST['email'] ?? '')));
        $token = trim((string) ($_POST['token'] ?? ''));
        $newPassword = (string) ($_POST['new_password'] ?? '');
        $confirmPassword = (string) ($_POST['new_password_confirmation'] ?? '');

        if ($email === '' || $token === '' || $newPassword === '' || $confirmPassword === '') {
            Session::flash('error', 'All fields are required.');
            redirect('/admin/reset-password');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Session::flash('error', 'Please enter a valid email address.');
            redirect('/admin/reset-password');
        }

        if ($newPassword !== $confirmPassword) {
            Session::flash('error', 'New password and confirmation do not match.');
            redirect('/admin/reset-password');
        }

        $admin = $this->admins->findByEmail($email);
        if ($admin === null) {
            Session::flash('error', 'Invalid email or reset code.');
            redirect('/admin/reset-password');
        }

        if (password_verify($newPassword, $admin['password_hash'])) {
            Session::flash('error', 'New password must be different from current password.');
            redirect('/admin/reset-password');
        }

        $reset = $this->resets->findValidToken((int) $admin['id'], hash('sha256', $token));
        if ($reset === null) {
            Session::flash('error', 'Invalid or expired reset code.');
            redirect('/admin/reset-password');
        }

        $this->admins->updatePassword((int) $admin['id'], password_hash($newPassword, PASSWORD_DEFAULT));
        $this->resets->markUsed((int) $reset['id']);
        $this->resets->invalidateActiveTokens((int) $admin['id']);

        Session::flash('success', 'Password reset successful. You can now log in.');
        redirect('/admin/login');
    }
}
