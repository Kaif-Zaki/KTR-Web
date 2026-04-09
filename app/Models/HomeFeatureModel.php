<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

class HomeFeatureModel
{
    public function all(): array
    {
        $pdo = Database::connection();
        $stmt = $pdo->query('SELECT * FROM home_features ORDER BY sort_order ASC, id ASC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): ?array
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('SELECT * FROM home_features WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function create(array $data): void
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('
            INSERT INTO home_features (icon, title, description, sort_order) 
            VALUES (:icon, :title, :description, :sort_order)
        ');
        $stmt->execute($data);
    }

    public function update(int $id, array $data): void
    {
        $pdo = Database::connection();
        $data['id'] = $id;
        $stmt = $pdo->prepare('
            UPDATE home_features 
            SET icon = :icon, title = :title, description = :description, sort_order = :sort_order
            WHERE id = :id
        ');
        $stmt->execute($data);
    }

    public function delete(int $id): void
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('DELETE FROM home_features WHERE id = ?');
        $stmt->execute([$id]);
    }
}
