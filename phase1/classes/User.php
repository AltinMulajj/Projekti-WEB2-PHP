<?php

require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../config/database.php';

class User {

    private static $conn = null;

    public static function db() {

        if (self::$conn === null) {

            self::$conn = mysqli_connect(
                DB_HOST,
                DB_USER,
                DB_PASS,
                DB_NAME
            );

            if (!self::$conn) {
                die("Database connection failed: " . mysqli_connect_error());
            }

            mysqli_set_charset(self::$conn, "utf8mb4");
        }

        return self::$conn;
    }

    public static function register(
        string $name,
        string $email,
        string $password
    ): bool {

        $conn = self::db();

        $name = trim($name);
        $email = trim($email);

        if (empty($name) || empty($email) || empty($password)) {
            return false;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        if (strlen($password) < 6) {
            return false;
        }

        $check = mysqli_prepare(
            $conn,
            "SELECT id FROM users WHERE email=?"
        );

        mysqli_stmt_bind_param(
            $check,
            "s",
            $email
        );

        mysqli_stmt_execute($check);

        $result = mysqli_stmt_get_result($check);

        if (mysqli_num_rows($result) > 0) {
            return false;
        }

        $hashedPassword = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO users(name,email,password,role)
             VALUES(?,?,?,'user')"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "sss",
            $name,
            $email,
            $hashedPassword
        );

        return mysqli_stmt_execute($stmt);
    }

    public static function login(
        string $email,
        string $password
    ): array|false {

        $conn = self::db();

        $stmt = mysqli_prepare(
            $conn,
            "SELECT * FROM users
             WHERE email=?
             LIMIT 1"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "s",
            $email
        );

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $user = mysqli_fetch_assoc($result);

        if (
            $user &&
            password_verify(
                $password,
                $user['password']
            )
        ) {
            return $user;
        }

        return false;
    }

    public static function escape(
        string $value
    ): string {

        return htmlspecialchars(
            $value,
            ENT_QUOTES,
            'UTF-8'
        );
    }
}
?>