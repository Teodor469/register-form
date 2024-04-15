<?php
require_once('C:\xampp\htdocs\login-page\DAO\Database_connection.php');
require_once('C:\xampp\htdocs\login-page\app\models\Validation.model.php');
require_once('C:\xampp\htdocs\login-page\app\controllers\Registration.php');

class RegisterView
{
    public function showSuccess($message)
    {
        echo "<p style='color: green;'>$message</p>";
    }

    public function showError($message)
    {
        echo "<p style='color: red;'>$message</p>";
    }
}

$db = new DatabaseConnection();
$model = new Validation($db);
$view = new RegisterView();
$controller = new Register($model, $view);

if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
}

$controller->register($username, $email, $password);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>

    <body class="bg-gray-100">
        <div class="container mx-auto mt-8">
            <h2 class="text-2xl font-bold text-center mb-4">Register</h2>
            <form action="#" method="post" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-semibold mb-2">Username</label>
                    <input type="text" method="post" id="name" name="username" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-semibold mb-2">Email</label>
                    <input type="email" method="post" id="email" name="email" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-semibold mb-2">Password</label>
                    <input type="password" method="post" id="password" name="password" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500">
                </div>

                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Submit</button>
            </form>
        </div>
    </body>

</html>
</body>

</html>