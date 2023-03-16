<?php

class DVD extends Product
{
    private int $size;

    public function __construct(int $sku, string $name, float $price, int $size)
    {
        parent::__construct($sku, $name, $price);
        $this->setSize($size);
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function setSize(int $size): void
    {
        $this->size = $size;
    }

    public function getSpecificAttribute(): int
    {
        return $this->size;
    }

    public function save():void
    {
        $this->saveProduct();

        $pdo = new CustomPDO();
        $query1 = "INSERT INTO dvds (product_sku, size) values (:sku, :size)";
        $stmt = $pdo->prepare($query1);
        $stmt->bindParam(":sku", $this->sku);
        $stmt->bindParam(":size", $this->size);

        if (!$stmt->execute()) {
            echo "ERROR SAVING DB";
            die();
        }
    }
}