<?php

class ProductController{

    public $modelProduct;
    public $modelCategory;
    public $modelComment;

    public function __construct(){
        require_once __DIR__ . '/../models/ProductModel.php';
        require_once __DIR__ . '/../models/CategoryModel.php';
        require_once __DIR__ . '/../models/CommentModel.php';

                $this->modelProduct = new ProductModel();
                $this->modelCategory = new CategoryModel();
                $this->modelComment = new CommentModel();
    }

    public function Home(){
        $categories =$this->modelCategory->getAllCategories();
        $keyword = $_GET['keyword']??'';
        $categoryID = $_GET['category_id'] ?? '';

        if($keyword !== ''){
            $products = $this->modelProduct->searchProduct($keyword);
        } elseif ($categoryID !==''){
            $products = $this->modelProduct->getProductsByCategory($categoryID);
        } else{
            $products = $this->modelProduct->getAllProduct();
        }
        require './views/home.php';
    }

    public function detail(){
        if(!isset($_GET['id']) || empty($_GET['id'])){
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
}