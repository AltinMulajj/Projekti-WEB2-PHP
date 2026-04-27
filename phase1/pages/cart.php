<?php
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../config/session-config.php';
require_once __DIR__ . '/../includes/header.php';
?>
<main>
    <div class="page-wrap">
        <div class="page-hero">
            <h2>Your Cart</h2>
            <p>Review your selected products</p>
        </div>
        <div id="cart-items"></div>
        <div id="total"></div>
        <div style="text-align:center;margin-top:20px;">
            <a href="<?php echo BASE_URL; ?>pages/checkout.php">
                <button>Proceed to Checkout</button>
            </a>
        </div>
    </div>
</main>
<script>
function getCart() {
    return JSON.parse(localStorage.getItem('cart')) || [];
}

function saveCart(cart) {
    localStorage.setItem('cart', JSON.stringify(cart));
}

function renderCart() {
    const cart = getCart();
    const box = document.getElementById('cart-items');
    const totalEl = document.getElementById('total');
    box.innerHTML = '';
    let total = 0;

    if (cart.length === 0) {
        box.innerHTML = "<p style='text-align:center;margin:40px 0;'>Your cart is empty.</p>";
        totalEl.innerText = '';
        return;
    }

    cart.forEach((item, i) => {
        if (!item || !item.name || isNaN(item.price) || isNaN(item.quantity)) return;
        total += Number(item.price) * Number(item.quantity);
        box.innerHTML += `
            <div style="display:flex;gap:20px;padding:15px;border-bottom:1px solid #ddd;align-items:center;">
                <img src="${item.img}" width="80" style="border-radius:8px;">
                <div style="flex:1">
                    <h4>${item.name}</h4>
                    <p>${item.price} €</p>
                </div>
                <div>
                    <button onclick="changeQty(${i},-1)">−</button>
                    <span style="margin:0 10px">${item.quantity}</span>
                    <button onclick="changeQty(${i},1)">+</button>
                </div>
                <button class="remove-btn" onclick="removeItem(${i})">Remove</button>
            </div>
        `;
    });

    totalEl.innerText = 'Total: ' + total.toFixed(2) + ' €';
}

function changeQty(i, diff) {
    let cart = getCart();
    cart[i].quantity += diff;
    if (cart[i].quantity <= 0) cart.splice(i, 1);
    saveCart(cart);
    renderCart();
}

function removeItem(i) {
    let cart = getCart();
    cart.splice(i, 1);
    saveCart(cart);
    renderCart();
}

renderCart();
</script>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>