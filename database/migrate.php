<?php

declare(strict_types=1);

require __DIR__ . '/../app/Support/env.php';
load_env(__DIR__ . '/../.env');

$db = require __DIR__ . '/../config/database.php';

$pdo = new PDO(
    sprintf('mysql:host=%s;port=%d;charset=%s', $db['host'], $db['port'], $db['charset']),
    $db['username'],
    $db['password'],
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
);

$pdo->exec(sprintf(
    'CREATE DATABASE IF NOT EXISTS `%s` CHARACTER SET %s COLLATE %s_general_ci',
    $db['database'],
    $db['charset'],
    $db['charset']
));
$pdo->exec(sprintf('USE `%s`', $db['database']));

$pdo->exec('CREATE TABLE IF NOT EXISTS migrations (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    filename VARCHAR(255) NOT NULL UNIQUE,
    applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)');

$existing = $pdo->query('SELECT filename FROM migrations')->fetchAll(PDO::FETCH_COLUMN);
$applied = array_flip($existing);

$files = glob(__DIR__ . '/migrations/*.sql');
sort($files);

foreach ($files as $file) {
    $filename = basename($file);

    if (isset($applied[$filename])) {
        echo "Skipping {$filename} (already applied)\n";
        continue;
    }

    $sql = file_get_contents($file);

    if ($sql === false) {
        throw new RuntimeException("Unable to read migration file: {$filename}");
    }

    try {
        $pdo->exec($sql);
        $stmt = $pdo->prepare('INSERT INTO migrations (filename) VALUES (:filename)');
        $stmt->execute(['filename' => $filename]);
        echo "Applied {$filename}\n";
    } catch (Throwable $throwable) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }

        throw new RuntimeException(
            "Migration failed for {$filename}: " . $throwable->getMessage(),
            0,
            $throwable
        );
    }
}

echo "Migration complete.\n";
