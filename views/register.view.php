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

$username = "";
$email = "";
$password = "";

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

// NOTE: Must seperate the php and the html files for more seemsless look
// Also must create a seperate partition file to hold the repeatable logic used in the project
?>


<?php
require 'C:\xampp\htdocs\login-page\helper_functions.php';
require_once(__DIR__ . '/partitions/register.html');
// require basePath("xampp\htdocs\login-page\views\partitions\register.html");
$path = basePath("partitions/register.html");

if (file_exists($path)) {
    echo "File exists!";
} else {
    echo "File does not exist: " . $path;
}

if (is_readable($path)) {
    echo "File is readable!";
} else {
    echo "File is not readable: " . $path;
}
?>

<!-- FILE DOES NOT EXIST MUST FIX -->