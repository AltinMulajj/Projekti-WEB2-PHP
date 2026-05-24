<?php
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../config/session-config.php';
require_once __DIR__ . '/../includes/header.php';
?>
<main>
    <div class="page-wrap">
        <div class="page-hero">
            <h2>Checkout</h2>
            <p>Complete your order</p>
        </div>

        <div class="contact-grid">
            <!-- FORMA E CHECKOUT -->
            <div class="page-card">
                <h3>Shipping Information</h3>
                <form class="contact-form" id="checkoutForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" id="firstName" placeholder="Your name" required>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" id="lastName" placeholder="Your last name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="email" placeholder="your@email.com" required>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" id="address" placeholder="Street address" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" id="city" placeholder="City" required>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" id="phone" placeholder="+383 44 000 000" required>
                        </div>
                    </div>
                    <button type="submit" class="page-btn">Place Order</button>
                </form>
            </div>

            <!-- ORDER SUMMARY -->
            <div class="page-card">
                <h3>Order Summary</h3>
                <div id="checkout-items"></div>
                <hr style="margin:15px 0;">
                <div id="checkout-total" style="font-size:18px;font-weight:600;"></div>
            </div>
        </div>
    </div>
</main>

<div class="popup-overlay" id="orderPopup">
    <div class="popup-box">
        <i class="fas fa-check-circle"></i>
        <h3>Order Placed!</h3>
        <p>Thank you for your order. We'll contact you soon.</p>
        <a href="<?php echo BASE_URL; ?>index.php" class="page-btn">Back to Home</a>
    </div>
</div>

<script>
function getCart() {
    return JSON.parse(localStorage.getItem('cart')) || [];
}

function renderSummary() {
    const cart = getCart();
    const box = document.getElementById('checkout-items');
    const totalEl = document.getElementById('checkout-total');
    let total = 0;

    if (cart.length === 0) {
        box.innerHTML = "<p>Your cart is empty.</p>";
        return;
    }

    cart.forEach(item => {
        total += Number(item.price) * Number(item.quantity);
        box.innerHTML += `
            <div style="display:flex;gap:12px;align-items:center;padding:8px 0;border-bottom:1px solid #eee;">
                <img src="${item.img}" width="50" style="border-radius:6px;">
                <div style="flex:1">
                    <p style="font-size:14px;font-weight:500;">${item.name}</p>
                    <p style="font-size:13px;color:#666;">x${item.quantity}</p>
                </div>
                <p style="font-weight:600;">${(item.price * item.quantity).toFixed(2)}€</p>
            </div>
        `;
    });

    totalEl.innerText = 'Total: ' + total.toFixed(2) + '€';
}

document.getElementById('checkoutForm').addEventListener('submit', function(e) {
    e.preventDefault();
    localStorage.removeItem('cart');
    document.getElementById('orderPopup').classList.add('active');
});

renderSummary();
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>