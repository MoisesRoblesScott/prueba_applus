<?php
require_once './controller/productsController.php';
require_once './controller/categorysController.php';

require_once './conexion/conexion.php';

$controllerProducts  = new ProductsController($db);
$controllerCategorys = new CategorysController($db);

$data = [
    "products"  => $controllerProducts->index(),
    "categorys" => $controllerCategorys->index(),
];

$param = json_decode(file_get_contents('php://input'), true);

switch ($param['param']) {
    case 'create':
        $controllerProducts->create($param['data']);
        break;
    case 'update':
        $controllerProducts->edit($param['data']);
        break;
    case 'delete':
        $controllerProducts->delete($param['data']);
        break;
    default:
        print_r(json_encode($data));
}
?>
