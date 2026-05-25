<?php
include 'includes/header.php';
include 'includes/navigation.php';

$api_url = "http://makeup-api.herokuapp.com/api/v1/products.json?brand=maybelline";

$json_data = @file_get_contents($api_url);

$external_products = json_decode($json_data, true);

$products_to_show = is_array($external_products) ? array_slice($external_products, 0, 12) : [];
?>

<div class="container mx-auto my-12 px-4">
    <h1 class="text-3xl font-bold text-center text-pink-600 mb-2">Produkte të Rekomanduara (Maybelline)</h1>
    <p class="text-center text-gray-500 mb-10">Këto të dhëna tërhiqen direkt nga një Web API e jashtme në kohë reale.</p>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php if (!empty($products_to_show)): ?>
            <?php foreach ($products_to_show as $prod): ?>
                <div class="border rounded-lg p-4 bg-white shadow-sm flex flex-col justify-between hover:shadow-md transition">
                    <div>
                        <img src="<?php echo $prod['image_link']; ?>" alt="<?php echo $prod['name']; ?>" class="w-full h-40 object-contain mb-4" onerror="this.src='assets/images/default.jpg'">
                        <h3 class="font-semibold text-gray-800 text-sm mb-2 line-clamp-2"><?php echo htmlspecialchars($prod['name']); ?></h3>
                        <span class="text-xs bg-pink-100 text-pink-700 px-2 py-0.5 rounded-full font-bold uppercase"><?php echo htmlspecialchars($prod['product_type']); ?></span>
                    </div>
                    <div class="mt-4">
                        <span class="text-lg font-bold text-gray-900">$<?php echo htmlspecialchars($prod['price']); ?></span>
                        <a href="<?php echo $prod['product_link']; ?>" target="_blank" class="block text-center bg-pink-500 hover:bg-pink-600 text-white text-xs font-medium py-2 px-4 rounded mt-2 transition">
                            Shiko Artikullin
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-red-500 col-span-full">Nuk u gjet asnjë e dhënë nga API i jashtëm ose nuk ka lidhje me internetin.</p>
        <?php endif; ?>
    </div>
</div>

<?php 
include 'includes/footer.php'; 
?>