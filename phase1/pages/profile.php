<?php
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../config/session-config.php';
require_once __DIR__ . '/../includes/auth.php';

requireLogin();

require_once __DIR__ . '/../includes/header.php';

$user            = $_SESSION['user'];
$lastContactName = $_COOKIE['last_contact_user'] ?? 'No recent contact activity';
?>
<main>
    <div class="page-wrap" style="margin-top:50px;margin-bottom:50px;">
        <div class="page-hero">
            <h1>My Profile</h1>
            <p>Welcome back, <strong><?php echo htmlspecialchars($user['name']); ?></strong></p>
        </div>
        <div class="contact-grid">
            <div class="page-card">
                <h3><i class="fas fa-user-circle"></i> Account Information</h3>
                <hr style="margin:15px 0;opacity:0.2;">
                <p><strong>Full Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                <p><strong>Role:</strong>
                    <span style="background:#000;color:#fff;padding:2px 8px;border-radius:5px;font-size:12px;">
                        <?php echo htmlspecialchars($user['role']); ?>
                    </span>
                </p>
            </div>
            <div class="page-card">
                <h3><i class="fas fa-cookie-bite"></i> Your Preferences</h3>
                <hr style="margin:15px 0;opacity:0.2;">
                <p><strong>Last contact:</strong> <?php echo htmlspecialchars($lastContactName); ?></p>
                <div style="margin-top:20px;padding:10px;background:#f9f9f9;border-radius:8px;font-size:13px;">
                    <p><em>Preferences are stored in your browser cookies.</em></p>
                </div>
            </div>
        </div>
        <div style="text-align:center;margin-top:30px;">
            <a href="<?php echo BASE_URL; ?>pages/logout.php" class="page-btn" style="background:#ff4d4d;">
                Logout
            </a>
        </div>
    </div>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>