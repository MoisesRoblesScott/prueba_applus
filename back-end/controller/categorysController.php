<?php
require_once './models/categorysModel.php';

class CategorysController {
    private $model;

    public function __construct($db) {
        $this->model = new CategorysModel($db);
    }

    public function index() {
        $products = $this->model->getAllCategorys();
        return $products;
    }
}
?>
