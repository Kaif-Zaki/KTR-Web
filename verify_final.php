<?php

require __DIR__ . '/app/Support/env.php';
load_env(__DIR__ . '/.env');
$db = require __DIR__ . '/config/database.php';

try {
    $pdo = new PDO(
        sprintf(
            'mysql:host=%s;port=%d;dbname=%s;charset=%s',
            $db['host'],
            $db['port'],
            $db['database'],
            $db['charset']
        ),
        $db['username'],
        $db['password']
    );
    $res = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    echo "Tables: " . implode(', ', $res) . "\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
