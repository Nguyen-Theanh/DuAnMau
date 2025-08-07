<?php
// có class chứa các function thực thi xử lý logic 
class ProductController
{
    public $modelProduct;

    public function __construct()
    {
        $this->modelProduct = new ProductModel();
        $this->modelCategory = new CategoryModel();
    }

    public function Home() {
    $keyword = $_GET['keyword'] ?? '';
    if ($keyword !== '') {
        $products = $this->modelProduct->searchProduct($keyword);
    } else {
        $products = $this->modelProduct->getAllProduct();
    }

    require 'views/trangchu.php';
}
    public function QLSP() {
    $keyword = $_GET['keyword'] ?? '';
    if ($keyword !== '') {
        $products = $this->modelProduct->searchProduct($keyword);
    } else {
        $products = $this->modelProduct->getAllProduct();
    }

    require 'views/qlsp.php';
}
public function XoaSP() {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $this->modelProduct->deleteProduct($id);
    }
    header("Location: index.php?action=qlsp");
    exit();
}
public function SuaSP()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $product = $this->modelProduct->getProductById($id); // Lấy lại ảnh cũ

        // Xử lý ảnh
        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $target_dir = "uploads/";
            $imagePath = $target_dir . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
        } else {
            $imagePath = $product['image']; // Không up ảnh thì dùng ảnh cũ
        }

        $data = [
            'id' => $id,
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'description' => $_POST['description'] ?? '',
            'image' => $imagePath,
            'idcategory' => $_POST['idcategory']
        ];

        $this->modelProduct->updateProduct($data);
        header("Location: index.php?action=qlsp");
        exit;
    } else {
        $id = $_GET['id'];
        $product = $this->modelProduct->getProductById($id);
        $categories = $this->modelCategory->getAllCategories();
        include 'views/sua_sp.php';
    }
}


}

