<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Csrf;
use App\Core\Session;
use App\Core\View;
use App\Models\MemberModel;

class AdminMemberController
{
    private MemberModel $members;

    public function __construct()
    {
        $this->members = new MemberModel();
    }

    public function index(): void
    {
        Auth::requireAdmin();
        View::render('admin/members/index', [
            'rows' => $this->members->all(),
            'success' => Session::flash('success'),
            'error' => Session::flash('error'),
        ], 'admin/layouts/admin');
    }

    public function createForm(): void
    {
        Auth::requireAdmin();
        View::render('admin/members/form', [
            'csrfToken' => Csrf::token(),
            'member' => null,
            'action' => url('/admin/members/create'),
            'heading' => 'Add New Member',
            'error' => Session::flash('error'),
        ], 'admin/layouts/admin');
    }

    public function create(): void
    {
        Auth::requireAdmin();

        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Invalid request token.');
            redirect('/admin/members');
        }

        $data = $this->validatedData(null);
        if ($data === null) {
            redirect('/admin/members/create');
        }

        // Handle File Upload
        $file = $_FILES['image'] ?? null;
        $imagePath = null;

        if ($file && $file['error'] === UPLOAD_ERR_OK) {
            $imagePath = $this->handleUpload($file);
            if ($imagePath === null) {
                redirect('/admin/members/create');
            }
        }

        $data['image_path'] = $imagePath;

        try {
            $this->members->create($data);
            Session::flash('success', 'Member added successfully.');
            redirect('/admin/members');
        } catch (\Throwable $e) {
            error_log('Member Create Error: ' . $e->getMessage());
            Session::flash('error', 'Database Error: ' . $e->getMessage());
            redirect('/admin/members/create');
        }
    }

    public function editForm(int $id): void
    {
        Auth::requireAdmin();
        $member = $this->members->find($id);

        if ($member === null) {
            Session::flash('error', 'Member not found.');
            redirect('/admin/members');
        }

        View::render('admin/members/form', [
            'csrfToken' => Csrf::token(),
            'member' => $member,
            'action' => url('/admin/members/edit?id=' . $id),
            'heading' => 'Edit Member',
            'error' => Session::flash('error'),
        ], 'admin/layouts/admin');
    }

    public function edit(int $id): void
    {
        Auth::requireAdmin();

        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Invalid request token.');
            redirect('/admin/members');
        }

        $member = $this->members->find($id);
        if ($member === null) {
            Session::flash('error', 'Member not found.');
            redirect('/admin/members');
        }

        $data = $this->validatedData($member);
        if ($data === null) {
            redirect('/admin/members/edit?id=' . $id);
        }

        // Handle File Upload
        $file = $_FILES['image'] ?? null;
        $imagePath = $member['image_path'];

        if ($file && $file['error'] === UPLOAD_ERR_OK) {
            $newPath = $this->handleUpload($file);
            if ($newPath === null) {
                redirect('/admin/members/edit?id=' . $id);
            }
            
            // Delete old file
            if ($member['image_path']) {
                $this->deleteFile($member['image_path']);
            }
            $imagePath = $newPath;
        }

        $data['image_path'] = $imagePath;

        try {
            $this->members->update($id, $data);
            Session::flash('success', 'Member updated successfully.');
            redirect('/admin/members');
        } catch (\Throwable $e) {
            Session::flash('error', 'Update failed: ' . $e->getMessage());
            redirect('/admin/members/edit?id=' . $id);
        }
    }

    public function delete(int $id): void
    {
        Auth::requireAdmin();

        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Invalid request token.');
            redirect('/admin/members');
        }

        $member = $this->members->find($id);
        if ($member === null) {
            Session::flash('error', 'Member not found.');
            redirect('/admin/members');
        }

        try {
            if ($member['image_path']) {
                $this->deleteFile($member['image_path']);
            }
            $this->members->delete($id);
            Session::flash('success', 'Member deleted successfully.');
        } catch (\Throwable $e) {
            Session::flash('error', 'Delete failed: ' . $e->getMessage());
        }

        redirect('/admin/members');
    }

    private function handleUpload(array $file): ?string
    {
        $allowedExts = ['jpg', 'jpeg', 'png', 'webp'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowedExts, true)) {
            Session::flash('error', 'Invalid image format. Allowed: ' . implode(', ', $allowedExts));
            return null;
        }

        $filename = bin2hex(random_bytes(8)) . '.' . $ext;
        $uploadDir = __DIR__ . '/../../public/images/members/';
        
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if (!move_uploaded_file($file['tmp_name'], $uploadDir . $filename)) {
            Session::flash('error', 'Failed to move uploaded file.');
            return null;
        }

        return $filename;
    }

    private function deleteFile(string $filename): void
    {
        $filePath = __DIR__ . '/../../public/images/members/' . $filename;
        if (file_exists($filePath)) {
            @unlink($filePath);
        }
    }

    private function validatedData(array $member = null): ?array
    {
        $name = trim((string) ($_POST['name'] ?? ''));
        $occupation = trim((string) ($_POST['occupation'] ?? ''));

        if ($name === '' || $occupation === '') {
            Session::flash('error', 'Please fill all required fields (Name, Position).');
            return null;
        }

        return [
            'name'         => $name,
            'occupation'   => $occupation,
        ];
    }
}
