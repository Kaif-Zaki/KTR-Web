<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;

class CategoryModel
{
    public function all(): array
    {
        $pdo = Database::connection();
        $stmt = $pdo->query('SELECT id, name, slug, description FROM project_categories ORDER BY sort_order ASC, name ASC');
        return $stmt->fetchAll();
    }
}
