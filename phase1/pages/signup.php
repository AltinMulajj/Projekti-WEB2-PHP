<?php
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../config/session-config.php';
require_once __DIR__ . '/../classes/User.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if (empty($name) || empty($email) || empty($password)) {
        $message = "Plotëso të gjitha fushat.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Email nuk është valid.";
    } elseif (strlen($password) < 6) {
        $message = "Password duhet min 6 karaktere.";
    } else {
        $success = User::register($name, $email, $password);

        if ($success) {
            header("Location: " . BASE_URL . "pages/login.php");
            exit;
        } else {
            $message = "Regjistrimi dështoi. Email mund të ekzistojë tashmë.";
        }
    }
}

require_once __DIR__ . '/../includes/header.php';
?>

<main class="signup-wrapper">
    <div class="signup-card">
        <h2>Create Account</h2>
        <p>Krijo llogari të re</p>

        <?php if (!empty($message)): ?>
            <p style="color:red;"><?php echo User::escape($message); ?></p>
        <?php endif; ?>

        <form class="signup-form" method="POST">
            <div class="input-group">
                <label>Full Name</label>
                <input type="text" name="name" required>
            </div>

            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button class="signup-btn" type="submit">Sign Up</button>
        </form>

        <div class="signup-footer">
            <p>Already have account?</p>
            <a href="<?php echo BASE_URL; ?>pages/login.php">Login</a>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>