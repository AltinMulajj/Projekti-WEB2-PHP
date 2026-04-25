<?php

require_once __DIR__ . '/../config/session-config.php';
require_once __DIR__ . '/../data/products-data.php';

$id = $_GET['id'] ?? null;

$selectedProduct = null;

foreach ($products as $product) {
    if ($product['id'] === $id) {
        $selectedProduct = $product;
        break;
    }
}

if (!$selectedProduct) {
    header('Location: products.php');
    exit;
}

require_once __DIR__ . '/../includes/header.php';
?>

<main>
    <div class="product-page">
 
   
        <div class="product-image">
            <img src="<?php echo $selectedProduct['image']; ?>" alt="<?php echo $selectedProduct['name']; ?>" />
        </div>
 
        
        <div class="product-details">
            <h2><?php echo $selectedProduct['name']; ?></h2>
 
            <p class="price"><?php echo number_format($selectedProduct['price'], 2); ?>€</p>
 
            <p class="description"><?php echo $selectedProduct['description']; ?></p>
 
            <?php if ($selectedProduct['on_sale']): ?>
                <p style="color: #c8102e; font-weight: bold;">On Sale!</p>
            <?php endif; ?>
 
            <button
                class="add-to-cart"
                data-id="<?php echo $selectedProduct['id']; ?>"
                data-name="<?php echo $selectedProduct['name']; ?>"
                data-price="<?php echo $selectedProduct['price']; ?>"
                data-img="<?php echo $selectedProduct['image']; ?>">
                Add to Cart
            </button>
 
            <br><br>
            <a href="/phase1/pages/products.php" class="page-btn">Back to Products</a>
        </div>
 
    </div>
</main>
 
<?php require_once __DIR__ . '/../includes/footer.php'; ?>