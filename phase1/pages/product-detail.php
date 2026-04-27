<?php
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../config/session-config.php';
require_once __DIR__ . '/../data/products-data.php';

$id = $_GET['id'] ?? null;
$selectedProduct = null;
foreach ($products as $p) {
    if ($p['id'] === $id) { $selectedProduct = $p; break; }
}
if (!$selectedProduct) {
    header('Location: ' . BASE_URL . 'pages/products.php');
    exit;
}

require_once __DIR__ . '/../includes/header.php';
?>
<main>
    <div class="product-page">
        <div class="product-image">
            <img src="<?php echo $selectedProduct['image']; ?>" alt="<?php echo $selectedProduct['name']; ?>">
        </div>
        <div class="product-details">
            <h2><?php echo $selectedProduct['name']; ?></h2>
            <p class="price"><?php echo number_format($selectedProduct['price'],2); ?>€</p>
            <p class="description"><?php echo $selectedProduct['description']; ?></p>
            <?php if ($selectedProduct['on_sale']): ?>
                <p style="color:#c8102e;font-weight:bold;">🔥 On Sale!</p>
            <?php endif; ?>
            <button class="add-to-cart"
                data-id="<?php echo $selectedProduct['id']; ?>"
                data-name="<?php echo $selectedProduct['name']; ?>"
                data-price="<?php echo $selectedProduct['price']; ?>"
                data-img="<?php echo $selectedProduct['image']; ?>">
                Add to Cart
            </button>
            <br><br>
            <a href="<?php echo BASE_URL; ?>pages/products.php" class="page-btn">← Back to Products</a>
        </div>
    </div>

    <!-- Related Products -->
    <?php
    $related = array_filter($products, fn($p) =>
        $p['category'] === $selectedProduct['category'] && $p['id'] !== $selectedProduct['id']
    );
    $related = array_slice($related, 0, 4);
    ?>
    <?php if (!empty($related)): ?>
    <div class="page-wrap">
        <h2 style="margin-bottom:20px;">Related Products</h2>
        <div class="products-grid">
            <?php foreach ($related as $p): ?>
                <div class="product-card">
                    <a href="<?php echo BASE_URL; ?>pages/product-detail.php?id=<?php echo $p['id']; ?>">
                        <img src="<?php echo $p['image']; ?>" alt="<?php echo $p['name']; ?>">
                    </a>
                    <h3><?php echo $p['name']; ?></h3>
                    <p><?php echo number_format($p['price'],2); ?>€</p>
                    <button class="add-to-cart"
                        data-id="<?php echo $p['id']; ?>"
                        data-name="<?php echo $p['name']; ?>"
                        data-price="<?php echo $p['price']; ?>"
                        data-img="<?php echo $p['image']; ?>">
                        Add to Cart
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>