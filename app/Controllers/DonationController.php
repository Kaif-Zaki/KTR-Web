<?php
class DonationController {
    private $donationModel;
    private $projectModel;

    public function __construct($donationModel, $projectModel) {
        $this->donationModel = $donationModel;
        $this->projectModel  = $projectModel;
    }

    // Public: Renders the donation form
    public function showForm() {
        $projects = $this->projectModel->getAll()->fetchAll(PDO::FETCH_ASSOC);
        $status   = null;
        require_once __DIR__ . '/../../views/user/donate/index.php';
    }

    // Public: Saves a donation record from the form
    public function store() {
        $projects = $this->projectModel->getAll()->fetchAll(PDO::FETCH_ASSOC);
        $status   = 'error'; // default

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'donor_name' => $_POST['donor_name'],
                'email'      => $_POST['email'],
                'amount'     => $_POST['amount'],
                'type'       => $_POST['type'],
                'project_id' => !empty($_POST['project_id']) ? $_POST['project_id'] : null,
                'message'    => $_POST['message'] ?? '',
                'date'       => date('Y-m-d')
            ];

            if ($this->donationModel->create($data)) {
                $status = 'success';
            }
        }

        require_once __DIR__ . '/../../views/user/donate/index.php';
    }
}