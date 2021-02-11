<?php

require_once 'public/src/controllers/DefaultController.php';
require_once 'public/src/controllers/SecurityController.php';
require_once 'public/src/controllers/TripController.php';
require_once 'public/src/controllers/NotificationController.php';

class Router
{

    public static $routes;

    public static function get($url, $view)
    {
        self::$routes[$url] = $view;
    }

    public static function post($url, $view)
    {
        self::$routes[$url] = $view;
    }

    public static function run($url)
    {
        $urlParts = explode("/", $url);
        $action = $urlParts[0];

        if (!array_key_exists($action, self::$routes)) {
            die("Wrong url!");
        }

        $controller = self::$routes[$action];
        $object = new $controller;
        $action = $action ?: 'index';

        $id = $urlParts[1] ?? '';

        $object->$action($id);
    }
}