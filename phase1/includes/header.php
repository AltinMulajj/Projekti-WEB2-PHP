<?php

if(session_status() === PHP_SESSION_NONE){
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perla Glow</title>
    <link rel="stylesheet" href="/phase1/assets/css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>
<header>
    <div class="top-bar">
        <div class="left">
            <h1><a href="/phase1/index.php">Perla Glow</a></h1>
        </div>

        <div class="right">
            <form action="/phase1/pages/products.php" method="get">
                <input type="search" name="q" placeholder="search..." />
                <button type="submit" class="search-btn">
                    <i class="fas fa-search"></i>
                </button>
            </form>

            <nav>
                <?php if(isset($_SESSION['user'])):?>
                    <a href="/phase1/pages/profile.php"><i class="fas fa-user"></i></a>

                <?php if($_SESSION['user']['role'] === 'admin'): ?>
                    <a href="/phase1/pages/admin-dashboard.php"><i class="fas fa-cog"></i></a>
                <?php endif; ?>
                
                <a href="/phase1/pages/logout.php"><i class="fas fa-sing-out-alt"></i></a>
                <?php else: ?>
                    <a href="/phase1/pages/login.php"><i class="fas fa-user"></i></a>
                <?php endif; ?>

                <a href="/phase1/pages/cart.php"><i class="fas fa-shopping-cart"></i></a>
            </nav>
        </div>
    </div>

    <?php require_once __DIR__ . '/navigation.php';?>
</header>
