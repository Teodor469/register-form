<?php

class Register
{
    private $model;
    private $view;

    public function __construct(Validation $model, RegisterView $view)
    {
        $this->model = $model;
        $this->view = $view;
    }

    public function register($username, $email, $password)
    {
        try {
            $this->model->registerUser($username, $email, $password);
            $this->view->showSuccess("Registration successful!");
            header("Location: ../views/login.view.php");
        } catch (Exception $e) {
            $this->view->showError($e->getMessage());
        }
    }
}

