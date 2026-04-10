<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

class WebsiteSettingsModel
{
    public function get(): ?array
    {
        $pdo = Database::connection();
        $stmt = $pdo->query('SELECT * FROM website_settings WHERE id = 1 LIMIT 1');
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function update(array $data): void
    {
        $pdo = Database::connection();
        $fields = [];
        $params = [];

        foreach ($data as $key => $value) {
            if ($key === 'id') continue;
            $fields[] = "{$key} = :{$key}";
            $params[":{$key}"] = $value;
        }

        if (empty($fields)) return;

        $sql = "UPDATE website_settings SET " . implode(', ', $fields) . " WHERE id = 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
    }
}
