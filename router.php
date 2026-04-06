<?php
// Get the current URL
$request = $_SERVER['REQUEST_URI'];

// Define your base project folder
$base_path = '/kottramulla-website';

// Remove the base path to get the clean route
$route = str_replace($base_path, '', $request);

// Remove query strings (e.g., ?id=1) for clean matching
$route = explode('?', $route)[0];

switch ($route) {
    case '/':
    case '':
    case '/home':
        require_once __DIR__ . '/views/user/home.php';
        break;

    case '/projects':
        $controller = new ProjectController($projectModel);
        $controller->index();
        break;

    case '/project-details':
        $id = $_GET['id'] ?? null;
        $controller = new ProjectController($projectModel);
        $controller->show($id);
        break;

    case '/gallery':
        $controller = new GalleryController($galleryModel);
        $controller->index();
        break;
        
    case '/donate':
        $controller = new DonationController($donationModel, $projectModel);
        $controller->showForm();
        break;

    case '/donate/submit':
        $controller = new DonationController($donationModel, $projectModel);
        $controller->store();
        break;

    default:
        http_response_code(404);
        require_once __DIR__ . '/views/user/404.php';
        break;
}