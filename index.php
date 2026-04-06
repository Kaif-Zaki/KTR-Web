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

use App\Controller\AdminAuthController;
use App\Controller\AdminDashboardController;
use App\Controller\AdminPasswordResetController;
use App\Controller\AdminProfileController;
use App\Controller\AdminProjectController;
use App\Controller\PublicController;
use App\Core\Session;

Session::start();

$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

$public = new PublicController();
$auth = new AdminAuthController();
$dashboard = new AdminDashboardController();
$passwordReset = new AdminPasswordResetController();
$profile = new AdminProfileController();
$projects = new AdminProjectController();

if ($uri === '/' && $method === 'GET') {
    $public->home();
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

if ($uri === '/admin/projects/create' && $method === 'GET') {
    $projects->createForm();
    exit;
}

if ($uri === '/admin/projects/create' && $method === 'POST') {
    $projects->create();
    exit;
}

if ($uri === '/admin/projects/edit' && $method === 'GET') {
    $id = (int) ($_GET['id'] ?? 0);
    $projects->editForm($id);
    exit;
}

if ($uri === '/admin/projects/edit' && $method === 'POST') {
    $id = (int) ($_GET['id'] ?? 0);
    $projects->edit($id);
    exit;
}

if ($uri === '/admin/projects/delete' && $method === 'POST') {
    $id = (int) ($_GET['id'] ?? 0);
    $projects->delete($id);
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
