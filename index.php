<?php
/**
 * FRONT CONTROLLER
 * Entry point for all requests to the Kottramulla website.
 */

// 1. Error Reporting (Useful during development)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2. Load .env manually (no Composer needed)
$envFile = __DIR__ . '/.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (str_starts_with(trim($line), '#')) continue;
        [$key, $value] = explode('=', $line, 2);
        $_ENV[trim($key)] = trim($value);
    }
}

// 3. Include Core Configuration & Helpers
require_once __DIR__ . '/config/database.php';

// 4. Include Models
require_once __DIR__ . '/app/Models/Project.php';
require_once __DIR__ . '/app/Models/Donation.php';
require_once __DIR__ . '/app/Models/Gallery.php';

// 5. Include Controllers
require_once __DIR__ . '/app/Controllers/ProjectController.php';
require_once __DIR__ . '/app/Controllers/DonationController.php';
require_once __DIR__ . '/app/Controllers/GalleryController.php';

// 6. Initialize Database Connection
$database = new Database();
$db = $database->getConnection();

// 7. Initialize Model Instances
$projectModel = new Project($db);
$donationModel = new Donation($db);
$galleryModel = new Gallery($db);

// 8. Load the Router
require_once __DIR__ . '/router.php';