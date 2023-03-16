<?php

class Furniture extends Product
{
    protected float $height;
    protected float $width;
    protected float $length;

    public function __construct(int $sku, string $name, float $price, float $height, float $width, float $length)
    {
        parent::__construct($sku, $name, $price);
        $this->setHeight($height);
        $this->setWidth($width);
        $this->setLength($length);
    }

    public function getHeight(): float
    {
        return $this->height;
    }

    public function getWidth(): float
    {
        return $this->width;
    }

    public function getLength(): float
    {
        return $this->length;
    }

    public function setHeight(float $height): void
    {
        $this->size = $height;
    }

    public function setWidth(float $width): void
    {
        $this->size = $width;
    }

    public function setLength(float $length): void
    {
        $this->size = $length;
    }

    public function getSpecificAttribute(): int
    {
        return $this->getHeight() . "x" . $this->getWidth() . "x" . $this->getLength();
    }

    public function save(): void
    {
        $this->saveProduct();

        $pdo = new CustomPDO();
        $query1 = "INSERT INTO furnitures (product_sku, width, height, length) values (:sku, :width, :height, :length)";
        $stmt = $pdo->prepare($query1);
        $stmt->bindParam(":sku", $this->sku);
        $stmt->bindParam(":width", $this->width);
        $stmt->bindParam(":height", $this->height);
        $stmt->bindParam(":length", $this->length);

        if (!$stmt->execute()) {
            echo "ERROR SAVING DB";
            die();
        }
    }
}