<?php 
// Require toàn bộ các file khai báo môi trường, thực thi,...(không require view)

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/ProductController.php';

// Require toàn bộ file Models
require_once './models/ProductModel.php';

$controller = new ProductController();
$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'qlsp':
        $controller->QLSP(); // trang quản lý
        break;
    case 'home':
    default:
        $controller->Home(); // trang chủ
        break;
    case 'xoasp':
        $controller->XoaSP();
        break;
    case 'suasp':
    $controller->SuaSP();
    break;
}