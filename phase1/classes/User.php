<?php

class User {

    private string $username;
    private string $password;
    private string $role;

    public function __construct(
        string $username,
        string $password,
        string $role = "user"
    ) {
        $this->username = $username;
        $this->password = $password;
        $this->role     = $role;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getRole(): string {
        return $this->role;
    }

    public function verifyPassword(string $password): bool {
        return $this->password === $password;
    }

    public function login(string $username, string $password): bool {
        return $this->username === $username && $this->verifyPassword($password);
    }

    public function toArray(): array {
        return [
            'username' => $this->username,
            'role'     => $this->role
        ];
    }

    public static function fromArray(array $data): self {
        return new self(
            $data['username'],
            $data['password'],
            $data['role'] ?? 'user'
        );
    }
}