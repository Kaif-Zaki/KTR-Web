<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Csrf;
use App\Core\Session;
use App\Core\View;
use App\Models\CategoryModel;
use App\Models\ProjectModel;

class AdminProjectController
{
    private ProjectModel $projects;
    private CategoryModel $categories;

    public function __construct()
    {
        $this->projects = new ProjectModel();
        $this->categories = new CategoryModel();
    }

    public function index(): void
    {
        Auth::requireAdmin();
        View::render('admin/projects/index', [
            'rows' => $this->projects->allForAdmin(),
            'success' => Session::flash('success'),
            'error' => Session::flash('error'),
        ], 'admin/layouts/admin');
    }

    public function createForm(): void
    {
        Auth::requireAdmin();
        View::render('admin/projects/form', [
            'csrfToken' => Csrf::token(),
            'project' => null,
            'categories' => $this->categories->all(),
            'action' => url('/admin/projects/create'),
            'heading' => 'Add New Project',
            'error' => Session::flash('error'),
        ], 'admin/layouts/admin');
    }

    public function create(): void
    {
        Auth::requireAdmin();

        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Invalid request token.');
            redirect('/admin/projects');
        }

        $data = $this->validatedData();
        if ($data === null) {
            // Error message is set inside validatedData()
            redirect('/admin/projects/create');
        }

        try {
            $this->projects->create($data);
            Session::flash('success', 'Project created successfully.');
            redirect('/admin/projects');
        } catch (\Throwable $e) {
            error_log('Project Create Error: ' . $e->getMessage());
            Session::flash('error', 'Database Error: ' . $e->getMessage());
            redirect('/admin/projects/create');
        }
    }

    public function editForm(int $id): void
    {
        Auth::requireAdmin();
        $project = $this->projects->find($id);

        if ($project === null) {
            Session::flash('error', 'Project not found.');
            redirect('/admin/projects');
        }

        View::render('admin/projects/form', [
            'csrfToken' => Csrf::token(),
            'project' => $project,
            'categories' => $this->categories->all(),
            'action' => url('/admin/projects/edit?id=' . $id),
            'heading' => 'Edit Project',
            'error' => Session::flash('error'),
        ], 'admin/layouts/admin');
    }

    public function edit(int $id): void
    {
        Auth::requireAdmin();

        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Invalid request token.');
            redirect('/admin/projects');
        }

        $data = $this->validatedData();
        if ($data === null) {
            redirect('/admin/projects/edit?id=' . $id);
        }

        try {
            $this->projects->update($id, $data);
            Session::flash('success', 'Project updated successfully.');
            redirect('/admin/projects'); 
        } catch (\Throwable $e) {
            Session::flash('error', 'Update failed: ' . $e->getMessage());
            redirect('/admin/projects/edit?id=' . $id);
        }
    }

    public function delete(int $id): void
    {
        Auth::requireAdmin();

        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Invalid request token.');
            redirect('/admin/projects');
        }

        if ($id <= 0) {
            Session::flash('error', 'Invalid project selected for deletion.');
            redirect('/admin/projects');
        }

        $existing = $this->projects->find($id);
        if ($existing === null) {
            Session::flash('error', 'Project not found.');
            redirect('/admin/projects');
        }

        try {
            $this->projects->delete($id);
            Session::flash('success', 'Project deleted successfully.');
        } catch (\Throwable $e) {
            Session::flash('error', 'Delete failed: ' . $e->getMessage());
        }

        redirect('/admin/projects');
    }

    private function validatedData(): ?array
    {
        $categoryId = (int) ($_POST['category_id'] ?? 0);
        $title = trim((string) ($_POST['title'] ?? ''));
        $description = trim((string) ($_POST['description'] ?? ''));
        $photoStatus = trim((string) ($_POST['photo_status'] ?? 'NO Photos'));
        $amount = trim((string) ($_POST['amount_lkr'] ?? ''));
        $projectDate = trim((string) ($_POST['project_date'] ?? ''));

        if ($categoryId <= 0 || $title === '') {
            Session::flash('error', 'Please select a category and enter a title.');
            return null;
        }

        return [
            'category_id'  => $categoryId,
            'title'        => $title,
            'description'  => $description === '' ? null : $description,
            'photo_status' => $photoStatus,
            'amount_lkr'   => $amount === '' ? null : (float) $amount,
            'project_date' => $projectDate === '' ? null : $projectDate,
        ];
    }
}
