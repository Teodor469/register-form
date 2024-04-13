<?php
require_once('C:\xampp\htdocs\login-page\DAO\Database_connection.php');
require_once('C:\xampp\htdocs\login-page\config\db.php');


class Validation 
{
    private $db;

    public function __construct(DatabaseConnection $db)
    {
        $this->db = $db->getPdo();
    }

    public function userExists($username, $email)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
        $stmt->execute([':username' => $username, ':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user !== false;
    }

    public function registerUser($username, $email, $password)
    {
        if ($this->userExists($username, $email)) {
            throw new Exception("User with the same username or email already exists.");
        }

        // Continue with the registration process (hashing password, storing user data, etc.)
    }
}