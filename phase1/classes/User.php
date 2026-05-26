<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/constants.php';

class User {

    public static function db() {
        global $conn;
        return $conn;
    }

    public static function register(string $name, string $email, string $password): bool {
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

        $check = mysqli_prepare($conn, "SELECT id FROM users WHERE email=?");
        mysqli_stmt_bind_param($check, "s", $email);
        mysqli_stmt_execute($check);

        $result = mysqli_stmt_get_result($check);

        if (mysqli_num_rows($result) > 0) {
            return false;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO users(name,email,password,role)
             VALUES(?,?,?,'user')"
        );

        mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedPassword);

        return mysqli_stmt_execute($stmt);
    }

    public static function login(string $email, string $password): array|false {
        $conn = self::db();

        $stmt = mysqli_prepare(
            $conn,
            "SELECT * FROM users WHERE email=? LIMIT 1"
        );

        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }

    public static function all(): array {
        $conn = self::db();

        $result = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");

        $users = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }

        return $users;
    }

    public static function find(int $id): ?array {
        $conn = self::db();

        $stmt = mysqli_prepare(
            $conn,
            "SELECT * FROM users WHERE id=? LIMIT 1"
        );

        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_assoc($result) ?: null;
    }

    public static function update(int $id, array $data): bool {
        $conn = self::db();

        $name = trim($data['name']);
        $email = trim($data['email']);
        $role = trim($data['role']);

        if (empty($name) || empty($email) || empty($role)) {
            return false;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $stmt = mysqli_prepare(
            $conn,
            "UPDATE users SET name=?, email=?, role=? WHERE id=?"
        );

        mysqli_stmt_bind_param($stmt, "sssi", $name, $email, $role, $id);

        return mysqli_stmt_execute($stmt);
    }

    public static function delete(int $id): bool {
        $conn = self::db();

        $stmt = mysqli_prepare(
            $conn,
            "DELETE FROM users WHERE id=?"
        );

        mysqli_stmt_bind_param($stmt, "i", $id);

        return mysqli_stmt_execute($stmt);
    }

    public static function escape(string $value): string {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}

?>