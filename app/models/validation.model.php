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
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Prepare the SQL statement to insert a new user into the 'users' table
        $stmt = $this->db->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");

        // Bind parameters to the prepared statement
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':email', $email);
        
        // Execute the prepared statement
        $stmt->execute();

        // Check for errors during execution
        if ($stmt->errorCode() !== '00000') {
            $errorInfo = $stmt->errorInfo();
            throw new Exception("Error adding user: " . $errorInfo[2]);
        }

        // Close the prepared statement
        $stmt->closeCursor();
        }

        // Continue with the registration process (hashing password, storing user data, etc.)
    }
}
