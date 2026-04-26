<?php
require_once "Product.php";

class Cart {

    private array $items = [];

    public function addProduct(Product $product, int $quantity = 1): void {
        $id = $product->getId();

        if (isset($this->items[$id])) {
            $this->items[$id]['quantity'] += $quantity;
        } else {
            $this->items[$id] = [
                'product'  => $product,
                'quantity' => $quantity
            ];
        }
    }

    public function removeProduct(string $productId): void {
        unset($this->items[$productId]);
    }

    public function getItems(): array {
        return $this->items;
    }

    public function getTotal(): float {
        $total = 0;

        foreach ($this->items as $item) {
            $total += $item['product']->getPrice() * $item['quantity'];
        }

        return $total;
    }

    public function getFormattedTotal(): string {
        return number_format($this->getTotal(), 2) . '€';
    }

    public function clear(): void {
        $this->items = [];
    }
}
?>