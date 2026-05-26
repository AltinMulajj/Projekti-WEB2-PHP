<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $action = $_POST['action'] ?? '';
    $productId = trim((string)($_POST['product_id'] ?? ''));

    if ($productId === '') {
        echo json_encode(["success" => false, "message" => "ID e produktit mungon."]);
        exit;
    }

    if ($action === 'add') {
        
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]++;
        } else {
            $_SESSION['cart'][$productId] = 1;
        }

        $totalItems = array_sum($_SESSION['cart']);

        echo json_encode([
            "success" => true,
            "message" => "Produkti u shtua në shportë me sukses!",
            "totalItems" => $totalItems
        ]);
        exit;
    }
}

echo json_encode(["success" => false, "message" => "Kërkesë e paligjshme."]);
exit;
?>
