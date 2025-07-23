<?php
namespace App\Models;

class Post extends BaseModel
{
    // Lấy tất cả bài, mới nhất lên đầu -- R
    public static function all(): array
    {
        $sql = 'SELECT p.*, u.email 
                FROM posts p
                JOIN users u ON u.id = p.user_id -- Kết bảng user và post thông qua khóa id
                ORDER BY p.created_at DESC';
        return self::db()->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Tìm bài theo id -- R
    public static function find(int $id): ?array
    {
        $stmt = self::db()->prepare('SELECT * FROM posts WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
    }

    // Tạo bài mới -- C
    public static function create(array $data): void
    {
        $sql = 'INSERT INTO posts (user_id, title, content)
                VALUES (:uid, :title, :content)';
        self::db()->prepare($sql)->execute($data);
    }

    // Cập nhật bài -- U
    public static function update(int $id, array $data): void
    {
        $data['id'] = $id;
        $sql = 'UPDATE posts
                SET title = :title, content = :content
                WHERE id = :id';
        self::db()->prepare($sql)->execute($data);
    }

    // Xoá bài -- D
    public static function delete(int $id): void
    {
        self::db()->prepare('DELETE FROM posts WHERE id = :id')
                  ->execute(['id' => $id]);
    }
}
