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
    include("login_handler.php");

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $errors = [];

        if(empty($username)) {
            $errors['username'] = "You must enter a username!";
        } elseif(empty($password)) {
            $errors['password'] = "Can't login without a password!";
        }

        if(!empty($username) && !empty($password)) {
            $username_validation = login_username_validation($conn, $username);
            $password_validation = login_password_validation($conn, $username, $password);

            if ($username_validation && $password_validation) {
                header("Location: welcome.php");
            } else {
                $errors['not_match'] = 'Username or password is incorrect';
            }
        }

}

    ?>


    <form action="login.php", method="POST">
        <label for="username">Username: </label>
        <input type="text" name="username">
        <?php if (isset($errors['username'])) {
        echo '<span style="color: red;">' . $errors['username'] . '</span>';
        } ?>

        <br>

        <label for="password">Password: </label>
        <input type="password" name="password">
        <?php if (isset($errors['password'])) {
        echo '<span style="color: red;">' . $errors['password'] . '</span>';
        } ?>

        <br>

        <?php if (isset($errors['not_match'])) {
        echo '<span style="color: red;">' . $errors['not_match'] . '</span>' . '<br>';
        } ?>

        <input type="submit" name="login">
    </form>
</body>
</html>