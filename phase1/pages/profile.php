<?php

require_once __DIR__ . '/../config/session-config.php';
require_once __DIR__ . '/../includes/header.php';


if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}


$user = $_SESSION['user'];


$lastContactName = $_COOKIE['last_contact_user'] ?? "No recent contact activity";
$favoriteCat     = $_COOKIE['favorite_category'] ?? "None selected";
?>

<main>
    <div class="page-wrap" style="margin-top: 50px; margin-bottom: 50px;">
        
        <div class="page-hero">
            <h1>My Profile</h1>
            <p>Welcome back to Perla Glow, <strong><?php echo htmlspecialchars($user['name']); ?></strong></p>
        </div>

        <div class="contact-grid"> <div class="page-card">
                <h3><i class="fas fa-user-circle"></i> Account Information</h3>
                <hr style="margin: 15px 0; opacity: 0.2;">
                
                <p><strong>Full Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                <p><strong>Account Role:</strong> 
                    <span style="background: #000; color: #fff; padding: 2px 8px; border-radius: 5px; font-size: 12px;">
                        <?php echo htmlspecialchars($user['role']); ?>
                    </span>
                </p>
            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>