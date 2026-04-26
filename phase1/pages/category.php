<?php

require_once __DIR__ . '/../config/session-config.php';
require_once __DIR__ . '/../data/products-data.php';
require_once __DIR__ . '/../includes/header.php';

$category = $_GET['category'] ?? null;

if (!$category) {
    header('Location: products.php');
    exit;
}

// Filtrimi i produkteve 
$filteredProducts = array_filter($products, function($product) use ($category) {
    return $product['category'] === $category;
});
?>

<main>
    <div class="page-wrap">

        <div class="page-hero">
            <h2><?php echo ucfirst($category); ?></h2>
            <p>Browsing all products in this category</p>
        </div>

        <?php if (empty($filteredProducts)): ?>
            <div class="no-products">
                <h2>No products found</h2>
                <a href="products.php" class="notify-btn">View All</a>
            </div>
        <?php else: ?>
            <div class="products-grid">
                <?php foreach ($filteredProducts as $product): ?>
                    <div class="product-card">
                        <a href="product-detail.php?id=<?php echo $product['id']; ?>">
                            <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" />
                        </a>
                        <h3><?php echo $product['name']; ?></h3>
                        <p><?php echo number_format($product['price'], 2); ?>€</p>
                        <button
                            class="add-to-cart"
                            data-id="<?php echo $product['id']; ?>"
                            data-name="<?php echo $product['name']; ?>"
                            data-price="<?php echo $product['price']; ?>"
                            data-img="<?php echo $product['image']; ?>">
                            Add to Cart
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>