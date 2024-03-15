<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="mystyle.css">
</head>
<body>
<?php

    include("database.php");
    include("functions.php");


    $username = "";
    $password = "";
    $repeat_password = "";
    $email = "";

        if(isset($_POST["register"])){
        //isset checks if the input box has something in it
            $username = $_POST['username']; // assigning the value submitted through the html
            $password = $_POST['password']; // assigning the value submitted through the html
            $repeat_password = $_POST['repeat_password'];
            $email = $_POST['email'];

            $errors = [];

            // $errors['username'] = validate_field('username', "You must enter a username!");
            // $errors['password'] = validate_field('password', "You must enter a password!");
            // $errors['repeat_password'] = validate_field('repeat_password', "You must repeat you password!");


            // if(empty($errors['repeat_password']) && $repeat_password != $password) {
            //     $errors['repeat_password'] = "The password does not match!";
            // }

            // $errors['email'] = validate_email($email);

            if (empty($username)){
                $errors['username'] = "You must enter an username!";
            } 
            
            if (empty($password)){
                $errors['password'] = "You must enter a password!";
            }
            
            if (empty($repeat_password)) {
                $errors['repeat_password'] = "You must repeat your password!";
            } elseif ($repeat_password != $password) {
                $errors['repeat_password'] = "The password does not match!";
            }

            if (empty($email)) {
                $errors['email'] = "You must enter an E-mail!";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //checks if the email stored in the variable is not valid
                $errors['email'] = "Invalid E-mail format!"; // This is going to be seperate from the function
            }
            
        } else {
            echo "Form not submitted correctly.";
        }

?>
    <form method="POST" action="index.php">
        <input type="submit" name="register" value="Sign up"><br>


        <label for="username">username: </label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>"> <br>
        <?php if (isset($errors['username'])) {
        echo '<span style="color: red;">' . $errors['username'] . '</span>' . '<br>';
        } ?>

    <br>
        
        <label for="email">E-mail: </label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>"> <br>
        <?php if (isset($errors['email'])) {
            echo '<span style="color: red;">' . $errors['email'] . '</span>' . '<br>';
        } ?>

    <br>

        <label for="password">password: </label>
        <input type="password" name="password"><br>
        <?php if (isset($errors['password'])) {
        echo '<span style="color: red;">' . $errors['password'] . '</span>';
        } ?>

    <br>

        <label for="repeat_password">repeat password: </label>
        <input type="password" name="repeat_password"><br>
        <?php if (isset($errors['repeat_password'])) {
        echo '<span style="color: red;">' . $errors['repeat_password'] . '</span>';
        } ?>

    <br>


    <?php 
    if (empty($errors)) {
        try {
            if (user_exists($conn, $username, $email)) {
                throw new Exception("A user with this username or email already exists.");
            }
            
            add_user($conn, $username, $password, $email);
            echo "Registration successful!";
            header("Location: login.php");
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    ?>
    </form>
    
</body>
</html>