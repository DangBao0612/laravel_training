<?php
namespace App\Models;

use PDO;

class User extends BaseModel
{
    public static function create(string $email, string $hash): void
    {
        self::db()->prepare(
            'INSERT INTO users (email,password_hash) VALUES (?,?)'
        )->execute([$email, $hash]);
    }

    public static function findByEmail(string $email): ?array
    {
        $stm = self::db()->prepare('SELECT * FROM users WHERE email = ?'); // Tìm email
        $stm->execute([$email]); // Truyền giá trị vào ?array
        return $stm->fetch(PDO::FETCH_ASSOC) ?: null; // Nếu tìm thấy, ép kiểu dữ liệu (array). Nếu ko trả null
    }
    
    public static function findIdByRemember(string $token): ?int
{
    $stmt = self::$pdo->prepare(
        'SELECT id FROM users WHERE remember_token = ? LIMIT 1' // Tìm token
    );
    $stmt->execute([$token]); // Truyền giá trị $token vào ?int
    $row = $stmt->fetch(PDO::FETCH_ASSOC); // Lấy kết quả đầu tiên
    return $row ? (int)$row['id'] : null; // Nếu tìm thấy, ép kiểu dữ liệu (int). Nếu ko trả null
}

    public static function updateRemember(int $id, ?string $token): void
    {
        self::db()->prepare(
            'UPDATE users SET remember_token = ? WHERE id = ?'
        )->execute([$token, $id]);
    }

}
