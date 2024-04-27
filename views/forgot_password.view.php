<?php

class ForgotPasswdView {
    
}

$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
}

?>


<?php
require_once(__DIR__ . '/partitions/forgot_password.html');
?>