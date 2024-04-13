<?php


require_once('C:\xampp\htdocs\login-page\DAO\Database_connection.php');
require_once('C:\xampp\htdocs\login-page\config\db.php');

// Instantiate DatabaseConnection class
$databaseConnection = new DatabaseConnection();

// Get the PDO instance
$pdo = $databaseConnection->getPdo();

// Check if the connection is successful
if ($pdo) {
    echo "Connected to the database successfully!";
} else {
    echo "Failed to connect to the database.";
}

