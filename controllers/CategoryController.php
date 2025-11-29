<?php

class CategoryController{
    protected $model;

    public function __construct(){
        require_once __DIR__ . '/../models/CategoryModel.php';
        $this->model = new CategoryModel();
    }

    
}

