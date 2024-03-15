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

    if (isset($_POST['login'])) {
        
    }


    ?>


    <form action="login.php", method="$_POST">
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