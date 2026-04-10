<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;

class MemberModel
{
    public function all(): array
    {
        $pdo = Database::connection();
        $stmt = $pdo->query('SELECT * FROM members ORDER BY name ASC');
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('SELECT * FROM members WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(array $data): void
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('
            INSERT INTO members (name, occupation, image_path) 
            VALUES (:name, :occupation, :image_path)
        ');
        $stmt->execute($data);
    }

    public function update(int $id, array $data): void
    {
        $pdo = Database::connection();
        $data['id'] = $id;
        $stmt = $pdo->prepare('
            UPDATE members 
            SET name = :name, occupation = :occupation, image_path = :image_path
            WHERE id = :id
        ');
        $stmt->execute($data);
    }

    public function delete(int $id): void
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('DELETE FROM members WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }
}
