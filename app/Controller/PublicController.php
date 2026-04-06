<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\View;
use App\Model\AboutModel;
use App\Model\CategoryModel;
use App\Model\ProjectModel;

class PublicController
{
    public function home(): void
    {
        $about = (new AboutModel())->first();
        $categories = (new CategoryModel())->all();

        $selectedCategoryId = isset($_GET['category']) ? (int) $_GET['category'] : null;
        $search = trim((string) ($_GET['search'] ?? ''));
        $projects = (new ProjectModel())->groupedByCategory($selectedCategoryId ?: null, $search);

        View::render('public/home', [
            'about' => $about,
            'categories' => $categories,
            'projects' => $projects,
            'selectedCategoryId' => $selectedCategoryId,
            'search' => $search,
        ]);
    }
}
