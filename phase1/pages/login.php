<?php
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../config/session-config.php';
require_once __DIR__ . '/../data/user-data.php';

$users = $users ?? [];

if (isset($_COOKIE['registered_user'])) {
    $cookieUser = json_decode($_COOKIE['registered_user'], true);
    if ($cookieUser) $users[] = $cookieUser;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email    = $_POST['email']    ?? '';
    $password = $_POST['password'] ?? '';

    $emailPattern="/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

if(!preg_match($emailPattern,$email)){
    $message="Email format gabim!";
}

else{


    foreach ($users as $user) {
        if ($user['email'] == $email && $user['password'] == $password) {
            $_SESSION['user']          = $user;
            $_SESSION['is_logged_in']  = true;
            $_SESSION['role']          = $user['role'];

            setcookie('favorite_category', 'Makeup', time() + 604800, '/');

            header('Location: ' . BASE_URL . 'index.php');
            exit;
        }
    }
    $message = 'Email ose password gabim!';
}
}

require_once __DIR__ . '/../includes/header.php';
?>
<main class="signin-wrapper">
    <div class="signin-card">
        <h2>Login</h2>
        <p>Kyçu në llogarinë tënde</p>
        <?php if ($message): ?>
            <p style="color:red;"><?php echo $message; ?></p>
        <?php endif; ?>
        <form class="signin-form" method="POST">
            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button class="signin-btn" type="submit">Login</button>
        </form>
        <div class="signin-footer">
            <p>Nuk ke llogari? <a href="<?php echo BASE_URL; ?>pages/signup.php">Sign Up</a></p>
        </div>
    </div>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>