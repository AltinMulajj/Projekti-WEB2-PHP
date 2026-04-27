<?php
require_once "Product.php";

class FeaturedProduct extends Product {

    private float $discount;

    public function __construct(
        string $id,
        string $name,
        float $price,
        string $category,
        string $image,
        string $description,
        float $discount
    ) {
        parent::__construct(
            $id,
            $name,
            $price,
            $category,
            $image,
            $description,
            true,
            false
        );

        $this->discount = $discount;
    }

    public function getDiscountedPrice(): float {
        return $this->getPrice() - $this->discount;
    }
}