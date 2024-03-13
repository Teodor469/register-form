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

