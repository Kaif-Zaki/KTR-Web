<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Csrf;
use App\Core\Session;
use App\Core\View;
use App\Models\GalleryModel;
use App\Models\ProjectModel;

class AdminGalleryController
{
    private GalleryModel $gallery;
    private ProjectModel $projects;

    public function __construct()
    {
        $this->gallery = new GalleryModel();
        $this->projects = new ProjectModel();
    }

    public function index(): void
    {
        Auth::requireAdmin();
        View::render('admin/gallery/index', [
            'rows' => $this->gallery->all(),
            'success' => Session::flash('success'),
            'error' => Session::flash('error'),
        ], 'admin/layouts/admin');
    }

    public function createForm(): void
    {
        Auth::requireAdmin();
        View::render('admin/gallery/form', [
            'csrfToken' => Csrf::token(),
            'item' => null,
            'projects' => $this->projects->allPublicSimple(),
            'action' => url('/admin/gallery/create'),
            'heading' => 'Add New Gallery Image',
            'error' => Session::flash('error'),
        ], 'admin/layouts/admin');
    }

    public function create(): void
    {
        Auth::requireAdmin();

        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Invalid request token.');
            redirect('/admin/gallery');
        }

        $caption = trim((string) ($_POST['caption'] ?? ''));
        $projectId = (int) ($_POST['project_id'] ?? 0);
        $file = $_FILES['image'] ?? null;

        if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
            Session::flash('error', 'Image file is required.');
            redirect('/admin/gallery/create');
        }

        $allowedExts = ['jpg', 'jpeg', 'png', 'webp'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowedExts, true)) {
            Session::flash('error', 'Invalid image format. Allowed: ' . implode(', ', $allowedExts));
            redirect('/admin/gallery/create');
        }

        $filename = bin2hex(random_bytes(8)) . '.' . $ext;
        $uploadDir = __DIR__ . '/../../public/images/gallery/';
        
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if (!move_uploaded_file($file['tmp_name'], $uploadDir . $filename)) {
            Session::flash('error', 'Failed to move uploaded file.');
            redirect('/admin/gallery/create');
        }

        $this->gallery->create([
            'project_id' => $projectId > 0 ? $projectId : null,
            'image_path' => $filename,
            'caption' => $caption === '' ? null : $caption,
        ]);

        Session::flash('success', 'Image added to gallery.');
        redirect('/admin/gallery');
    }

    public function editForm(int $id): void
    {
        Auth::requireAdmin();
        $item = $this->gallery->find($id);

        if ($item === null) {
            Session::flash('error', 'Gallery item not found.');
            redirect('/admin/gallery');
        }

        View::render('admin/gallery/form', [
            'csrfToken' => Csrf::token(),
            'item' => $item,
            'projects' => $this->projects->allPublicSimple(),
            'action' => url('/admin/gallery/edit?id=' . $id),
            'heading' => 'Edit Gallery Image Info',
            'error' => Session::flash('error'),
        ], 'admin/layouts/admin');
    }

    public function edit(int $id): void
    {
        Auth::requireAdmin();

        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Invalid request token.');
            redirect('/admin/gallery');
        }

        $item = $this->gallery->find($id);
        if ($item === null) {
            Session::flash('error', 'Gallery item not found.');
            redirect('/admin/gallery');
        }

        $caption = trim((string) ($_POST['caption'] ?? ''));
        $projectId = (int) ($_POST['project_id'] ?? 0);
        $file = $_FILES['image'] ?? null;
        $imagePath = $item['image_path'];

        if ($file && $file['error'] === UPLOAD_ERR_OK) {
            $allowedExts = ['jpg', 'jpeg', 'png', 'webp'];
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

            if (!in_array($ext, $allowedExts, true)) {
                Session::flash('error', 'Invalid image format. Allowed: ' . implode(', ', $allowedExts));
                redirect('/admin/gallery/edit?id=' . $id);
            }

            $imagePath = bin2hex(random_bytes(8)) . '.' . $ext;
            $uploadDir = __DIR__ . '/../../public/images/gallery/';
            
            if (!move_uploaded_file($file['tmp_name'], $uploadDir . $imagePath)) {
                Session::flash('error', 'Failed to move uploaded file.');
                redirect('/admin/gallery/edit?id=' . $id);
            }

            // Delete the old file
            $oldPath = $uploadDir . $item['image_path'];
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            }
        }

        $this->gallery->update($id, [
            'project_id' => $projectId > 0 ? $projectId : null,
            'image_path' => $imagePath,
            'caption' => $caption === '' ? null : $caption,
        ]);

        Session::flash('success', 'Gallery item updated.');
        redirect('/admin/gallery');
    }

    public function delete(int $id): void
    {
        Auth::requireAdmin();

        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Invalid request token.');
            redirect('/admin/gallery');
        }

        $item = $this->gallery->find($id);
        if ($item !== null) {
            $filePath = __DIR__ . '/../../public/images/gallery/' . $item['image_path'];
            if (file_exists($filePath)) {
                @unlink($filePath);
            }
            $this->gallery->delete($id);
            Session::flash('success', 'Gallery item deleted.');
        } else {
            Session::flash('error', 'Item not found.');
        }

        redirect('/admin/gallery');
    }
}
