<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<header>
    <div class="top-bar">
        <div class="left">
            <h1><a href="<?php echo BASE_URL; ?>index.php">Perla Glow</a></h1>
        </div>

        <div class="right">
            <form action="<?php echo BASE_URL; ?>pages/products.php" method="get">
                <input type="search" name="q" placeholder="search...">
                <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
            </form>

            <a href="<?php echo BASE_URL; ?>pages/cart.php"><i class="fas fa-shopping-cart"></i></a>

            <?php if (isset($_SESSION['user'])): ?>
                <a href="<?php echo BASE_URL; ?>pages/profile.php"><i class="fas fa-user"></i></a>
                <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                    <a href="<?php echo BASE_URL; ?>pages/admin-dashboard.php"><i class="fas fa-cog"></i></a>
                <?php endif; ?>
                <a href="<?php echo BASE_URL; ?>pages/logout.php">Logout</a>
            <?php else: ?>
                <a href="<?php echo BASE_URL; ?>pages/login.php">Login</a>
                <a href="<?php echo BASE_URL; ?>pages/signup.php">Sign Up</a>
            <?php endif; ?>
        </div>
    </div>

    <?php require_once __DIR__ . '/navigation.php'; ?>
</header>