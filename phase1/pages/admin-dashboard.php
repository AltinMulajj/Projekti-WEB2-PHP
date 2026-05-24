<?php
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../config/session-config.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../classes/Product.php';

requireRole('admin');

$message = '';
$messageType = 'success';
try {

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {

        $action = $_POST['action'];

        if ($action === 'create') {

            if (Product::create($_POST)) {

                $message = 'Produkti u shtua me sukses.';

            } else {

                $message = 'Shtimi i produktit deshtoi.';
                $messageType = 'error';
            }
        }
        if ($action === 'update') {

            $id = trim($_POST['id']);

            if ($id !== '' && Product::update($id, $_POST)) {

                $message = 'Produkti u perditesua me sukses.';

            } else {

                $message = 'Perditesimi deshtoi.';
                $messageType = 'error';
            }
        }
                if ($action === 'delete') {

            $id = trim($_POST['id']);

            if ($id !== '' && Product::delete($id)) {

                $message = 'Produkti u fshi me sukses.';

            } else {

                $message = 'Fshirja deshtoi.';
                $messageType = 'error';
            }
        }
    }

    if (isset($_GET['delete'])) {

        $id = trim($_GET['delete']);

        if ($id !== '' && Product::delete($id)) {

            $message = 'Produkti u fshi me sukses.';

        } else {

            $message = 'Fshirja deshtoi.';
            $messageType = 'error';
        }
    }
        $search = $_GET['q'] ?? '';
    $category = $_GET['category'] ?? 'all';
    $sort = $_GET['sort'] ?? '';

    $products = Product::all([
        'q' => $search,
        'category' => $category,
        'sort' => $sort
    ]);

    $editProduct = null;

    if (!empty($_GET['edit'])) {
        $editProduct = Product::find($_GET['edit']);
    }

} catch (Throwable $e) {

    $message = $e->getMessage();
    $messageType = 'error';

    $products = [];
    $editProduct = null;
}
require_once __DIR__ . '/../includes/header.php';
?>

<main>

<div class="page-wrap">

    <div class="page-hero">
        <h2>Admin Dashboard</h2>
        <p>Manage products from dashboard</p>
    </div>

    <?php if ($message !== ''): ?>

        <div style="
            padding:12px;
            margin-bottom:20px;
            border-radius:10px;
        ">
            <?php echo $message; ?>
        </div>

    <?php endif; ?>