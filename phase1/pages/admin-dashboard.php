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