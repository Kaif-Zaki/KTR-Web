<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Csrf;
use App\Core\Session;
use App\Core\View;
use App\Models\WebsiteSettingsModel;

class AdminSettingsController
{
    private WebsiteSettingsModel $settings;

    public function __construct()
    {
        $this->settings = new WebsiteSettingsModel();
    }

    public function index(): void
    {
        Auth::requireAdmin();
        View::render('admin/settings/show', [
            'settings' => $this->settings->get(),
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
            redirect('/admin/settings');
        }

        $data = [
            'website_title' => trim((string) ($_POST['website_title'] ?? '')),
            'website_description' => trim((string) ($_POST['website_description'] ?? '')),
            'logo_alt_text' => trim((string) ($_POST['logo_alt_text'] ?? '')),
            'footer_copyright_text' => trim((string) ($_POST['footer_copyright_text'] ?? '')),
            'footer_email' => trim((string) ($_POST['footer_email'] ?? '')),
            'footer_phone' => trim((string) ($_POST['footer_phone'] ?? '')),
            'footer_address' => trim((string) ($_POST['footer_address'] ?? '')),
            'social_facebook' => trim((string) ($_POST['social_facebook'] ?? '')),
            'social_twitter' => trim((string) ($_POST['social_twitter'] ?? '')),
            'social_instagram' => trim((string) ($_POST['social_instagram'] ?? '')),
            'social_linkedin' => trim((string) ($_POST['social_linkedin'] ?? '')),
            'social_youtube' => trim((string) ($_POST['social_youtube'] ?? '')),
            'primary_color' => trim((string) ($_POST['primary_color'] ?? '#1e40af')),
            'secondary_color' => trim((string) ($_POST['secondary_color'] ?? '#7c3aed')),
            'accent_color' => trim((string) ($_POST['accent_color'] ?? '#f59e0b')),
        ];

        // Handle Logo Upload
        $logoFile = $_FILES['logo'] ?? null;
        if ($logoFile && $logoFile['error'] === UPLOAD_ERR_OK) {
            $data['logo_path'] = $this->handleUpload($logoFile, 'logos');
        }

        // Handle Favicon Upload
        $faviconFile = $_FILES['favicon'] ?? null;
        if ($faviconFile && $faviconFile['error'] === UPLOAD_ERR_OK) {
            $data['favicon_path'] = $this->handleUpload($faviconFile, 'favicons');
        }

        try {
            $this->settings->update($data);
            Session::flash('success', 'Website settings updated successfully.');
        } catch (\Throwable $e) {
            Session::flash('error', 'Update failed: ' . $e->getMessage());
        }

        redirect('/admin/settings');
    }

    private function handleUpload(array $file, string $folder): ?string
    {
        $uploadsDir = __DIR__ . '/../../public/images/' . $folder;
        
        if (!is_dir($uploadsDir)) {
            mkdir($uploadsDir, 0755, true);
        }

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowedExts = ['jpg', 'jpeg', 'png', 'gif', 'svg'];

        if (!in_array($ext, $allowedExts)) {
            throw new \Exception("Invalid file type. Only JPG, PNG, GIF, and SVG are allowed.");
        }

        $filename = uniqid('img_', true) . '.' . $ext;
        $destination = $uploadsDir . '/' . $filename;

        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            throw new \Exception("Failed to upload file.");
        }

        return "images/{$folder}/{$filename}";
    }
}
