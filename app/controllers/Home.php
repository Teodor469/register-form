<?php
require './helper_functions.php';

class HomeController {
    public function index()
    {
        loadView('home');
    }
}