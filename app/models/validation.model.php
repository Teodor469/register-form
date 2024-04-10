<?php


class Validation 
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;   
    }

    public function checkUserExists($username, $email)
    {
        $sql = "SELECT COUNT(*) FROM users WHERE username = :username OR email = :email";
        $params = [':username' => $username, ':email' => $email];
        $stmt = $this->db->query($sql, $params);
        $count = $stmt->fetchColumn();

        return $count > 0;
    }
}