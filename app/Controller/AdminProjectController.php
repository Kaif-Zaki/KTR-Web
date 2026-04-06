<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\Auth;
use App\Core\Csrf;
use App\Core\Session;
use App\Core\View;
use App\Model\CategoryModel;
use App\Model\ProjectModel;

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
        ], 'layouts/admin');
    }

    public function createForm(): void
    {
        Auth::requireAdmin();
        View::render('admin/projects/form', [
            'csrfToken' => Csrf::token(),
            'project' => null,
            'categories' => $this->categories->all(),
            'action' => '/admin/projects/create',
            'heading' => 'Add New Project',
            'error' => Session::flash('error'),
        ], 'layouts/admin');
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
            redirect('/admin/projects/create');
        }

        $this->projects->create($data);
        Session::flash('success', 'Project created successfully.');
        redirect('/admin/projects');
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
            'action' => '/admin/projects/edit?id=' . $id,
            'heading' => 'Edit Project',
            'error' => Session::flash('error'),
        ], 'layouts/admin');
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

        $this->projects->update($id, $data);
        Session::flash('success', 'Project updated successfully.');
        redirect('/admin/projects');
    }

    public function delete(int $id): void
    {
        Auth::requireAdmin();

        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Invalid request token.');
            redirect('/admin/projects');
        }

        $this->projects->delete($id);
        Session::flash('success', 'Project deleted successfully.');
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
            Session::flash('error', 'Category and title are required.');
            return null;
        }

        $amountValue = $amount === '' ? null : (float) $amount;
        $dateValue = $projectDate === '' ? null : $projectDate;

        return [
            'category_id' => $categoryId,
            'title' => $title,
            'description' => $description === '' ? null : $description,
            'photo_status' => $photoStatus === '' ? 'NO Photos' : $photoStatus,
            'amount_lkr' => $amountValue,
            'project_date' => $dateValue,
        ];
    }
}
