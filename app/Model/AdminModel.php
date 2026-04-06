<?php

declare(strict_types=1);

namespace App\Model;

use App\Core\Database;

class AdminModel
{
    public function findById(int $id): ?array
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('SELECT id, name, email, password_hash FROM admins WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $admin = $stmt->fetch();

        return $admin ?: null;
    }

    public function findByEmail(string $email): ?array
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('SELECT id, name, email, password_hash FROM admins WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        $admin = $stmt->fetch();

        return $admin ?: null;
    }

    public function emailExistsForAnotherAdmin(string $email, int $adminId): bool
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM admins WHERE email = :email AND id != :id');
        $stmt->execute([
            'email' => $email,
            'id' => $adminId,
        ]);

        return (int) $stmt->fetchColumn() > 0;
    }

    public function updateEmail(int $adminId, string $email): void
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('UPDATE admins SET email = :email WHERE id = :id');
        $stmt->execute([
            'email' => $email,
            'id' => $adminId,
        ]);
    }

    public function updatePassword(int $adminId, string $passwordHash): void
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('UPDATE admins SET password_hash = :password_hash WHERE id = :id');
        $stmt->execute([
            'password_hash' => $passwordHash,
            'id' => $adminId,
        ]);
    }
}
