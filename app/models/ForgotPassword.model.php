<?php

class ForgotPassword
{
    private $db;

    public function __construct(DatabaseConnection $db)
    {
        $this->db = $db->getPdo();
    }

    /**
     * Check if email exists
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
     * This method is going to create a unique token for the user to prompt them to change the password
     * 
     * @param string $email
     */
    public function createToken($email)
    {
        if ($this->emailExists($email)) {
            $token = bin2hex(random_bytes(16));

            $token_hash = hash('sha256', $token);

            $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

            $stmt = $this->db->prepare("UPDATE users SET reset_token_hash = :token_hash, reset_token_expires_at = :expiry WHERE email = :email");

            $stmt->bindParam(':token_hash', $token_hash);
            $stmt->bindParam(':expiry', $expiry);
            $stmt->bindParam(':email', $email);

            $stmt->execute();
        }
    }
}
