<?php

$action = $_GET['action'] ?? '/';

try {
    switch ($action){
        case '/';
        case 'home':
            $controller = new ProductController();
            $controller->Home();
            break;

        case 'productDetail':
            $controller = new ProductController();
            $controller -> detail();
            break;
        
        
    }
}catch(Exception $e){
    echo $e->getMessage();
}