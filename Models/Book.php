<?php

class Book extends Product
{
    private float $weight;

    public function __construct(int $sku, string $name, float $price, float $weight)
    {
        parent::__construct($sku, $name, $price);
        $this->setWeight($weight);
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): void
    {
        $this->weight = $weight;
    }

    public function getSpecificAttribute(): int
    {
        return $this->size;
    }

    public function save(): void
    {
        $this->saveProduct();

        $pdo = new CustomPDO();
        $query1 = "INSERT INTO books (product_sku, weight) values (:sku, :weight)";
        $stmt = $pdo->prepare($query1);
        $stmt->bindParam(":sku", $this->sku);
        $stmt->bindParam(":weight", $this->weight);

        if (!$stmt->execute()) {
            echo "ERROR SAVING DB";
            die();
        }
    }
}