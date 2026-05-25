<?php
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../config/session-config.php';
require_once __DIR__ . '/../classes/Validator.php';
require_once __DIR__ . '/../includes/header.php';

$favoriteCategory = $_COOKIE['favorite_category'] ?? null;

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = Validator::sanitizeInput($_POST['name'] ?? '');

    $email = Validator::sanitizeInput($_POST['email'] ?? '');

    $phone = Validator::sanitizeInput($_POST['phone'] ?? '');

    $message = Validator::sanitizeInput($_POST['message'] ?? '');

    if (empty($name)) {
        $errors[] = 'Name is required.';
    }

    if (!Validator::validateEmail($email)) {
        $errors[] = 'Invalid email address.';
    }

    if (
        !empty($phone) &&
        !Validator::validatePhone($phone)
    ) {
        $errors[] = 'Phone format: +383 4X XXX XXX';
    }

    if (empty($message)) {
        $errors[] = 'Message is required.';
    }

    if (empty($errors)) {

        $success = true;

        setcookie(
            'last_contact_user',
            $name,
            time() + 86400,
            '/'
        );
    }
}
?>
<main>
    <div class="page-wrap">
        <div class="page-hero">
            <h2>Contact Us</h2>
            <p>We'd love to hear from you!</p>
            <?php if ($favoriteCategory): ?>
                <p>Your favorite category: <strong><?php echo htmlspecialchars($favoriteCategory); ?></strong></p>
            <?php endif; ?>
        </div>
        <div class="contact-grid">
            <div class="page-card">
                <?php if (!empty($errors)): ?>
                    <div style="background:#ffe0e0;border:1px solid #f0c2c2;border-radius:12px;padding:12px;margin-bottom:16px;">
                        <?php foreach ($errors as $e): ?>
                            <p style="color:#c00;font-size:14px;">⚠ <?php echo $e; ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <form class="contact-form" method="POST" action="">
                    <div class="form-row">
                        <div class="form-group">
                            <label>First Name *</label>
                            <input type="text" name="name" placeholder="Your name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label>Email *</label>
                            <input type="text" name="email" placeholder="your@email.com" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="phone" placeholder="+383 44 000 000" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label>Message *</label>
                        <textarea name="message" rows="5" placeholder="Write your message..."><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                    </div>
                    <button type="submit" class="page-btn">Send Message</button>
                </form>
            </div>
            <div class="page-card contact-info">
                <h3>Get in Touch</h3>
                <p><i class="fas fa-map-marker-alt"></i> Prishtinë, Kosovë</p>
                <p><i class="fas fa-envelope"></i> hello@perlaglow.ks</p>
                <p><i class="fas fa-phone"></i> +383 43 000 000</p>
                <div class="contact-hours">
                    <h4>Working Hours</h4>
                    <p>Monday – Friday: 9:00 – 18:00</p>
                    <p>Saturday: 10:00 – 15:00</p>
                    <p>Sunday: Closed</p>
                </div>
                <div class="contact-mini">
                    <i class="fas fa-heart"></i>
                    <p>Follow us <strong>@perlaglow</strong></p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php if ($success): ?>
<div class="popup-overlay active" id="successPopup">
    <div class="popup-box">
        <i class="fas fa-check-circle"></i>
        <h3>Message Sent!</h3>
        <p>Thank you! We'll get back to you soon.</p>
        <button class="page-btn" id="closePopup">Close</button>
    </div>
</div>
<script>
document.getElementById('closePopup').onclick = function() {
    document.getElementById('successPopup').classList.remove('active');
};
</script>
<?php endif; ?>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>