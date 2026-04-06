<?php

declare(strict_types=1);

namespace App\Model;

use App\Core\Database;

class AdminPasswordResetModel
{
    public function invalidateActiveTokens(int $adminId): void
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('UPDATE admin_password_resets
                               SET used_at = NOW()
                               WHERE admin_id = :admin_id
                                 AND used_at IS NULL
                                 AND expires_at >= NOW()');
        $stmt->execute(['admin_id' => $adminId]);
    }

    public function createToken(int $adminId, string $tokenHash, string $expiresAt): int
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('INSERT INTO admin_password_resets (admin_id, token_hash, expires_at)
                               VALUES (:admin_id, :token_hash, :expires_at)');
        $stmt->execute([
            'admin_id' => $adminId,
            'token_hash' => $tokenHash,
            'expires_at' => $expiresAt,
        ]);

        return (int) $pdo->lastInsertId();
    }

    public function findValidToken(int $adminId, string $tokenHash): ?array
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('SELECT id, admin_id
                               FROM admin_password_resets
                               WHERE admin_id = :admin_id
                                 AND token_hash = :token_hash
                                 AND used_at IS NULL
                                 AND expires_at >= NOW()
                               ORDER BY id DESC
                               LIMIT 1');
        $stmt->execute([
            'admin_id' => $adminId,
            'token_hash' => $tokenHash,
        ]);
        $row = $stmt->fetch();

        return $row ?: null;
    }

    public function markUsed(int $id): void
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('UPDATE admin_password_resets SET used_at = NOW() WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }
}
