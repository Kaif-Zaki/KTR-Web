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
use App\Models\DonationModel;
use App\Models\ProjectModel;

class PublicController
{
    public function home(): void
    {
        View::render('user/home', [
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
        $project = (new ProjectModel())->find($id);

        if ($project === null) {
            http_response_code(404);
            echo 'Project not found';
            return;
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

    public function donate(): void
    {
        $projects = (new ProjectModel())->allPublicSimple();

        View::render('user/donate/index', [
            'projects' => $projects,
            'success' => Session::flash('success'),
            'error' => Session::flash('error'),
            'csrfToken' => Csrf::token(),
            'activePage' => 'donate',
        ]);
    }

    public function submitDonation(): void
    {
        if (!Csrf::verify($_POST['_csrf'] ?? null)) {
            Session::flash('error', 'Invalid request token. Please try again.');
            redirect('/donate');
        }

        $name = trim((string) ($_POST['donor_name'] ?? ''));
        $email = strtolower(trim((string) ($_POST['email'] ?? '')));
        $amount = (float) ($_POST['amount'] ?? 0);
        $message = trim((string) ($_POST['message'] ?? ''));
        $projectId = (int) ($_POST['project_id'] ?? 0);

        if ($name === '' || $email === '' || $amount <= 0) {
            Session::flash('error', 'Name, email, and amount are required.');
            redirect('/donate');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Session::flash('error', 'Please enter a valid email address.');
            redirect('/donate');
        }

        (new DonationModel())->create([
            'donor_name' => $name,
            'email' => $email,
            'amount_lkr' => $amount,
            'project_id' => $projectId > 0 ? $projectId : null,
            'message' => $message === '' ? null : $message,
        ]);

        $adminEmail = (string) config('mail.contact_admin_email');
        if ($adminEmail !== '') {
            (new EmailJsMailer())->sendContactEmail(
                $adminEmail,
                'New Donation Intent',
                "Donor: {$name}\nEmail: {$email}\nAmount: {$amount}\nMessage: {$message}",
                $name,
                $email
            );
        }

        Session::flash('success', 'Thank you. Your donation request was submitted.');
        redirect('/donate');
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
