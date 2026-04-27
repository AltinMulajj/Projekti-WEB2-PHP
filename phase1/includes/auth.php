<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isLoggedIn() {
    return isset($_SESSION["user"]);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: /Projekti-WEB2-PHP/phase1/pages/login.php");
        exit;
    }
}

function currentUser() {
    return $_SESSION["user"] ?? null;
}

function requireRole($role) {
    requireLogin();

    if ($_SESSION["user"]["role"] !== $role) {
        header("Location: /Projekti-WEB2-PHP/phase1/index.php");
        exit;
    }
}