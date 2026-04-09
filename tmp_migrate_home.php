<?php
$pdo = new PDO('mysql:host=localhost;port=3307;dbname=kottramulla_website', 'root', '');
$sql = file_get_contents(__DIR__ . '/database/migrations/008_create_home_dynamic_tables.sql');
try {
    $pdo->exec($sql);
    echo "SQL Executed Successfully\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
