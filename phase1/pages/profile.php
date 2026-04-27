<?php
require_once __DIR__ . '/../config/session-config.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];

require_once __DIR__ . '/../includes/header.php';
?>

<main class="signin-wrapper">
    <div class="signin-card">
        <h2>My Profile</h2>
        <p>Account information</p>

        <div class="input-group">
            <label>Name</label>
            <input type="text" value="<?php echo htmlspecialchars($user['name']); ?>" readonly>
        </div>

        <div class="input-group">
            <label>Email</label>
            <input type="email" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
        </div>

        <div class="input-group">
            <label>Role</label>
            <input type="text" value="<?php echo htmlspecialchars($user['role']); ?>" readonly>
        </div>

        <a href="logout.php">
            <button class="signin-btn" type="button">Logout</button>
        </a>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>