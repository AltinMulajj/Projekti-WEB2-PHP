<?php
header('Content-Type: application/json');

$conn = mysqli_connect("localhost", "root", "", "perla_glow");

if (!$conn) {
    echo json_encode(["success" => false, "message" => "Lidhja me databazë dështoi."]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    if ($id <= 0) {
        echo json_encode(["success" => false, "message" => "ID e pavlefshme."]);
        exit;
    }

    $query = "DELETE FROM products WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(["success" => true, "message" => "Produkti u fshie me sukses!"]);
        } else {
            echo json_encode(["success" => false, "message" => "Fshirja dështoi në databazë."]);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(["success" => false, "message" => "Gabim në prepared statement."]);
    }
    
    mysqli_close($conn);
    exit;
}
?>