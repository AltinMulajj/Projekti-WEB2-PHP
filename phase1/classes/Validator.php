<?php

class Validator {

    public static function validateEmail(string $email): bool {
        return preg_match("/^[\w\.-]+@[\w\.-]+\.\w+$/", $email) === 1;
    }

    public static function validateNumber(string $number): bool {
        return preg_match("/^[0-9]+$/", $number) === 1;
    }

    public static function validatePassword(string $password): bool {
        // min 6 karaktere + 1 numër
        return preg_match("/^(?=.*\d).{6,}$/", $password) === 1;
    }
}
?>