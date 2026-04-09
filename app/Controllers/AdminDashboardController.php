<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Core\View;
use App\Models\CategoryModel;
use App\Models\ContactMessageModel;
use App\Models\GalleryModel;
use App\Models\MemberModel;
use App\Models\ProjectModel;

class AdminDashboardController
{
    public function index(): void
    {
        Auth::requireAdmin();

        $msgModel = new ContactMessageModel();
        $recentMessages = array_slice($msgModel->all(), 0, 5);

        View::render('admin/dashboard', [
            'admin'          => Auth::admin(),
            'projectCount'   => (new ProjectModel())->count(),
            'unreadMessages' => $msgModel->unreadCount(),
            'categories'     => (new CategoryModel())->all(),
            'memberCount'    => count((new MemberModel())->all()),
            'galleryCount'   => count((new GalleryModel())->all()),
            'recentMessages' => $recentMessages,
        ], 'admin/layouts/admin');
    }
}
