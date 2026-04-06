<?php
class ProjectController {
    private $projectModel;

    public function __construct($model) {
        $this->projectModel = $model;
    }

    // Public: Lists all projects
    public function index() {
        $stmt = $this->projectModel->getAll();
        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once __DIR__ . '/../../views/user/projects/index.php';
    }

    // Public: Displays a single project with its details
    public function show($id) {
        $project = $this->projectModel->getById($id);
        require_once __DIR__ . '/../../views/user/projects/show.php';
    }

    // Public: Filters by category (e.g., 'Emergency Relief')
    public function byCategory($cat) {
        $stmt = $this->projectModel->getByCategory($cat);
        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once __DIR__ . '/../../views/user/projects/index.php';
    }
}