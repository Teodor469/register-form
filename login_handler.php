<?php

function login_validation($conn, $username, $password)
{
    $sql = "SELECT username, password FROM users WHERE username = ? AND password = ?";

    $fetched_username = "";
    $fetched_password = "";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->bind_result($fetched_username, $fetched_password);
    $stmt->fetch();
    $stmt->close();


    try{
        if(!empty($fetched_username) && password_verify($password, $fetched_password)) {
            session_start();

            $_SESSION["username"] = $fetched_username;
            exit();
            } 
    } catch (Exception $e) {
        $errors[] = "Error: " . $e->getMessage();
    }
}