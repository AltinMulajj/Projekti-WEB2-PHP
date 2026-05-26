<?php

require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../config/session-config.php';
require_once __DIR__ . '/../includes/header.php';
$api_url = "https://makeup-api.herokuapp.com/api/v1/products.json?brand=maybelline";

$json_data = @file_get_contents($api_url);

$external_products = json_decode($json_data, true);

$products_to_show = is_array($external_products) ? array_slice($external_products, 0, 12) : [];
?>

<div class="page-wrap">
    <div class="page-hero">
        <h2>Produkte të Rekomanduara (Maybelline)</h2>
        <p>Këto të dhëna tërhiqen direkt nga një Web API e jashtme.</p>
    </div>

    <div class="products-grid">
        <?php if (!empty($products_to_show)): ?>
            <?php foreach ($products_to_show as $prod): ?>

                <div class="product-card">

                    <img src="<?php echo htmlspecialchars($prod['image_link'] ?? ''); ?>"
                         alt="<?php echo htmlspecialchars($prod['name']); ?>">

                    <h3>
                        <?php echo htmlspecialchars($prod['name']); ?>
                    </h3>

                    <p>
                        $<?php echo htmlspecialchars($prod['price'] ?? '0'); ?>
                    </p>

                    <a href="<?php echo htmlspecialchars($prod['product_link'] ?? '#'); ?>"
                       target="_blank"
                       class="page-btn">
                        Shiko Artikullin
                    </a>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <p>Nuk u gjet asnjë e dhënë nga API i jashtëm.</p>

        <?php endif; ?>
    </div>
</div>

<?php 
require_once __DIR__ . '/../includes/footer.php';
?>