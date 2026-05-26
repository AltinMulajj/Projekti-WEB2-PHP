<?php
require_once __DIR__ . '/config/constants.php';
require_once __DIR__ . '/config/session-config.php';
require_once __DIR__ . '/classes/Product.php';
require_once __DIR__ . '/includes/header.php';
$products = Product::all();
?>

<main>
    <section class="hero">
        <img src="<?php echo BASE_URL; ?>assets/images/foto4.png" alt="Perla Glow Hero" />
        <div class="hero-text">
            <h2>Discover Your Beauty</h2>
            <p>Luxury makeup &amp; skincare curated for you</p>
        </div>
    </section>

    <section class="section2">
        <h2>Most Used Products</h2>
        <div class="carousel-wrapper">
            <button class="carousel-btn left left1">&#8249;</button>
            <div class="carousel-track" id="carouselTrack1">
                <?php
                $featured = array_filter($products, fn($p) => (int)$p['featured'] === 1);
                foreach ($featured as $product): ?>
                    <div class="product-card-1-1">
                        <a href="<?php echo BASE_URL; ?>pages/product-detail.php?id=<?php echo $product['id']; ?>">
                            <img src="<?php echo BASE_URL. $product['image']; ?>" alt="<?php echo $product['name']; ?>" />
                        </a>
                        <h3><?php echo $product['name']; ?></h3>
                        <p><?php echo number_format($product['price'], 2); ?>€</p>
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
            <button class="carousel-btn right right1">&#8250;</button>
        </div>
    </section>

    <section class="section2">
        <h2>Week Offers</h2>
        <div class="carousel-wrapper">
            <button class="carousel-btn left left2">&#8249;</button>
            <div class="carousel-track" id="carouselTrack2">
                <?php
              $on_sale = array_filter($products, fn($p) => (int)$p['on_sale'] === 1);
                foreach ($on_sale as $product): ?>
                    <div class="product-card">
                        <a href="<?php echo BASE_URL; ?>pages/product-detail.php?id=<?php echo $product['id']; ?>">
                            <img src="<?php echo BASE_URL.$product['image']; ?>" alt="<?php echo $product['name']; ?>" />
                        </a>
                        <h3><?php echo $product['name']; ?></h3>
                        <p><?php echo number_format($product['price'], 2); ?>€</p>
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
            <button class="carousel-btn right right2">&#8250;</button>
        </div>
    </section>
</main>
<script src="<?php echo BASE_URL; ?>assets/js/ajax.js"></script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
