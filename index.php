<?php
require 'Routing.php';
$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);
Router::get('', 'DefaultController');
Router::get('friend', 'SecurityController');
Router::get('starter', 'DefaultController');
Router::get('trip', 'TripController');
Router::get('profile', 'DefaultController');
Router::get('addTrip', 'TripController');
Router::get('messages', 'DefaultController');
Router::get('notifications', 'DefaultController');
Router::post('login', 'SecurityController');
Router::post('newUser', 'SecurityController');
Router::get('register', 'DefaultController');



Router::run($path);