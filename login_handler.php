<?php

function login_username_validation($conn, $username)
{
    include("database.php");
    $sql = "SELECT username FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);

    $stmt->execute();
    $stmt->bind_result($username_from_db);

    if ($stmt->fetch()) {
        $stmt->close();
        return true;
    } else {
        $stmt->close();
        return false;
    }
}


function login_password_validation($conn, $username, $password)
{
    include("database.php");

    $sql = "SELECT password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);

    $stmt->execute();
    $stmt->bind_result($hashed_password_from_db);

    if ($stmt->fetch()) {
        if (password_verify($password, $hashed_password_from_db)) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }
}