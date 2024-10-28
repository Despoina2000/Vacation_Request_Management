<?php

class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $username;
    public $role;
    public $password;
    private $salt;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register($username, $password, $role) {
        $this->salt = bin2hex(random_bytes(16));
        $hashed_password = hash('sha256', $this->salt . $password);

        $query = "INSERT INTO " . $this->table_name . " (username, role, password, salt) VALUES (:username, :role, :password, :salt)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':salt', $this->salt);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function login($username, $password) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row && hash('sha256', $row['salt'] . $password) === $row['password']) {
            $this->id = $row['id'];
            $this->role = $row['role'];
            return true;
        }
        return false;
    }

    public function isManager() {
        return $this->role === 'manager';
    }

    public function isEmployee() {
        return $this->role === 'employee';
    }
}

