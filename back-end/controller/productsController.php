<?php
require_once './models/productsModel.php';

class ProductsController {
    private $model;

    public function __construct($db) {
        $this->model = new ProductsModel($db);
    }

    public function index() {
        $products = $this->model->getAllProducts();
        return $products;
    }

    public function create($data) {
        return $this->model->createProduct($data);
    }

    public function edit($data) {
        return $this->model->updateProduct($data);
    }

    public function delete($data) {
        return $this->model->deleteProduct($data['id']);
    }
}
?>
