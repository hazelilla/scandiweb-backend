<?php

abstract class Product
{
    protected int $sku;
    protected string $name;
    protected float $price;
    protected string $type;


    public function __construct(int $sku, string $name, float $price)
    {
        $this->setSku($sku);
        $this->setName($name);
        $this->setPrice($price);
    }

    public function getSku(): int
    {
        return $this->sku;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setSku(int $sku): void
    {
        $this->sku = $sku;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    abstract public function getSpecificAttribute();

    protected function saveProduct(): void
    {
        $pdo = new CustomPDO();
        $query1 = "INSERT INTO products (sku, name, price) values (:sku, :name, :price)";
        $stmt = $pdo->prepare($query1);
        $stmt->bindParam(":sku", $this->sku);
        $stmt->bindParam(":name", $this->sku);
        $stmt->bindParam(":price", $this->sku);

        if (!$stmt->execute()) {
            echo "ERROR SAVING DB";
            die();
        }
    }

    abstract public function save(): void;
}