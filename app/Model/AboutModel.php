<?php

declare(strict_types=1);

namespace App\Model;

use App\Core\Database;

class AboutModel
{
    public function first(): ?array
    {
        $pdo = Database::connection();
        $stmt = $pdo->query('SELECT title, body, volunteer_count, established_year FROM about_sections ORDER BY id ASC LIMIT 1');
        $row = $stmt->fetch();

        return $row ?: null;
    }
}
