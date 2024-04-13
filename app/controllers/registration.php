<?php


require_once('C:\xampp\htdocs\login-page\DAO\Database_connection.php');
require_once('C:\xampp\htdocs\login-page\config\db.php');
require_once('C:\xampp\htdocs\login-page\app\models\Validation.model.php');
require_once('C:\xampp\htdocs\login-page\views\home.view.php');

// Instantiate DatabaseConnection class
$databaseConnection = new DatabaseConnection();

// Get the PDO instance
$pdo = $databaseConnection->getPdo();

// Check if the connection is successful
if ($pdo) {
    echo "Connected to the database successfully!";
} else {
    echo "Failed to connect to the database.";
}


class Register
{
    private $model;
    private $view;

    public function __construct(Validation $model, UserView $view)
    {
        $this->model = $model;
        $this->view = $view;
    }

    public function register($username, $email, $password)
    {
        try {
            $this->model->registerUser($username, $email, $password);
            $this->view->showSuccess("Registration successful!");
        } catch (Exception $e) {
            $this->view->showError($e->getMessage());
        }
    }
}

