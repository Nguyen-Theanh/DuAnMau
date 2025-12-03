<?php

class ProductController
{

    public $modelProduct;
    public $modelCategory;
    public $modelComment;

    public function __construct()
    {
        require_once __DIR__ . '/../models/ProductModel.php';
        require_once __DIR__ . '/../models/CategoryModel.php';
        require_once __DIR__ . '/../models/CommentModel.php';

        $this->modelProduct = new ProductModel();
        $this->modelCategory = new CategoryModel();
        $this->modelComment = new CommentModel();
    }

    public function Home()
    {
        $categories = $this->modelCategory->getAllCategories();
        $keyword = $_GET['keyword'] ?? '';
        $categoryID = $_GET['category_id'] ?? '';

        if ($keyword !== '') {
            $products = $this->modelProduct->searchProduct($keyword);
        } elseif ($categoryID !== '') {
            $products = $this->modelProduct->getProductsByCategory($categoryID);
        } else {
            $products = $this->modelProduct->getAllProduct();
        }
        require './views/home.php';
    }

    public function detail()
    {
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            echo "Sản phẩm không tồn tại";
            return;
        }

        $id = intval($_GET['id']);
        $product = $this->modelProduct->getProductById($id);

        if (!$product) {
            echo "Sản phẩm không tồn tại";
            return;
        }

        $category = $this->modelCategory->getCategoryById($product['idcategory']);
        $product['category_name'] = $category['name'] ?? '';

        $relatedProducts = $this->modelProduct->getRelatedProducts($product['idcategory'], $id);
        $comments = $this->modelComment->getCommentsByProduct($id);
        require __DIR__ . '/../views/products/deatail.php';

    }

    public function indexProduct()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: index.php?action=login');
            exit;
        }
        $keyword = $_GET['keyword'] ?? '';
        if ($keyword !== '') {
            $products = $this->modelProduct->searchProduct($keyword);
        } else {
            $products = $this->modelProduct->getAllProduct();
        }
        require __DIR__ . '/../views/products/index.php';
    }

    public function deleteProduct()
    {
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $this->modelProduct->deleteProduct($id);
        }
        header('Location: index.php?action=indexproduct');
        exit;
    }

    public function editProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $product = $this->modelProduct->getProductById($id);

            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $target_dir = 'uploads/imgproduct/';
                $imageName = time() . '_' . basename($_FILES["image"]["name"]);
                $target_file = $target_dir . $imageName;
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                $product['image'] = $imageName;
            } else {
                $imageName = $product['image'];
            }

            $data = [
                'id' => $id,
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'description' => $_POST['description'],
                'image' => $imageName,
                'idcategory' => $_POST['idcategory']
            ];

            $this->modelProduct->updateProduct($data);
            $_SESSION['success'] = 'Cập nhật sản phẩm thành công';
            header('Location: index.php?action=indexproduct');
            exit;
        } else {
            $id = $_GET['id'];
            $product = $this->modelProduct->getProductById($id);
            $categories = $this->modelCategory->getAllCategories();
            include __DIR__ . '/../views/products/edit.php';
        }
    }

    public function createProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $target_dir = 'uploads/imgproduct/';
            $imageName = '';

            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $imageName = time() . '_' . basename($_FILES["image"]["name"]);
                $target_file = $target_dir . $imageName;
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            }

            $data = [
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'description' => $_POST['description'],
                'image' => $imageName,
                'idcategory' => $_POST['idcategory']
            ];
            $this->modelProduct->createProduct($data);
            header('Location: index.php?action=indexproduct');
            exit;
        } else {
            $categories = $this->modelCategory->getAllCategories();
            include __DIR__ . '/../views/products/create.php';
        }
    }

}