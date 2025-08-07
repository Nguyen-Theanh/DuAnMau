<?php 
class ProductModel
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

    public function getAllProduct()
    {
        $sql = "SELECT * FROM products";
        $stmt = $this->pdo->prepare($sql); 
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function searchProduct($keyword)
    {
    $sql = "SELECT * FROM products WHERE name LIKE :keyword";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        ':keyword' => '%' . $keyword . '%'
    ]);
    return $stmt->fetchAll();    
}
public function deleteProduct($id) {
    $sql = "DELETE FROM products WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
}
public function getProductById($id) {
    $sql = "SELECT * FROM products WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
}

public function updateProduct($data)
{
    $sql = "UPDATE products 
            SET name = :name, price = :price, image = :image, description = :description, idcategory = :idcategory 
            WHERE id = :id";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        ':id' => $data['id'],
        ':name' => $data['name'],
        ':price' => $data['price'],
        ':image' => $data['image'],
        ':description' => $data['description'],
        ':idcategory' => $data['idcategory'],
    ]);
}

}
