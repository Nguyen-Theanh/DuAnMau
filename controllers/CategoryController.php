<?php

class CategoryController
{
    protected $model;

    public function __construct()
    {
        require_once __DIR__ . '/../models/CategoryModel.php';
        $this->model = new CategoryModel();
    }

    public function index()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header("Location: index.php?action=login");
            exit;
        }

        $keyword = $_GET['keyword'] ?? '';
        if ($keyword !== '') {
            $categories = $this->model->searchCategories($keyword);
        } else {
            $categories = $this->model->getAllCategories();
        }
        require __DIR__ . '/../views/categories/index.php';
    }
    public function create()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header("Location: index.php?action=login");
            exit;
        }
        require __DIR__ . '/../views/categories/create.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
                header("Location: index.php?action=login");
                exit;
            }
            $name = trim($_POST['name']);
            $description = trim($_POST['description'] ?? '');

            if (empty($name)) {
                $_SESSION['error'] = "Tên danh mục không được để trống.";
                header("Location: index.php?action=createcategory");
                exit;
            }
            if ($this->model->addCategory($name, $description)) {
                $_SESSION['success'] = "Thêm danh mục thành công";
                header("Location: index.php?action=categories");
                exit;
            } else {
                $_SESSION['error'] = "Có lỗi xảy ra khi thêm danh mục";
                header("Location: index.php?action=createcategory");
                exit;
            }
        }
    }

    public function edit($id)
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header("Location: index.php?action=login");
            exit;
        }

        $category = $this->model->getCategoryById($id);
        if (!$category) {
            $_SESSION['error'] = "Danh mục không tồn tại.";
            header("Location: index.php?action=categories");
            exit;
        }
        require __DIR__ . '/../views/categories/edit.php';
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
                header("Location: index.php?action=login");
                exit;
            }
            $name = trim($_POST['name']);
            $description = trim($_POST['description'] ?? '');

            if (empty($name)) {
                $_SESSION['error'] = "Tên danh mục không dược để trống";
                header("Location: index.php?action=editcategory&id=$id");
                ;
                exit;
            }

            if ($this->model->updateCategory($id, $name, $description)) {
                $_SESSION['success'] = "Cập nhật danh mục thành công.";
                header("Location: index.php?action=categories");
                exit;
            } else {
                $_SESSION['error'] = "Có lỗi xảy ra khi cập nhật danh mục.";
                header("Location: index.php?action=editcategory&id=$id");
                exit;
            }
        }
    }

    public function delete($id)
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header("Location: index.php?action=login");
            exit;
        }
        $result = $this->model->deleteCategory($id);
        if ($result) {
            $_SESSION['success'] = "Xóa danh mục thành công.";
        } else {
            $_SESSION['error'] = "Có lỗi xảy ra khi xóa danh mục.";
        }
        header('Location: index.php?action=categories');
        exit;
    }
}

