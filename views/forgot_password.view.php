<?php

$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    $token = bin2hex(random_bytes(16));

    $token_hash = hash('sha256', $token);

    $expiry = date("Y-m-d H:i:s", time() + 60 * 30); // assign the date to $expiry

    require_once '../DAO/Database_connection.php';

    $dbConnection = new DatabaseConnection();
    $pdo = $dbConnection->getPdo();

    $sql = "UPDATE users SET reset_token_hash = ?, reset_token_expires_at = ? WHERE email = ?";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([$token_hash, $expiry, $email]); // bind the values to the statement
}

?>


<?php
require_once(__DIR__ . '/partitions/forgot_password.html');
?>