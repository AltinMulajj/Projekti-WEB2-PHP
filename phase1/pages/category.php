<?php
require_once __DIR__ . '/../data/products-data.php';

$category = $_GET['category'] ?? null;

if (!$category) {
    echo "No category selected";
    exit;
}

$filteredProducts = array_filter($products, function($product) use ($category) {
    return $product['category'] === $category;
});
?>


<h2>Category: <?php echo ucfirst($category); ?></h2>

<?php if (empty($filteredProducts)): ?>
    <p>No products found.</p>
<?php else: ?>
    <?php foreach ($filteredProducts as $product): ?>
        <div class="product-card">
            <img src="<?php echo $product['image']; ?>" width="150">

            <h3><?php echo $product['name']; ?></h3>
            <p><?php echo $product['price']; ?> €</p>

            <a href="product-detail.php?id=<?php echo $product['id']; ?>">
                View Details
            </a>
        </div>
    <?php endforeach; ?>
<?php endif; ?>