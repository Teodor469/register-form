<?php

require_once('../login-page/DAO/Database_connection.php');

// Instantiate DatabaseConnection class
$databaseConnection = new DatabaseConnection($config);

// Get the PDO instance
$pdo = $databaseConnection->getPdo();

// Check if the connection is successful
if ($pdo) {
    echo "Connected to the database successfully!";
} else {
    echo "Failed to connect to the database.";
}


class User 
{
    private $username;
    private $email;
    private $password;


    /**
     * Checks if form fields are empty
     * 
     * @param string $username
     * @param string $email
     * @param string $password
     * 
     * @return void
     */


    public function __construct($username, $email, $password)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    public function getUsername() 
    {
        return $this->username;
    }

    public function setUsername($value) 
    {
        if (trim($value) === "") {
            throw new Exception("Username field cannot be empty!");
        }

        $this->username = $value;
    }


    public function getEmail() 
    {
        return $this->email;
    }

    public function setEmail($value) 
    {
        if (trim($value) === "") {
            throw new Exception("E-mail field cannot be empty!");
        }

        $this->email = $value;
    }


    public function getPassword() 
    {
        return $this->password;
    }

    public function setPassword($value) 
    {
        if (trim($value) === "") {
            throw new Exception("Password field cannot be empty!");
        }

        $this->password = $value;
    }
}