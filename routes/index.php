<?php

$action = $_GET['action'] ?? '/';

try {
    switch ($action){
        case '/';
        case 'home':
            $controller = new ProductController();
            $controller->Home();
            break;

        
    }
}catch(Exception $e){
    echo $e->getMessage();
}