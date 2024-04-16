<?php
require_once('C:\xampp\htdocs\login-page\DAO\Database_connection.php');

class Login
{
    private $model;
    private $view;

    public function __construct(LoginValidation $model, LoginView $view)
    {
        $this->model = $model;
        $this->view = $view;
    }

    public function login($email, $password)
    {
        try {
            if ($this->model->loginUser($email, $password)) {
                $this->view->showSuccess("Login successful!");
            } else {
                $this->view->showError("Login failed. Please check your credentials.");
            }
        } catch (Exception $e) {
            $this->view->showError("An error occurred: " . $e->getMessage());
        }
    }
}