<?php
require_once('C:\xampp\htdocs\login-page\DAO\Database_connection.php');

class ForgotPsswd {
    private $model;
    private $view;

    public function __construct(ForgotPassword $model, $view)
    {
        $this->model = $model;
        $this->view = $view;
    }


}