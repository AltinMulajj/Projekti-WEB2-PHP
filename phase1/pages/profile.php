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

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
