<?php
namespace App\Models;

use PDO;

abstract class BaseModel
{
    protected static PDO $pdo;

    /** Gán PDO một lần ở bootstrap */
    public static function setPdo(PDO $pdo): void
    {
        self::$pdo = $pdo;
    }

    /** Cho model con gọi: self::db() */
    protected static function db(): PDO
    {
        return self::$pdo;
    }
}
