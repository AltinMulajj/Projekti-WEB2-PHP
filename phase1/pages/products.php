<?php
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../config/session-config.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../classes/Product.php';

$category = $_GET['category'] ?? 'all';
$sort = $_GET['sort'] ?? '';
$search = $_GET['q'] ?? '';

if ($category !== 'all') {
    setcookie(
        'favorite_category',
        $category,
        time() + (86400 * 30),
        '/'
    );
}

$products = Product::all([
    'q' => $search,
    'category' => $category
]);
?>
<main>
    <div class="page-wrap">
        <div class="page-hero">
            <h2>All Products</h2>
            <p>Discover our full collection of beauty &amp; skincare</p>
        </div>
        <div class="page-banner">
            <div>
                <a href="<?php echo BASE_URL; ?>pages/products.php?category=all"      class="page-btn">All</a>
                <a href="<?php echo BASE_URL; ?>pages/products.php?category=makeup"   class="page-btn">Makeup</a>
                <a href="<?php echo BASE_URL; ?>pages/products.php?category=skincare" class="page-btn">Skincare</a>
                <a href="<?php echo BASE_URL; ?>pages/products.php?category=hair"     class="page-btn">Hair</a>
                <a href="<?php echo BASE_URL; ?>pages/products.php?category=tools"    class="page-btn">Tools</a>
            </div>
            <form method="GET">
                <input type="hidden" name="category" value="<?php echo htmlspecialchars($category); ?>">
                <select name="sort" onchange="this.form.submit()">

                    <option value="">Default</option>
                    <option value="price_asc"  <?php echo $sort==='price_asc'  ?'selected':''; ?>>Price: Low to High</option>
                    <option value="price_desc" <?php echo $sort==='price_desc' ?'selected':''; ?>>Price: High to Low</option>
                    <option value="name"       <?php echo $sort==='name'       ?'selected':''; ?>>Name: A-Z</option>
                </select>
            </form>
        </div>
        
        <?php if (empty($products)): ?>
            <div class="no-products">
                <h2>No products found</h2>
                <a href="<?php echo BASE_URL; ?>pages/products.php" class="notify-btn">View All</a>
            </div>
        <?php else: ?>
            <div class="products-grid">
                <?php foreach ($products as $product): ?>
                    <div class="product-card" data-category="<?php echo $product['category']; ?>">
                        <a href="<?php echo BASE_URL; ?>pages/product-detail.php?id=<?php echo $product['id']; ?>">
    <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
</a>
                        <h3><?php echo $product['name']; ?></h3>
                        <p><?php echo number_format($product['price'],2); ?>€</p>
                        <button class="add-to-cart-btn"
                            data-id="<?php echo $product['id']; ?>"
                            data-name="<?php echo $product['name']; ?>"
                            data-price="<?php echo $product['price']; ?>"
                            data-img="<?php echo BASE_URL.$product['image']; ?>">
                            Add to Cart
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</main>
<script src="../assets/js/ajax.js"></script>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>