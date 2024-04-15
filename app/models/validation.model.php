<?php

class Validation
{
    private $db;

    public function __construct(DatabaseConnection $db)
    {
        $this->db = $db->getPdo();
    }

    public function usernameExists($username)
    {
        $stmt = $this->db->prepare("SELECT id FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user !== false;
    }
    public function emailExists($email)
    {
        $stmt = $this->db->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user !== false;
    }

    public function registerUser($username, $email, $password)
    {
        if ($this->usernameExists($username)) {
            throw new Exception("User with the same username already exists.");
        } elseif ($this->emailExists($email)) {
            throw new Exception("User with the same E-mail already exists");
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $this->db->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");

            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':email', $email);

            $stmt->execute();

            if (!$stmt->execute()) {
                $errorInfo = $stmt->errorInfo();
                throw new Exception("Error adding user: " . $errorInfo[2]);
            }

            $stmt->closeCursor();
        }
    }
}
