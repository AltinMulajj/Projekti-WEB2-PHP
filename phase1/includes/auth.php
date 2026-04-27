<?php

function isLoggedIn(): bool {
    return isset($_SESSION['user']);
}

function requireLogin(): void {
    if (!isLoggedIn()) {
        header('Location: ' . BASE_URL . 'pages/login.php');
        exit;
    }
}

function currentUser(): ?array {
    return $_SESSION['user'] ?? null;
}

function requireRole(string $role): void {
    requireLogin();
    if ($_SESSION['user']['role'] !== $role) {
        header('Location: ' . BASE_URL . 'index.php');
        exit;
    }
}