<?php

declare(strict_types=1);

require __DIR__ . '/app/Support/env.php';
require __DIR__ . '/app/Support/helpers.php';
load_env(__DIR__ . '/.env');

spl_autoload_register(static function (string $class): void {
    $prefix = 'App\\';

    if (!str_starts_with($class, $prefix)) {
        return;
    }

    $relative = str_replace('\\', '/', substr($class, strlen($prefix)));
    $path = __DIR__ . '/app/' . $relative . '.php';

    if (file_exists($path)) {
        require $path;
    }
});

date_default_timezone_set((string) config('app.timezone'));

use App\Controllers\AdminAuthController;
use App\Controllers\AdminDashboardController;
use App\Controllers\AdminMessageController;
use App\Controllers\AdminPasswordResetController;
use App\Controllers\AdminProfileController;
use App\Controllers\AdminProjectController;
use App\Controllers\AdminGalleryController;
use App\Controllers\PublicContactController;
use App\Controllers\PublicController;
use App\Core\Session;

Session::start();

$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

// Dynamically handle subdirectory hosting (e.g. inside XAMPP htdocs)
$basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
if ($basePath !== '/' && str_starts_with($uri, $basePath)) {
    $uri = substr($uri, strlen($basePath));
}
if ($uri === '') {
    $uri = '/';
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

$public = new PublicController();
$publicContact = new PublicContactController();
$auth = new AdminAuthController();
$dashboard = new AdminDashboardController();
$messages = new AdminMessageController();
$passwordReset = new AdminPasswordResetController();
$profile = new AdminProfileController();
$projects = new AdminProjectController();
$adminGallery = new AdminGalleryController();

if (($uri === '/' || $uri === '/home') && $method === 'GET') {
    $public->home();
    exit;
}

if ($uri === '/about' && $method === 'GET') {
    $public->about();
    exit;
}

if ($uri === '/projects' && $method === 'GET') {
    $public->projects();
    exit;
}

if ($uri === '/project-details' && $method === 'GET') {
    $public->projectDetails((int) ($_GET['id'] ?? 0));
    exit;
}

if ($uri === '/gallery' && $method === 'GET') {
    $public->gallery();
    exit;
}

if ($uri === '/donate' && $method === 'GET') {
    $public->donate();
    exit;
}

if ($uri === '/donate' && $method === 'POST') {
    $public->submitDonation();
    exit;
}

if ($uri === '/contact' && $method === 'GET') {
    $public->contact();
    exit;
}

if ($uri === '/contact' && $method === 'POST') {
    $publicContact->submit();
    exit;
}

if ($uri === '/admin/login' && $method === 'GET') {
    $auth->showLogin();
    exit;
}

if ($uri === '/admin/login' && $method === 'POST') {
    $auth->login();
    exit;
}

if ($uri === '/admin/forgot-password' && $method === 'GET') {
    $passwordReset->showForgotForm();
    exit;
}

if ($uri === '/admin/forgot-password' && $method === 'POST') {
    $passwordReset->requestResetCode();
    exit;
}

if ($uri === '/admin/reset-password' && $method === 'GET') {
    $passwordReset->showResetForm();
    exit;
}

if ($uri === '/admin/reset-password' && $method === 'POST') {
    $passwordReset->resetPassword();
    exit;
}

if ($uri === '/admin/logout' && $method === 'POST') {
    $auth->logout();
    exit;
}

if ($uri === '/admin' && $method === 'GET') {
    $dashboard->index();
    exit;
}

if ($uri === '/admin/projects' && $method === 'GET') {
    $projects->index();
    exit;
}

if ($uri === '/admin/messages' && $method === 'GET') {
    $messages->index();
    exit;
}

if ($uri === '/admin/messages/reply' && $method === 'POST') {
    $messages->reply();
    exit;
}

if ($uri === '/admin/projects/create' && $method === 'GET') {
    $projects->createForm();
    exit;
}

if ($uri === '/admin/projects/create' && $method === 'POST') {
    $projects->create();
    exit;
}

if ($uri === '/admin/projects/edit' && $method === 'GET') {
    $projects->editForm((int) ($_GET['id'] ?? 0));
    exit;
}

if ($uri === '/admin/projects/edit' && $method === 'POST') {
    $projects->edit((int) ($_GET['id'] ?? 0));
    exit;
}

if ($uri === '/admin/projects/delete' && $method === 'POST') {
    $projects->delete((int) ($_GET['id'] ?? 0));
    exit;
}

if ($uri === '/admin/gallery' && $method === 'GET') {
    $adminGallery->index();
    exit;
}

if ($uri === '/admin/gallery/create' && $method === 'GET') {
    $adminGallery->createForm();
    exit;
}

if ($uri === '/admin/gallery/create' && $method === 'POST') {
    $adminGallery->create();
    exit;
}

if ($uri === '/admin/gallery/edit' && $method === 'GET') {
    $adminGallery->editForm((int) ($_GET['id'] ?? 0));
    exit;
}

if ($uri === '/admin/gallery/edit' && $method === 'POST') {
    $adminGallery->edit((int) ($_GET['id'] ?? 0));
    exit;
}

if ($uri === '/admin/gallery/delete' && $method === 'POST') {
    $adminGallery->delete((int) ($_GET['id'] ?? 0));
    exit;
}

if ($uri === '/admin/profile' && $method === 'GET') {
    $profile->show();
    exit;
}

if ($uri === '/admin/profile/email' && $method === 'POST') {
    $profile->updateEmail();
    exit;
}

if ($uri === '/admin/profile/password' && $method === 'POST') {
    $profile->updatePassword();
    exit;
}

http_response_code(404);
echo '404 - Page not found';
