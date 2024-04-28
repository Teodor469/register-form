<?php
$router->get('/login-page/public/', 'HomeController@index');

$router->post('/login-page/public/index.php/views/register', 'Registration@register');
$router->post('/login-page/public/index.php/views/login', 'Login@login');