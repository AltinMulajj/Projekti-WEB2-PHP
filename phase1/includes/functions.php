<?php

function getProductById(array $products, string $id): ?array {
    foreach ($products as $product) {
        if ($product['id'] === $id) return $product;
    }
    return null;
}

function filterByCategory(array $products, string $category): array {
    return array_filter($products, fn($p) => $p['category'] === $category);
}

function sortProducts(array $products, string $sort): array {
    switch ($sort) {
        case 'price_asc':
            usort($products, fn($a, $b) => $a['price'] <=> $b['price']);
            break;
        case 'price_desc':
            usort($products, fn($a, $b) => $b['price'] <=> $a['price']);
            break;
        case 'name':
            usort($products, fn($a, $b) => strcmp($a['name'], $b['name']));
            break;
    }
    return $products;
}

function getFeaturedProducts(array $products): array {
    return array_filter($products, fn($p) => $p['featured'] === true);
}

function getOnSaleProducts(array $products): array {
    return array_filter($products, fn($p) => $p['on_sale'] === true);
}

function formatPrice(float $price): string {
    return number_format($price, 2) . '€';
}

function isUserLoggedIn(): bool {
    return isset($_SESSION['user']);
}

function getUserRole(): string {
    return $_SESSION['user']['role'] ?? 'guest';
}