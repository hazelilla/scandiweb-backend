<?php
require_once 'Controllers/ProductController.php';

$method = $_SERVER['REQUEST_METHOD'];

$controller = new \ProductController();

function returnJson(mixed $data): void
{
    header('Content-Type: application/json');
    echo json_encode($data);
}

switch ($method) {
    case 'GET':
        echo 'yaaay';
        returnJson($controller->getAllProducts());
        break;
    case 'POST':
        returnJson($controller->createProduct(json_decode(file_get_contents('php://input'))));
        break;
    case 'DELETE':
        returnJson($controller->deleteProducts(json_decode(file_get_contents('php://input')['productIds'])));
        break;
}