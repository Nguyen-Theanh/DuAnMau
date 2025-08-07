<?php 

define('BASE_URL'       , 'http://localhost:8080/PH58569/');

define('DB_HOST'    , 'localhost');
define('DB_PORT'    , 3306);
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME'    , 'duanmau');  // Tên database

define('DB_OPTIONS', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

define('PATH_ROOT'    , __DIR__ . '/../');
define('PATH_VIEW_MAIN',    PATH_ROOT . 'views/trangchu.php');


