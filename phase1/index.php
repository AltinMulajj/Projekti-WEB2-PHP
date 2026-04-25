<?php

require_once __DIR__ . '/config/session-config.php';
require_once __DIR__ . '/data/products-data.php';
require_once __DIR__ . '/includes/header.php';
?>

<main>

    <section class="hero">
        <img src="/phase1/assets/images/foto4.png" alt="Perla Glow Hero" />
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
                $featured = array_filter($products, function($p){
                    return $p['featured'] === true;
                });
                foreach($featured as $product): ?>

                <div class="product-card-1-1">
                    <a href="/pages/product-detail.php?id=<?php echo $product['id'];?>">
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
            <button class="carousel-btn right right1">&#8250;</button>
        </div>
    </section>

    <section class="section2">
        <h2>Week Offers</h2>
        <div class="carousel-wrapper">
            <button class="carousel-btn left left2">&#8249;</button>
            <div class="carousel-track" id="carouselTrack2">

                <?php
                    $on_sale = array_filter($products, function($p){
                        return $p['on_sale'] === true;
                    });
                    foreach($on_sale as $product): ?>

                    <div class="product-card">
                            <a href="/phase1/pages/product-detail.php?id=<?php echo $product['id']; ?>">
                                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" />
                            </a>
                            <h3><?php echo $product['name'];?></h3>
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
            <button class="carousel-btn right right2">&#8250;</button>
        </div>
    </section>

</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>