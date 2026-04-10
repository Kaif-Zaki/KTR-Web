<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Csrf;
use App\Core\Session;
use App\Core\View;
use App\Models\HomeSettingsModel;
use App\Models\HomeFeatureModel;

class AdminHomeController
{
    private HomeSettingsModel $settings;
    private HomeFeatureModel $features;

    public function __construct()
    {
        $this->settings = new HomeSettingsModel();
        $this->features = new HomeFeatureModel();
    }

    public function index(): void
    {
        Auth::requireAdmin();
        View::render('admin/home/editor', [
            'settings' => $this->settings->get(),
            'features' => $this->features->all(),
            'csrfToken' => Csrf::token(),
            'success' => Session::flash('success'),
            'error' => Session::flash('error'),
        ], 'admin/layouts/admin');
    }

    public function updateSettings(): void
    {
        Auth::requireAdmin();

        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Invalid request token.');
            redirect('/admin/home');
        }

        $data = [
            'hero_kicker' => trim((string) ($_POST['hero_kicker'] ?? '')),
            'hero_title'  => trim((string) ($_POST['hero_title'] ?? '')),
            'hero_subtitle' => trim((string) ($_POST['hero_subtitle'] ?? '')),
            'hero_lead'   => trim((string) ($_POST['hero_lead'] ?? '')),
            'legacy_kicker' => trim((string) ($_POST['legacy_kicker'] ?? '')),
            'legacy_title'  => trim((string) ($_POST['legacy_title'] ?? '')),
            'legacy_body'   => trim((string) ($_POST['legacy_body'] ?? '')),
            'stat1_num'     => trim((string) ($_POST['stat1_num'] ?? '')),
            'stat1_label'   => trim((string) ($_POST['stat1_label'] ?? '')),
            'stat2_num'     => trim((string) ($_POST['stat2_num'] ?? '')),
            'stat2_label'   => trim((string) ($_POST['stat2_label'] ?? '')),
            'initiatives_kicker' => trim((string) ($_POST['initiatives_kicker'] ?? '')),
            'initiatives_title'  => trim((string) ($_POST['initiatives_title'] ?? '')),
            'initiatives_lead'   => trim((string) ($_POST['initiatives_lead'] ?? '')),
            'cta_title'          => trim((string) ($_POST['cta_title'] ?? '')),
            'cta_body'           => trim((string) ($_POST['cta_body'] ?? '')),
            'journey_kicker'     => trim((string) ($_POST['journey_kicker'] ?? '')),
            'journey_title'      => trim((string) ($_POST['journey_title'] ?? '')),
            'journey_lead'       => trim((string) ($_POST['journey_lead'] ?? '')),
            'journey_item1_year' => trim((string) ($_POST['journey_item1_year'] ?? '')),
            'journey_item1_title' => trim((string) ($_POST['journey_item1_title'] ?? '')),
            'journey_item1_body' => trim((string) ($_POST['journey_item1_body'] ?? '')),
            'journey_item2_year' => trim((string) ($_POST['journey_item2_year'] ?? '')),
            'journey_item2_title' => trim((string) ($_POST['journey_item2_title'] ?? '')),
            'journey_item2_body' => trim((string) ($_POST['journey_item2_body'] ?? '')),
            'journey_item3_year' => trim((string) ($_POST['journey_item3_year'] ?? '')),
            'journey_item3_title' => trim((string) ($_POST['journey_item3_title'] ?? '')),
            'journey_item3_body' => trim((string) ($_POST['journey_item3_body'] ?? '')),
            'approach_kicker'    => trim((string) ($_POST['approach_kicker'] ?? '')),
            'approach_title'     => trim((string) ($_POST['approach_title'] ?? '')),
            'approach_item1_title' => trim((string) ($_POST['approach_item1_title'] ?? '')),
            'approach_item1_body' => trim((string) ($_POST['approach_item1_body'] ?? '')),
            'approach_item2_title' => trim((string) ($_POST['approach_item2_title'] ?? '')),
            'approach_item2_body' => trim((string) ($_POST['approach_item2_body'] ?? '')),
            'approach_item3_title' => trim((string) ($_POST['approach_item3_title'] ?? '')),
            'approach_item3_body' => trim((string) ($_POST['approach_item3_body'] ?? '')),
            'approach_item4_title' => trim((string) ($_POST['approach_item4_title'] ?? '')),
            'approach_item4_body' => trim((string) ($_POST['approach_item4_body'] ?? '')),
        ];

        // Handle Images
        $heroFile = $_FILES['hero_image'] ?? null;
        if ($heroFile && $heroFile['error'] === UPLOAD_ERR_OK) {
            $data['hero_image'] = $this->handleUpload($heroFile, 'home');
        }

        $legacyFile = $_FILES['legacy_image'] ?? null;
        if ($legacyFile && $legacyFile['error'] === UPLOAD_ERR_OK) {
            $data['legacy_image'] = $this->handleUpload($legacyFile, 'home');
        }

        try {
            $this->settings->update($data);
            Session::flash('success', 'Home page settings updated successfully.');
        } catch (\Throwable $e) {
            Session::flash('error', 'Update failed: ' . $e->getMessage());
        }

        redirect('/admin/home');
    }

    public function createFeature(): void
    {
        Auth::requireAdmin();
        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Invalid token.');
            redirect('/admin/home');
        }

        $data = [
            'icon'        => trim((string) ($_POST['icon'] ?? '✨')),
            'title'       => trim((string) ($_POST['title'] ?? '')),
            'description' => trim((string) ($_POST['description'] ?? '')),
            'sort_order'  => (int) ($_POST['sort_order'] ?? 0),
        ];

        $this->features->create($data);
        Session::flash('success', 'Feature added.');
        redirect('/admin/home');
    }

    public function updateFeature(int $id): void
    {
        Auth::requireAdmin();
        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Invalid token.');
            redirect('/admin/home');
        }

        $data = [
            'icon'        => trim((string) ($_POST['icon'] ?? '✨')),
            'title'       => trim((string) ($_POST['title'] ?? '')),
            'description' => trim((string) ($_POST['description'] ?? '')),
            'sort_order'  => (int) ($_POST['sort_order'] ?? 0),
        ];

        $this->features->update($id, $data);
        Session::flash('success', 'Feature updated.');
        redirect('/admin/home');
    }

    public function deleteFeature(int $id): void
    {
        Auth::requireAdmin();
        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Invalid token.');
            redirect('/admin/home');
        }

        $this->features->delete($id);
        Session::flash('success', 'Feature deleted.');
        redirect('/admin/home');
    }

    private function handleUpload(array $file, string $subfolder): ?string
    {
        $allowedExts = ['jpg', 'jpeg', 'png', 'webp', 'svg'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowedExts, true)) {
            return null;
        }

        $filename = bin2hex(random_bytes(8)) . '.' . $ext;
        $uploadDir = __DIR__ . '/../../public/images/' . $subfolder . '/';
        
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if (move_uploaded_file($file['tmp_name'], $uploadDir . $filename)) {
            return $filename;
        }

        return null;
    }
}
