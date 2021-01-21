<?php
require 'Routing.php';
$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);
Router::get('', 'DefaultController');
Router::get('friend', 'SecurityController');
Router::get('starter', 'DefaultController');
Router::get('trip', 'TripController');
Router::get('profile', 'SecurityController');
Router::get('logout', 'SecurityController');
Router::get('addTrip', 'TripController');
Router::get('messages', 'DefaultController');
Router::get('notifications', 'DefaultController');
Router::post('login', 'SecurityController');
Router::post('newUser', 'SecurityController');
Router::post('setProfile', 'SecurityController');
Router::post('searchFriend', 'SecurityController');
Router::post('friendProfile', 'SecurityController');
Router::post('tripProfile', 'TripController');
Router::post('joinTrip', 'TripController');
Router::post('joinTripFromProfile', 'TripController');
Router::get('register', 'DefaultController');
Router::post('search', 'TripController');
Router::get('like', 'TripController');
Router::get('dislike', 'TripController');
Router::get('likeFriend', 'SecurityController');
Router::get('dislikeFriend', 'SecurityController');
Router::get('follow', 'SecurityController');
Router::get('follow2', 'SecurityController');
Router::get('myFriends', 'SecurityController');
Router::get('myTrips', 'TripController');
Router::get('allTrips', 'TripController');
Router::get('joinedTrips', 'TripController');
Router::get('otherTrips', 'TripController');
Router::get('followed', 'SecurityController');
Router::get('notFollowed', 'SecurityController');
Router::get('allFriends', 'SecurityController');




Router::run($path);