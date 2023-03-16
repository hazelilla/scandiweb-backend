<?php

require_once dirname(__FILE__) . '/../CustomPDO.php';
require_once dirname(__FILE__) . '/../Models/Product.php';
require_once dirname(__FILE__) . '/../ProductList.php';

class ProductController
{
    private CustomPDO $pdo;
    private ProductList $productList;

    public function __construct()
    {
        $this->pdo = new CustomPDO();
        $this->productList = new ProductList($this->pdo);
    }

    public function getAllProducts(): array
    {
        return $this->productList->getProducts();
    }

    public function createProduct(mixed $data): bool
    {
        return $this->productList->createProduct($data);
    }

    public function deleteProducts(array $productIDs): bool
    {
        return $this->productList->deleteProducts($productIDs);
    }

}