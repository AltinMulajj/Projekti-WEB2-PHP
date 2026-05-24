<?php
class Validator {

    public static function validateEmail($email) {
        $regexp = "/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/";
        return preg_match($regexp, $email);
    }

    public static function validatePhone($phone) {
        $pattern = "/^(\+383\s|0)?4[3-9]\s[0-9]{3}\s[0-9]{3}$/";
        return preg_match($pattern, $phone);
    }

    public static function sanitizeInput($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }
}
?>
