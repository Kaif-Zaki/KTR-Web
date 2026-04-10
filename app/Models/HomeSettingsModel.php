<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

class HomeSettingsModel
{
    private ?array $columnsCache = null;

    public function get(): ?array
    {
        $pdo = Database::connection();
        $stmt = $pdo->query('SELECT * FROM home_settings LIMIT 1');
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function update(array $data): void
    {
        $pdo = Database::connection();
        $availableColumns = $this->availableColumns();
        $fields = [];
        $params = [];

        foreach ($data as $key => $value) {
            if ($key === 'id') continue;
            if (!isset($availableColumns[$key])) continue;
            $fields[] = "{$key} = :{$key}";
            $params[":{$key}"] = $value;
        }

        if (empty($fields)) return;

        $sql = "UPDATE home_settings SET " . implode(', ', $fields) . " WHERE id = 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
    }

    private function availableColumns(): array
    {
        if ($this->columnsCache !== null) {
            return $this->columnsCache;
        }

        $pdo = Database::connection();
        $stmt = $pdo->query('SHOW COLUMNS FROM home_settings');
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
