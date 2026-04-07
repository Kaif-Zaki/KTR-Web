<?php
require 'app/Support/env.php';
require 'app/Support/helpers.php';
load_env('.env');
require 'app/Core/Database.php';

$pdo = \App\Core\Database::connection();
file_put_contents('output.json', json_encode($pdo->query('SELECT * FROM gallery')->fetchAll(PDO::FETCH_ASSOC)));
