<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;

class SubscriptionModel
{
    public function create(array $data): void
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('INSERT INTO subscriptions
            (full_name, email, phone, plan_code, plan_name, billing_cycle, amount_lkr, start_date, next_billing_date, notes)
            VALUES
            (:full_name, :email, :phone, :plan_code, :plan_name, :billing_cycle, :amount_lkr, :start_date, :next_billing_date, :notes)');

        $stmt->execute($data);
    }

    public function hasPendingOrActiveByEmail(string $email): bool
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('SELECT COUNT(*)
            FROM subscriptions
            WHERE email = :email AND status IN (\'pending\', \'active\')');
        $stmt->execute(['email' => $email]);

        return (int) $stmt->fetchColumn() > 0;
    }

    public function countActive(): int
    {
        $pdo = Database::connection();
        return (int) $pdo->query("SELECT COUNT(*) FROM subscriptions WHERE status = 'active'")->fetchColumn();
    }

    public function countPending(): int
    {
        $pdo = Database::connection();
        return (int) $pdo->query("SELECT COUNT(*) FROM subscriptions WHERE status = 'pending'")->fetchColumn();
    }

    public function all(?string $status = null): array
    {
        $pdo = Database::connection();

        $sql = 'SELECT id, full_name, email, phone, plan_name, plan_code, billing_cycle, amount_lkr,
                       start_date, next_billing_date, status, notes, admin_note, created_at
                FROM subscriptions';
        $params = [];

        if ($status !== null) {
            $sql .= ' WHERE status = :status';
            $params['status'] = $status;
        }

        $sql .= ' ORDER BY created_at DESC';
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('SELECT id, full_name, email, phone, plan_name, plan_code, billing_cycle, amount_lkr,
                                      start_date, next_billing_date, status, notes, admin_note, created_at
                               FROM subscriptions
                               WHERE id = :id
                               LIMIT 1');
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch();

        return $row ?: null;
    }

    public function updateStatus(int $id, string $status, ?string $adminNote, ?string $nextBillingDate): void
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('UPDATE subscriptions
                               SET status = :status,
                                   admin_note = :admin_note,
                                   next_billing_date = :next_billing_date
                               WHERE id = :id');
        $stmt->execute([
            'id' => $id,
            'status' => $status,
            'admin_note' => $adminNote,
            'next_billing_date' => $nextBillingDate,
        ]);
    }
}
