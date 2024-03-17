<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include("database.php");
    include("login_handler.php");

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $errors = [];

        if(empty($username)) {
            $errors[] = "You must enter a username!";
        } elseif(empty($password)) {
            $errors[] = "Can't login without a password!";
        }

        if(!empty($username) && !empty($password)) {
            $username_validation = login_username_validation($conn, $username);
            $password_validation = login_password_validation($conn, $username, $password);

            if ($username_validation && $password_validation) {
                header("Location: welcome.php");
            } else {
                $errors[] = 'Username or password is incorrect';
            }
        }

}

    if (!empty($errors)) {
        foreach ($errors as $error) {
          echo $error . "<br>";
        }
      }

    ?>


    <form action="login.php", method="POST">
        <label for="username">Username: </label>
        <input type="text" name="username">

        <br>

        <label for="password">Password: </label>
        <input type="password" name="password">

        <br>

        <input type="submit" name="login">
    </form>
</body>
</html>