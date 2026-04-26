<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!defined('BASE_URL')) {
    define('BASE_URL','/Projekti-WEB2-PHP/phase1/');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Perla Glow</title>

<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">

</head>

<body>

<header>

<div class="top-bar">

<div class="left">
<h1>
<a href="<?php echo BASE_URL; ?>index.php">
Perla Glow
</a>
</h1>
</div>

<div class="right">

<form action="<?php echo BASE_URL; ?>pages/products.php" method="get">
<input type="search" name="q" placeholder="search...">
<button type="submit">🔍</button>
</form>

<nav>

<a href="<?php echo BASE_URL; ?>index.php">Home</a>

<a href="<?php echo BASE_URL; ?>pages/products.php">Products</a>

<a href="<?php echo BASE_URL; ?>pages/cart.php">Cart</a>

<?php if (isset($_SESSION['user'])): ?>

<a href="<?php echo BASE_URL; ?>pages/profile.php">Profile</a>

<a href="<?php echo BASE_URL; ?>pages/logout.php">Logout</a>

<?php else: ?>

<a href="<?php echo BASE_URL; ?>pages/login.php">Login</a>

<a href="<?php echo BASE_URL; ?>pages/signup.php">Sign Up</a>

<?php endif; ?>

</nav>

</div>

</div>

</header>
