<?php
class CommentController
{
    protected $modelComment;
    public function __construct()
    {
        require_once __DIR__ . '/../models/CommentModel.php';
        $this->modelComment = new CommentModel();
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php');
            exit;
        }

        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit;
        }

        $user = $_SESSION['user'];
        $user_id = $user['id'];
        $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
        $content = trim($_POST['content'] ?? '');

        if ($product_id <= 0 || $content === '') {
            header('Location: index.php?action=productDetail&id=' . $product_id);
            exit;
        }

        $this->modelComment->addComment($product_id, $user_id, $content);

        header('Location: index.php?action=productDetail&id=' . $product_id);
        exit;
    }

    public function index()
    {
        if (!isset($_SESSION['user']) || ($_SESSION['user']['role'] ?? '') !== 'admin') {
            header('Location: index.php?action=login');
            exit;
        }
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
        $comments = $this->modelComment->getAllComment($keyword);
        require __DIR__ . '/../views/comments/index.php';
    }

    public function toggle()
    {
        if (!isset($_SESSION['user']) || ($_SESSION['user']['role'] ?? '') !== 'admin') {
            header('Location: index.php?action=login');
            exit;
        }
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $action = isset($_GET['toggle']) ? $_GET['toggle'] : '';
        if ($id <= 0) {
            header('Location: index.php?action=managecomments');
            exit;
        }
        if ($action === 'hide') {
            $this->modelComment->setHidden($id, true);
        } else {
            $this->modelComment->setHidden($id, false);
        }

        header('Location: index.php?action=managecomments');
        exit;
    }

    public function delete()
    {
        if (!isset($_SESSION['user']) || ($_SESSION['user']['role'] ?? '') !== 'admin') {
            header('Location: index.php?action=login');
            exit;
        }
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($id > 0) {
            $this->modelComment->deleteComment($id);
        }
        header('Location: index.php?action=managecomments');
        exit;
    }
}