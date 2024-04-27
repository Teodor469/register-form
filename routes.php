<?php
$router->get('/login-page/public/index.php', 'HomeController@index');

$router->post('/login-page/public/index.php/views/register', 'Registration@register');