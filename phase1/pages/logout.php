<?php
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../config/session-config.php';

session_unset();
session_destroy();

setcookie('favorite_category',  '', time()-3600, '/');
setcookie('registered_user',    '', time()-3600, '/');
setcookie('last_contact_user',  '', time()-3600, '/');

header('Location: ' . BASE_URL . 'index.php');
exit;