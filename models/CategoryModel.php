<?php
class CategoryModel{
    protected $pdo;
    public function __construct(){
        $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8', DB_HOST, DB_PORT, DB_NAME);

        try{
            $this->pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD, DB_OPTIONS);
        } catch (PDOException $e) {
            die ("Kết nối cơ sở dữ liệu thất bại: {$e->getMessage()}");
        }
    }

    public function getAllCategories(){
        $sql = "SELECT * FROM categories ORDER BY id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getCategoryById($id){
        $sql = "SELECT * FROM categories WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    public function addCategory($name,$description){
        $sql = "INSERT INTO categories (name, description) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$name, $description]);
    }

    public function updateCategory($id, $name,$description){
        $sql="UPDATE categories SET name = ?, description = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$name, $description, $id]);
    }

    public function deleteCategory($id){
        $checkSql = "SELECT COUNT(*) as count FROM products WHERE idcategory = ?";
        $checkStmt = $this->pdo->prepare($checkSql);
        $checkStmt->execute([$id]);
        $result = $checkStmt->fetch();

        if($result['count'] > 0){
            return false;
        }

        $sql = "DELETE FROM categories WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function searchCategories($keyword){
        $sql = "SELECT * FROM categories WHERE name LIKE ? OR description LIKE ? ORDER BY id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(["%$keyword%", "%$keyword%"]);
        return $stmt->fetchAll();
    }
}