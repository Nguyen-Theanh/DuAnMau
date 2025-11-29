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
    $sql = "SELECT p.*,c.name as categogies_name
            FROM products p
            LEFT JOIN categogies c ON p.idcategory = c.id 
            WHERE name LIKE :keyword";
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
}