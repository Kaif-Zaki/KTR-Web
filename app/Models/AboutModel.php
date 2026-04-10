<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

class AboutModel
{
    private ?array $columnsCache = null;

    public function first(): ?array
    {
        $pdo = Database::connection();
        $stmt = $pdo->query('SELECT * FROM about_sections ORDER BY id ASC LIMIT 1');
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function update(array $data): void
    {
        $pdo = Database::connection();
        $availableColumns = $this->availableColumns();
        $fields = [];
        $params = [];

        foreach ($data as $key => $value) {
            if (!isset($availableColumns[$key])) continue;
            $fields[] = "{$key} = :{$key}";
            $params[":{$key}"] = $value;
        }

        if (empty($fields)) return;

        // Ensure we update the first record
        $sql = "UPDATE about_sections SET " . implode(', ', $fields) . " WHERE id = (SELECT id FROM (SELECT id FROM about_sections ORDER BY id ASC LIMIT 1) as t)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
    }

    private function availableColumns(): array
    {
        if ($this->columnsCache !== null) {
            return $this->columnsCache;
        }

        $pdo = Database::connection();
        $stmt = $pdo->query('SHOW COLUMNS FROM about_sections');
        $columns = [];

        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $column) {
            $name = (string) ($column['Field'] ?? '');
            if ($name !== '') {
                $columns[$name] = true;
            }
        }

        $this->columnsCache = $columns;
        return $columns;
    }
}
