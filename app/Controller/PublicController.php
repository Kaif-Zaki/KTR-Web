<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\Csrf;
use App\Core\Session;
use App\Core\View;
use App\Model\AboutModel;
use App\Model\CategoryModel;
use App\Model\ProjectModel;

class PublicController
{
    public function home(): void
    {
        View::render('public/home', [
            'activePage' => 'home',
        ]);
    }

    public function about(): void
    {
        $about = (new AboutModel())->first();

        View::render('public/about', [
            'about' => $about,
            'activePage' => 'about',
        ]);
    }

    public function projects(): void
    {
        $categories = (new CategoryModel())->all();
        $selectedCategoryId = isset($_GET['category']) ? (int) $_GET['category'] : null;
        $search = trim((string) ($_GET['search'] ?? ''));
        $projects = (new ProjectModel())->groupedByCategory($selectedCategoryId ?: null, $search);

        View::render('public/projects', [
            'categories' => $categories,
            'projects' => $projects,
            'selectedCategoryId' => $selectedCategoryId,
            'search' => $search,
            'activePage' => 'projects',
        ]);
    }

    public function contact(): void
    {
        View::render('public/contact', [
            'contactSuccess' => Session::flash('success'),
            'contactError' => Session::flash('error'),
            'csrfToken' => Csrf::token(),
            'activePage' => 'contact',
        ]);
    }
}
