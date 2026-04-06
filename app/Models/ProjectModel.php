<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;

class ProjectModel
{
    public function groupedByCategory(?int $categoryId = null, string $search = ''): array
    {
        $pdo = Database::connection();

        $sql = 'SELECT p.id, p.title, p.description, p.photo_status, p.amount_lkr, p.project_date, c.id AS category_id, c.name AS category_name
                FROM projects p
                INNER JOIN project_categories c ON c.id = p.category_id
                WHERE 1=1';

        $params = [];

        if ($categoryId !== null) {
            $sql .= ' AND c.id = :category_id';
            $params['category_id'] = $categoryId;
        }

        if ($search !== '') {
            $sql .= ' AND (p.title LIKE :search OR p.description LIKE :search)';
            $params['search'] = '%' . $search . '%';
        }

        $sql .= ' ORDER BY c.sort_order ASC, p.project_date DESC, p.created_at DESC';
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        $rows = $stmt->fetchAll();
        $grouped = [];

        foreach ($rows as $row) {
            $grouped[$row['category_name']][] = $row;
        }

        return $grouped;
    }

    public function count(): int
    {
        $pdo = Database::connection();
        return (int) $pdo->query('SELECT COUNT(*) FROM projects')->fetchColumn();
    }

    public function allForAdmin(): array
    {
        $pdo = Database::connection();
        $stmt = $pdo->query('SELECT p.id, p.title, p.photo_status, p.project_date, c.name AS category_name
                             FROM projects p
                             INNER JOIN project_categories c ON c.id = p.category_id
                             ORDER BY p.created_at DESC');
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('SELECT id, category_id, title, description, photo_status, amount_lkr, project_date FROM projects WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        return $row ?: null;
    }

    public function create(array $data): void
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('INSERT INTO projects (category_id, title, description, photo_status, amount_lkr, project_date)
                               VALUES (:category_id, :title, :description, :photo_status, :amount_lkr, :project_date)');
        $stmt->execute($data);
    }

    public function update(int $id, array $data): void
    {
        $pdo = Database::connection();
        $data['id'] = $id;
        $stmt = $pdo->prepare('UPDATE projects
                               SET category_id = :category_id,
                                   title = :title,
                                   description = :description,
                                   photo_status = :photo_status,
                                   amount_lkr = :amount_lkr,
                                   project_date = :project_date
                               WHERE id = :id');
        $stmt->execute($data);
    }

    public function delete(int $id): void
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('DELETE FROM projects WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }
}
