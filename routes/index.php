<?php

$action = $_GET['action'] ?? '/';

try {
    switch ($action) {
        case '/';
        case 'home':
            $controller = new ProductController();
            $controller->Home();
            break;

        case 'productDetail':
            $controller = new ProductController();
            $controller->detail();
            break;

        case 'store_comment':
            $controller = new CommentController();
            $controller->store();
            break;
        case 'managecomments':
            $controller = new CommentController();
            $controller->index();
            break;
        case 'commenttoggle':
            $controller = new CommentController();
            $controller->toggle();
            break;
        case 'commentdelete':
            $controller = new CommentController();
            $controller->delete();
            break;
        case 'login':
            $controller = new UserController();
            $controller->LoginForm();
            break;
        case 'login_submit':
            $controller = new UserController();
            $controller->loginSubmit();
            break;
        case 'register':
            $controller = new UserController();
            $controller->registerForm();
            break;
        case 'register_submit':
            $controller = new UserController();
            $controller->registerSubmid();
            break;
        case 'logout':
            $controller = new UserController();
            $controller->logout();
            break;
        case 'account':
            $controller = new UserController();
            $controller->account();
            break;
        case 'update_profile':
            $controller = new UserController();
            $controller->updateProFile();
            break;
        case 'change_password':
            $controller = new UserController();
            $controller->changePassword();
            break;
        case 'indexuser':
            $controller = new UserController();
            $controller->index();
            break;
        case 'lockuser':
        case 'lock_user':
            $id = $_GET['id'] ?? 0;
            $status = $_GET['status'] ?? 0; 
            if ($id) {
                $controller = new UserController();
                $controller->lockUser($id, $status);
            } else {
                header('Location: index.php?action=indexuser');
            }
            break;
        case 'update_role':
            $id = $_GET['id'] ?? 0;
            if ($id) {
                $controller = new UserController();
                $controller->updateRole($id);
            } else {
                header('Location: index.php?action=indexuser');
            }
            break;


        case 'update_address':
            $controller = new UserController();
            $controller->updateAddress();
            break;
        case 'indexproduct':
            $controller = new ProductController();
            $controller->indexProduct();
            break;
        case 'createproduct':
            $controller = new ProductController();
            $controller->createProduct();
            break;
        case 'editproduct':
            $controller = new ProductController();
            $controller->editProduct();
            break;
        case 'deleteproduct':
            $controller = new ProductController();
            $controller->deleteProduct();
            break;
        case 'categories':
            $controller = new CategoryController();
            $controller->index();
            break;
        case 'createcategory':
            $controller = new CategoryController();
            $controller->create();
            break;
        case 'storecategory':
            $controller = new CategoryController();
            $controller->store();
            break;
        case 'editcategory':
            $id = $_GET['id'] ?? 0;
            if ($id) {
                $controller = new CategoryController();
                $controller->edit($id);
            } else {
                header("Location: index.php?action=categories");
            }
            break;
        case 'updatecategory':
            $id = $_GET['id'] ?? 0;
            if ($id) {
                $controller = new CategoryController();
                $controller->update($id);
            } else {
                header("Location: index.php?action=categories");
            }
            break;
        case 'deletecategory':
            $id = $_GET['id'] ?? 0;
            if ($id) {
                $controller = new CategoryController();
                $controller->delete($id);
            } else {
                header("Location: index.php?action=categories");
            }
            break;
    }
} catch (Exception $e) {
    echo $e->getMessage();
}