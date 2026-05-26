<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {

    $id = trim($_POST['id'] ?? '');

    if ($id === '') {
        echo json_encode(["success" => false, "message" => "ID e pavlefshme."]);
        exit;
    }

    $stmt = mysqli_prepare($conn, "DELETE FROM products WHERE id = ?");

    if (!$stmt) {
        echo json_encode(["success" => false, "message" => "Gabim në prepared statement."]);
        exit;
    }

    mysqli_stmt_bind_param($stmt, "s", $id);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(["success" => true, "message" => "Produkti u fshi me sukses!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Fshirja dështoi në databazë."]);
    }

    exit;
}

echo json_encode(["success" => false, "message" => "Kërkesë e pavlefshme."]);