<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\Auth;
use App\Core\View;
use App\Model\CategoryModel;
use App\Model\ContactMessageModel;
use App\Model\ProjectModel;

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
        ], 'layouts/admin');
    }
}
