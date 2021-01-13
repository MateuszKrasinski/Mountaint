<?php
require 'Routing.php';
$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);
Router::get('', 'DefaultController');
Router::get('friend', 'SecurityController');
Router::get('starter', 'DefaultController');
Router::get('trip', 'TripController');
Router::get('profile', 'SecurityController');
Router::get('addTrip', 'TripController');
Router::get('messages', 'DefaultController');
Router::get('notifications', 'DefaultController');
Router::post('login', 'SecurityController');
Router::post('newUser', 'SecurityController');
Router::post('setProfile', 'SecurityController');
Router::post('searchFriend', 'SecurityController');
Router::post('friendProfile', 'SecurityController');
Router::post('tripProfile', 'TripController');
Router::get('register', 'DefaultController');
Router::post('search', 'TripController');
Router::get('like', 'TripController');
Router::get('dislike', 'TripController');




Router::run($path);