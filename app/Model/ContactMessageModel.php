<?php

declare(strict_types=1);

namespace App\Model;

use App\Core\Database;

class ContactMessageModel
{
    public function create(string $name, string $email, ?string $subject, string $message): int
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('INSERT INTO contact_messages (name, email, subject, message)
                               VALUES (:name, :email, :subject, :message)');
        $stmt->execute([
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message,
        ]);

        return (int) $pdo->lastInsertId();
    }

    public function all(): array
    {
        $pdo = Database::connection();
        $stmt = $pdo->query('SELECT id, name, email, subject, message, is_read, created_at
                             FROM contact_messages
                             ORDER BY created_at DESC');
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('SELECT id, name, email, subject, message, is_read, created_at
                               FROM contact_messages
                               WHERE id = :id
                               LIMIT 1');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        return $row ?: null;
    }

    public function markRead(int $id): void
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('UPDATE contact_messages SET is_read = 1 WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

    public function unreadCount(): int
    {
        $pdo = Database::connection();
        return (int) $pdo->query('SELECT COUNT(*) FROM contact_messages WHERE is_read = 0')->fetchColumn();
    }

    public function addReply(int $messageId, int $adminId, string $replyMessage, bool $sent): void
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('INSERT INTO contact_message_replies (contact_message_id, admin_id, reply_message, sent_at)
                               VALUES (:contact_message_id, :admin_id, :reply_message, :sent_at)');
        $stmt->execute([
            'contact_message_id' => $messageId,
            'admin_id' => $adminId,
            'reply_message' => $replyMessage,
            'sent_at' => $sent ? date('Y-m-d H:i:s') : null,
        ]);
    }

    public function repliesForMessage(int $messageId): array
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('SELECT r.id, r.reply_message, r.sent_at, r.created_at, a.name AS admin_name
                               FROM contact_message_replies r
                               INNER JOIN admins a ON a.id = r.admin_id
                               WHERE r.contact_message_id = :contact_message_id
                               ORDER BY r.created_at DESC');
        $stmt->execute(['contact_message_id' => $messageId]);
        return $stmt->fetchAll();
    }
}
