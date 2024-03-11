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


    $username = "";
    $password = "";
    $repeat_password = "";
    $email = "";


    if ($_SERVER['REQUEST_METHOD'] === 'POST') { //_SERVER: Still not understandable
        if(isset($_POST["register"])){ //isset checks if the input box has something in it
            $username = $_POST['username']; // assigning the value submitted through the html
            $password = $_POST['password']; // assigning the value submitted through the html
            $repeat_password = $_POST['repeat_password'];
            $email = $_POST['email'];

            $errors = [];

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
                $errors['email'] = "Invalid E-mail format!";
            }
            
        } else {
            echo "Form not submitted correctly.";
        }
    } else {
        echo "Form not submitted";
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
    if (empty($errors)) { // This part is written with chatgpt and I don't understand it fully
        // Hash the password before storing it in the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if the combination of username, email, and password already exists
        $check_query = "SELECT COUNT(*) FROM users WHERE username = ? OR email = ? OR password = ?";
        $check_stmt = mysqli_prepare($conn, $check_query);
        mysqli_stmt_bind_param($check_stmt, "sss", $username, $email, $password);
        mysqli_stmt_execute($check_stmt);
        mysqli_stmt_bind_result($check_stmt, $count);
        mysqli_stmt_fetch($check_stmt);
        mysqli_stmt_close($check_stmt); // until here

        if ($count > 0) {
            echo "That username or email is already taken.";
        } else {
            // Prepare and execute the SQL query to insert user data into the database
            $insert_query = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
            $insert_stmt = mysqli_prepare($conn, $insert_query);
            mysqli_stmt_bind_param($insert_stmt, "sss", $username, $hashed_password, $email);

            if (mysqli_stmt_execute($insert_stmt)) {
                echo "Registration successful!";
            } else {
                echo "Error: " . mysqli_error($conn);
            }

            mysqli_stmt_close($insert_stmt);
        }
    }
    ?>
    </form>
    
</body>
</html>