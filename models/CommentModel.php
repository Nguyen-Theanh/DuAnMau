<?php 
class CommentModel{
    protected $pdo;

    public function __construct(){
        $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8', DB_HOST, DB_PORT, DB_NAME);

        try{
            $this->pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD, DB_OPTIONS);
        } catch (PDOException $e) {
            die("Kết nối cơ sở dữ liệu thất bại: {$e->getMessage()}");
        }
    }

    public function getCommentsByProduct($product_id){
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

    public function addComment ($product_id, $user_id, $content){
        $sql = "INSERT INTO comments (product_id, user_id, content, created_at)
                VALUES (:pid, :uid, :content, Now())";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':pid' => $product_id,
            ':uid' => $user_id,
            ':content' => $content,
        ]);
    }
}