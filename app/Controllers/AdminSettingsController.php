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

        $uploadErrors = [];

        // Handle logo upload without breaking the whole settings update.
        $logoFile = $_FILES['logo'] ?? null;
        if (is_array($logoFile) && ((int) ($logoFile['error'] ?? UPLOAD_ERR_NO_FILE)) !== UPLOAD_ERR_NO_FILE) {
            try {
                $data['logo_path'] = $this->handleUpload($logoFile, 'logos');
            } catch (\Throwable $e) {
                $uploadErrors[] = 'Logo upload failed: ' . $e->getMessage();
            }
        }

        // Handle favicon upload without breaking the whole settings update.
        $faviconFile = $_FILES['favicon'] ?? null;
        if (is_array($faviconFile) && ((int) ($faviconFile['error'] ?? UPLOAD_ERR_NO_FILE)) !== UPLOAD_ERR_NO_FILE) {
            try {
                $data['favicon_path'] = $this->handleUpload($faviconFile, 'favicons');
            } catch (\Throwable $e) {
                $uploadErrors[] = 'Favicon upload failed: ' . $e->getMessage();
            }
        }

        try {
            $this->settings->update($data);
            Session::flash('success', 'Website settings updated successfully.');
        } catch (\Throwable $e) {
            Session::flash('error', 'Update failed: ' . $e->getMessage());
            redirect('/admin/settings');
        }

        if (!empty($uploadErrors)) {
            Session::flash('error', implode(' ', $uploadErrors));
        }

        redirect('/admin/settings');
    }

    private function handleUpload(array $file, string $folder): ?string
    {
        $uploadsDir = __DIR__ . '/../../public/images/' . $folder;

        $uploadErrorCode = (int) ($file['error'] ?? UPLOAD_ERR_NO_FILE);
        if ($uploadErrorCode !== UPLOAD_ERR_OK) {
            throw new \Exception($this->uploadErrorMessage($uploadErrorCode));
        }

        if (!is_dir($uploadsDir) && !mkdir($uploadsDir, 0755, true) && !is_dir($uploadsDir)) {
            throw new \Exception('Upload directory is not writable. Please contact the administrator.');
        }

        if (!is_uploaded_file((string) ($file['tmp_name'] ?? ''))) {
            throw new \Exception('Invalid upload request. Please try again.');
        }

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowedExts = ($folder === 'favicons')
            ? ['png', 'ico', 'svg']
            : ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp'];

        if (!in_array($ext, $allowedExts)) {
            if ($folder === 'favicons') {
                throw new \Exception('Invalid favicon type. Only PNG, ICO, and SVG are allowed.');
            }
            throw new \Exception('Invalid logo type. Only JPG, JPEG, PNG, GIF, SVG, and WEBP are allowed.');
        }

        // File size validation
        $maxSizeBytes = ($folder === 'logos') ? 2 * 1024 * 1024 : 512 * 1024; // 2MB for logo, 512KB for favicon
        if ($file['size'] > $maxSizeBytes) {
            $maxSizeMB = $maxSizeBytes / (1024 * 1024);
            throw new \Exception("File size exceeds maximum limit of {$maxSizeMB}MB. Please choose a smaller image.");
        }

        // Dimension validation (for non-SVG files)
        if ($ext !== 'svg' && $ext !== 'ico') {
            $imageInfo = @getimagesize($file['tmp_name']);
            
            if (!$imageInfo) {
                throw new \Exception("Unable to read image. Please ensure it's a valid image file.");
            }

            $width = $imageInfo[0];
            $height = $imageInfo[1];

            if ($folder === 'logos') {
                // Logo: minimum 200x50px, aspect ratio 4:1 to 1:1
                if ($width < 200 || $height < 50) {
                    throw new \Exception("Logo image must be at least 200x50 pixels. Your image is {$width}x{$height}px. Please upload a larger image.");
                }
                $aspectRatio = $width / $height;
                if ($aspectRatio < 1 || $aspectRatio > 4) {
                    throw new \Exception("Logo aspect ratio should be between 1:1 and 4:1. Your image is " . round($aspectRatio, 2) . ":1. Please adjust the image size.");
                }
            } elseif ($folder === 'favicons') {
                // Favicon: minimum 64x64px (recommended 256x256px)
                if ($width < 64 || $height < 64) {
                    throw new \Exception("Favicon must be at least 64x64 pixels (recommended 256x256px). Your image is {$width}x{$height}px. Please upload a larger image.");
                }
                // Favicon should be square
                if ($width !== $height) {
                    throw new \Exception("Favicon must be square (same width and height). Your image is {$width}x{$height}px. Please upload a square image.");
                }
            }
        }

        $filename = uniqid('img_', true) . '.' . $ext;
        $destination = $uploadsDir . '/' . $filename;

        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            throw new \Exception("Failed to upload file.");
        }

        return "images/{$folder}/{$filename}";
    }

    private function uploadErrorMessage(int $errorCode): string
    {
        return match ($errorCode) {
            UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE => 'Uploaded file is too large.',
            UPLOAD_ERR_PARTIAL => 'The file was only partially uploaded. Please try again.',
            UPLOAD_ERR_NO_TMP_DIR => 'Server temporary folder is missing.',
            UPLOAD_ERR_CANT_WRITE => 'Server failed to write the uploaded file.',
            UPLOAD_ERR_EXTENSION => 'File upload was blocked by a server extension.',
            UPLOAD_ERR_NO_FILE => 'No file was uploaded.',
            default => 'Unknown upload error occurred.',
        };
    }
}
