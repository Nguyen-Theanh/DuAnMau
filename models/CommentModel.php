<?php
class CommentModel
{
    protected $pdo;

    public function __construct()
    {
        $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8', DB_HOST, DB_PORT, DB_NAME);

        try {
            $this->pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD, DB_OPTIONS);
        } catch (PDOException $e) {
            die("Kết nối cơ sở dữ liệu thất bại: {$e->getMessage()}");
        }
    }

    public function getCommentsByProduct($product_id)
    {
        $sql = "SELECT c.*, u.username 
                FROM comments c 
                LEFT JOIN users u 
                ON c.user_id = u.id
                WHERE c.product_id = :pid
                ORDER BY c.created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':pid' => $product_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addComment($product_id, $user_id, $content)
    {
        $sql = "INSERT INTO comments (product_id, user_id, content, created_at)
                VALUES (:pid, :uid, :content, Now())";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':pid' => $product_id,
            ':uid' => $user_id,
            ':content' => $content,
        ]);
    }
    public function getAllComment($keyword = '')
    {
        $sql = "SELECT c.*, u.username, p.name AS product_name FROM comments c "
            . "LEFT JOIN users u ON c.user_id = u.id "
            . "LEFT JOIN products p ON c.product_id = p.id ";

        if (!empty($keyword)) {
            $sql .= "WHERE c.content LIKE :keyword OR u.username LIKE :keyword OR p.name LIKE :keyword ";
        }

        $sql .= "ORDER BY c.created_at DESC";

        $stmt = $this->pdo->prepare($sql);

        if (!empty($keyword)) {
            $keyword = '%' . $keyword . '%';
            $stmt->execute([':keyword' => $keyword]);
        } else {
            $stmt->execute();
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function deleteComment($id)
    {
        $sql = "DELETE FROM comments WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
    public function setHidden($id, $hidden = true)
    {
        $sql = "UPDATE comments SET is_hidden = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$hidden ? 1 : 0, $id]);
    }
}