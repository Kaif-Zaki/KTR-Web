<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;

class GalleryModel
{
    public function all(): array
    {
        $pdo = Database::connection();
        $stmt = $pdo->query('
            SELECT g.id, g.image_path, g.caption, p.title as project_title 
            FROM gallery g 
            LEFT JOIN projects p ON g.project_id = p.id 
            ORDER BY g.created_at DESC
        ');
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('SELECT id, project_id, image_path, caption FROM gallery WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        return $row ?: null;
    }

    public function create(array $data): void
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('INSERT INTO gallery (project_id, image_path, caption) VALUES (:project_id, :image_path, :caption)');
        $stmt->execute($data);
    }

    public function update(int $id, array $data): void
    {
        $pdo = Database::connection();
        $data['id'] = $id;
        $stmt = $pdo->prepare('UPDATE gallery SET project_id = :project_id, image_path = :image_path, caption = :caption WHERE id = :id');
        $stmt->execute($data);
    }

    public function delete(int $id): void
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('DELETE FROM gallery WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }
}
