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
