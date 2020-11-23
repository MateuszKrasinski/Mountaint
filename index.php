<?php
 require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);
Router::get('', 'DefaultController');
Router::get('friend', 'DefaultController');
Router::get('starter', 'DefaultController');
Router::get('trip', 'DefaultController');
Router::post('login', 'SecurityController');


Router::run($path);