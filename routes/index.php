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
        case 'update_address':
            $controller = new UserController();
            $controller->updateAddress();
            break;
    }
} catch (Exception $e) {
    echo $e->getMessage();
}