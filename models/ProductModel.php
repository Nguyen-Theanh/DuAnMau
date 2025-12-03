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
        $sql = "SELECT p.*,c.name as categories_name
                FROM products p
                LEFT JOIN categories c ON p.idcategory = c.id";
        $stmt = $this->pdo->prepare($sql); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id){
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function searchProduct($keyword)
    {
    $sql = "SELECT p.*,c.name as categories_name
            FROM products p
            LEFT JOIN categories c ON p.idcategory = c.id 
            WHERE p.name LIKE :keyword";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        ':keyword' => '%' . $keyword . '%'
    ]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);    
}

    public function getRelatedProducts($category_id, $currentProductId){
        $sql = "SELECT * FROM products
                WHERE idcategory = ?
                AND id !=?
                LIMIT 4";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$category_id,$currentProductId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id){
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = $this -> pdo -> prepare($sql);
        $stmt->execute(['id'=>$id]);
        return $stmt->fetch();
    }

    public function deleteProduct($id){
        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id'=>$id]);
    }

    public function getProductsByCategory($categoryID){
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p 
                LEFT JOIN categories c ON p.idcategory = c.id
                WHERE p.idcategory = :idcategory";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':idcategory' => $categoryID]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function updateProduct($data){
        $sql = "UPDATE products 
                SET name = :name, price = :price, image = :image, description = :description, idcategory = :idcategory 
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':name' => $data['name'],
            ':price' => $data['price'],
            ':image' => $data['image'],
            ':description' => $data['description'],
            ':idcategory' => $data['idcategory'],
            ':id' => $data['id']
        ]);
    }

    public function createProduct($data){
        $sql ="INSERT INTO products (name, price, description, image, idcategory) 
                VALUES (:name, :price, :description, :image, :idcategory)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':name' => $data['name'],
            ':price' => $data['price'],
            ':description' => $data['description'],
            ':image' => $data['image'],
            ':idcategory' => $data['idcategory']
        ]);
    }

}
