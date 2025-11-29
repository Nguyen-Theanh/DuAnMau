<?php
class CommentController{
    protected $modelComment;
    public function __construct(){
        require_once __DIR__ . '/../models/CommentModel.php' ;
        $this->modelComment = new CommentModel();
    }

    public function store(){
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            header('Location: index.php');
            exit;
        }

        if(!isset($_SESSION['user'])){
            header('Location: index.php?action=login');
            exit;
        }

        $user = $_SESSION['user'];
        $user_id = $user['id'];
        $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
        $content = trim($_POST['content'] ?? '');

        if($product_id <= 0 || $content === ''){
            header('Location: index.php?action=productDetail&id=' . $product_id);
            exit;
        }

        $this->modelComment->addComment($product_id, $user_id, $content);

        header('Location: index.php?action=productDetail&id=' . $product_id);
        exit;
    }
    
}