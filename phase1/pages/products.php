<?php
require_once __DIR__ . '/../data/products-data.php';

// SORTINGU
if (isset($_GET['sort'])) {
    if ($_GET['sort'] == 'price') {
        usort($products, fn($a, $b) => $a['price'] <=> $b['price']);
    } elseif ($_GET['sort'] == 'name') {
        usort($products, fn($a, $b) => strcmp($a['name'], $b['name']));
    }
}
?>

<!-- //  UI PER SORT -->
<form method="GET">
    <select name="sort">
        <option value="">Default</option>
        <option value="price">Sort by Price</option>
        <option value="name">Sort by Name</option>
    </select>
    <button type="submit">Sort</button>
</form>


<!-- SHFAQI PRODUKTET -->
<?php foreach ($products as $product): ?>
    <div class="product-card">
        <img src="<?php echo $product['image']; ?>" width="150">

        <h3><?php echo $product['name']; ?></h3>
        <p><?php echo $product['price']; ?> €</p>

        <a href="product-detail.php?id=<?php echo $product['id']; ?>">
            View Details
        </a>
    </div>
<?php endforeach; ?>