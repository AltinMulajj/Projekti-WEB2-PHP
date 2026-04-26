<?php

define('BASE_URL', '/Projekti-WEB2-PHP/phase1/');

if (session_status() === PHP_SESSION_NONE) {

    ini_set('session.gc_maxlifetime', 3600);

    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => false,
        'httponly' => true,
    ]);

    session_start();
}