<?php
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
    echo "Product not found";
    exit;
}
?>

<!-- Shfaqja e detajeve te produkteve  -->
<h2><?php echo $selectedProduct['name']; ?></h2>

<img src="<?php echo $selectedProduct['image']; ?>" width="200">

<p><?php echo $selectedProduct['description']; ?></p>

<p>Price: <?php echo $selectedProduct['price']; ?> €</p>