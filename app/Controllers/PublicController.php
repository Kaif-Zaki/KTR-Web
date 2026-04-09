<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Csrf;
use App\Core\EmailJsMailer;
use App\Core\Session;
use App\Core\View;
use App\Models\AboutModel;
use App\Models\CategoryModel;
use App\Models\ContactMessageModel;


use App\Models\ProjectModel;

class PublicController
{
    public function home(): void
    {
        $settings = (new \App\Models\HomeSettingsModel())->get();
        $features = (new \App\Models\HomeFeatureModel())->all();

        View::render('user/home', [
            'settings' => $settings,
            'features' => $features,
            'activePage' => 'home',
        ]);
    }

    public function about(): void
    {
        $about = (new AboutModel())->first();

        View::render('user/about', [
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

        View::render('user/projects/index', [
            'categories' => $categories,
            'projects' => $projects,
            'selectedCategoryId' => $selectedCategoryId,
            'search' => $search,
            'activePage' => 'projects',
        ]);
    }

    public function projectDetails(int $id): void
    {
        if ($id <= 0) {
            redirect('/projects');
        }

        $project = (new ProjectModel())->find($id);

        if ($project === null) {
            redirect('/projects');
        }

        View::render('user/projects/show', [
            'project' => $project,
            'activePage' => 'projects',
        ]);
    }

    public function gallery(): void
    {
        $images = (new \App\Models\GalleryModel())->all();

        View::render('user/gallery/index', [
            'images' => $images,
            'activePage' => 'gallery',
        ]);
    }



    public function contact(): void
    {
        View::render('user/contact', [
            'contactSuccess' => Session::flash('success'),
            'contactError' => Session::flash('error'),
            'csrfToken' => Csrf::token(),
            'activePage' => 'contact',
        ]);
    }


}
