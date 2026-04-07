<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;

class DonationModel
{
    public function create(array $data): void
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('INSERT INTO donations (donor_name, email, amount_lkr, project_id, message)
                               VALUES (:donor_name, :email, :amount_lkr, :project_id, :message)');
        $stmt->execute($data);
    }
}
