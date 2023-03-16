<?php

class ProductList
{
    private CustomPDO $pdo;

    public function __construct(CustomPDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getProducts(): array
    {
        $stmt = $this->pdo->prepare("
                SELECT p.sku, p.name, p.price,
                       d.size, b.weight, f.height, f.width, f.length
                FROM products p
                LEFT JOIN dvds d ON p.sku = d.product_sku
                LEFT JOIN books b ON p.sku = b.product_sku
                LEFT JOIN furnitures f ON p.sku = f.product_sku
                ORDER BY p.sku");
        $stmt->execute();
        $products = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (!empty($row['size'])) {
                $product = new DVD($row['sku'], $row['name'], $row['price'], $row['size']);
            } else if (!empty($row['weight'])) {
                $product = new Book($row['sku'], $row['name'], $row['price'], $row['weight']);
            } else if (!empty($row['width'])){
                $product = new Furniture($row['sku'], $row['name'], $row['price'], $row['height'], $row['width'], $row['length']);
            }
            $products[] = $product;
        }
        return $products;
    }

    public function createProduct(mixed $data): bool
    {
        if(!empty($data['size'])){
            $product = new DVD($data['sku'], $data['name'], $data['price'], $data['size']);
        }
        if(!empty($data['weight'])){
            $product = new Book($data['sku'], $data['name'], $data['price'], $data['weight']);
        }
        if(!empty($data['width'])){
            $product = new Furniture($data['sku'], $data['name'], $data['price'], $data['height'], $data['width'], $data['length']);
        }

        $product->save();
    }

    public function deleteProducts(array $productIds): bool
    {
        if (!$this->deleteProductsByType("dvds", $productIds)) {
            return false;
        }
        if (!$this->deleteProductsByType("furnitures", $productIds)) {
            return false;
        }
        if (!$this->deleteProductsByType("books", $productIds)) {
            return false;
        }
        if (!$this->deleteProductsByType("products", $productIds)) {
            return false;
        }

        return true;
    }

    function deleteProductsByType(string $typeProduct, array $productIds): bool
    {
        $stmt = $this->pdo->prepare('delete * from :typeProduct where id in :ids');
        $stmt->bindParam(":typeProduct", $typeProduct);
        $stmt->bindParam(":ids", $productIds);

        if (!$stmt->execute()) {
            return false;
        }

        return true;
    }
}