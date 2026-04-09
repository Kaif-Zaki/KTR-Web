<?php

declare(strict_types=1);

namespace App\Core;

use PDO;
use PDOException;
use RuntimeException;

class Database
{
    private static ?PDO $pdo = null;

    public static function connection(): PDO
    {
        if (self::$pdo !== null) {
            return self::$pdo;
        }

        $config = config('database');

        try {
            self::$pdo = self::connect($config);
        } catch (PDOException $exception) {
            if (
                strcasecmp((string) $config['host'], 'localhost') === 0 &&
                str_contains($exception->getMessage(), 'No such file or directory')
            ) {
                $config['host'] = '127.0.0.1';

                try {
                    self::$pdo = self::connect($config);
                } catch (PDOException $fallbackException) {
                    throw new RuntimeException(
                        'Database connection failed: '
                        . $fallbackException->getMessage()
                        . ' (localhost socket fallback also failed)'
                    );
                }
            } else {
                throw new RuntimeException('Database connection failed: ' . $exception->getMessage());
            }
        }

        return self::$pdo;
    }

    private static function connect(array $config): PDO
    {
        $dsn = sprintf(
            'mysql:host=%s;port=%d;dbname=%s;charset=%s',
            $config['host'],
            $config['port'],
            $config['database'],
            $config['charset']
        );

        return new PDO($dsn, $config['username'], $config['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }
}
