<?php
require_once('../DAO/Database_connection.php');

class DatabaseConnection
{
    private $pdo;

    public function __construct()
    {
        $config = [ // Of my understanding this part should not be here, but I couldn't make it work otherwise
            'host' => 'localhost',
            'port' => 3306,
            'dbname' => 'registration',
            'username' => 'root',
            'password' => '',
        ];

        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";

        try {
            $this->pdo = new PDO($dsn, $config['username'], $config['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("Connection Failed: " . $e->getMessage());
        }
    }

    public function getPdo()
    {
        return $this->pdo;
    }

    public function isConnected()
    {
        return $this->pdo !== null;
    }
}
