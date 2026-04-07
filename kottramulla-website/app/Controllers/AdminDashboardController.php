<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Core\View;
use App\Models\CategoryModel;
use App\Models\ContactMessageModel;
use App\Models\ProjectModel;

class AdminDashboardController
{
    public function index(): void
    {
        Auth::requireAdmin();

        View::render('admin/dashboard', [
            'admin' => Auth::admin(),
            'projectCount' => (new ProjectModel())->count(),
            'unreadMessages' => (new ContactMessageModel())->unreadCount(),
            'categories' => (new CategoryModel())->all(),
        ], 'admin/layouts/admin');
    }
}
