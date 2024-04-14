<?php

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

