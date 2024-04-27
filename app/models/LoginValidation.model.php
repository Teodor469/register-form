<?php

class LoginValidation
{
    private $db;

    public function __construct(DatabaseConnection $db)
    {
        $this->db = $db->getPdo();
    }

    /**
     * This method is going to check if the provided email exists
     * 
     * @param string $email
     */
    public function emailExists($email)
    {
        $stmt = $this->db->prepare("SELECT email FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $email = $stmt->fetch(PDO::FETCH_ASSOC);
        return $email !== false;
    }

    /**
     * This method is going to check if the password exists
     * 
     * @param string $psswd
     * @param string $username
     */
    public function psswdExists($password, $email)
    {
        $stmt = $this->db->prepare("SELECT password FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $hash = $stmt->fetch(PDO::FETCH_ASSOC)['password'];
        return password_verify($password, $hash);
    }


    public function loginUser($email, $password)
    {
        if ($this->emailExists($email) && $this->psswdExists($password, $email)) {
            return true;
        } else {
            return false;
        }
    }
}

// NOTE need better error handling for the login form