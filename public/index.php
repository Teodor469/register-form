<?php

session_start();

require '../helper_functions.php';
require '../DAO/Router.php';

$router = new Router();

$routes = require basePath('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);