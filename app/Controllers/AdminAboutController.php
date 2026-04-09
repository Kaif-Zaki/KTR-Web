<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Csrf;
use App\Core\Session;
use App\Core\View;
use App\Models\AboutModel;

class AdminAboutController
{
    private AboutModel $about;

    public function __construct()
    {
        $this->about = new AboutModel();
    }

    public function index(): void
    {
        Auth::requireAdmin();
        View::render('admin/about/editor', [
            'about' => $this->about->first(),
            'csrfToken' => Csrf::token(),
            'success' => Session::flash('success'),
            'error' => Session::flash('error'),
        ], 'admin/layouts/admin');
    }

    public function update(): void
    {
        Auth::requireAdmin();

        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Invalid request token.');
            redirect('/admin/about');
        }

        $data = [
            'title'            => trim((string) ($_POST['title'] ?? '')),
            'body'             => trim((string) ($_POST['body'] ?? '')),
            'quote'            => trim((string) ($_POST['quote'] ?? '')),
            'volunteer_count'  => (int) ($_POST['volunteer_count'] ?? 0),
            'established_year' => (int) ($_POST['established_year'] ?? 0),
        ];

        try {
            $this->about->update($data);
            Session::flash('success', 'About page content updated.');
        } catch (\Throwable $e) {
            Session::flash('error', 'Update failed: ' . $e->getMessage());
        }

        redirect('/admin/about');
    }
}
