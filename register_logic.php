<?php
include('database.php');

function validate_field($field, $error_msg) 
{

    if (empty($_POST[$field])) {
        return $error_msg;
    }
    return null;
}


function validate_email($email)
{
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid E-mail!";
    }
    return null;
}


function user_exists($conn, $username, $email)
{
    $check_query = "SELECT COUNT(*) FROM users WHERE username = ? OR email = ?";
    $count = null;

    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        return "A user with this username or email exists.";
    }

    return false;

}


function add_user($conn, $username, $password, $email)
{
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $hashed_password, $email);

    $stmt->execute();

    if ($stmt->errno) {
        throw new Exception("Error adding user: " . $stmt->error);
    }

    $stmt->close();
}