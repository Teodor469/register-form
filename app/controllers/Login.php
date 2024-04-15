<?php

class Login
{
    private $model;
    private $view;

    public function __construct(LoginValidation $model, LoginView $view)
    {
        $this->model = $model;
        $this->view = $view;
    }

    public function login($email, $password, $username)
    {
        try {
            if ($this->model->loginUser($email, $password, $username)) {
                $this->view->showSuccess("Login successful!");
            } else {
                $this->view->showError("Login failed. Please check your credentials.");
            }
        } catch (Exception $e) {
            $this->view->showError("An error occurred: " . $e->getMessage());
        }
    }
}