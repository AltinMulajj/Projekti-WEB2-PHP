<?php
require_once __DIR__ . '/../config/session-config.php';
require_once __DIR__ . '/../includes/header.php';

require_once __DIR__ . '/../includes/auth.php';
requireLogin();

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

            <div class="page-card">
                <h3><i class="fas fa-cookie-bite"></i> Your Preferences</h3>
                <hr style="margin: 15px 0; opacity: 0.2;">
                
                <p><strong>Last interaction:</strong> <?php echo htmlspecialchars($lastContactName); ?></p>
                <p><strong>Favorite Category:</strong> <?php echo htmlspecialchars($favoriteCat); ?></p>
                
                <div style="margin-top: 20px; padding: 10px; background: #f9f9f9; border-radius: 8px; font-size: 13px;">
                    <p><em>Note: These preferences are stored in your browser cookies.</em></p>
                </div>
            </div>
        </div>

        <div style="text-align: center; margin-top: 30px;">
            <a href="logout.php" class="page-btn" style="text-decoration: none; display: inline-block; background: #ff4d4d;">
                Logout from Account
            </a>
        </div>

    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
