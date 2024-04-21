<?php
require_once('C:\xampp\htdocs\login-page\DAO\Database_connection.php');
require_once('C:\xampp\htdocs\login-page\app\models\LoginValidation.model.php');
require_once('C:\xampp\htdocs\login-page\app\controllers\Login.php');

class LoginView
{
    public function showSuccess($message)
    {
        echo "<p style='color: green;'>$message</p>";
        header("Location: home.view.php");
        exit();
    }

    public function showError($message)
    {
        echo "<p style='color: red;'>$message</p>";
    }

    public function forgotPassword()
    {
        header("Location: forgot_password.view.php");
        exit();
    }
}
$db = new DatabaseConnection();
$model = new LoginValidation($db);
$view = new LoginView();
$controller = new Login($model, $view);

if ($_SERVER["REQUEST_METHOD"] == "POST") { // This avoids the extra need for a hidden input field NOTE may change it later.
    $email = $_POST["email"];
    $password = $_POST["password"];

    $controller->login($email, $password);
}


if (isset($_GET['action']) && $_GET['action'] === 'forgot') {
    $view->forgotPassword();
    // No need for further code execution after redirection
    exit();
}
?>
<!-- // NOTE: Must seperate the php and the html files for more seemsless look
// Also must create a seperate partition file to hold the repeatable logic used in the project -->



<?php
    require_once(__DIR__ . '/partitions/login.html');
?>