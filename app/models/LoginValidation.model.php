<?php

class LoginValidation
{
    private $db;

    public function __construct(DatabaseConnection $db)
    {
        $this->db = $db->getPdo();
    }

    /**
     * This method is going to validate if the provided email matches the email fetched from the db
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
     * This method is going to validated if the provided psswd matches the psswd fetched from the db
     * 
     * @param string $psswd
     * @param string $username
     */
    public function psswdExists($password, $username)
    {
        $stmt = $this->db->prepare("SELECT password FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);
        $hash = $stmt->fetch(PDO::FETCH_ASSOC)['password'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        return password_verify($hashed_password, $hash);
    }


    public function loginUser($email, $password, $username)
    {
        if ($this->emailExists($email) and $this->psswdExists($password, $username)) {
            return true;
        } else {
            return false;
        }
    }
}
