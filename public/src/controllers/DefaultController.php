<?php
require_once 'AppController.php';
require_once __DIR__ . '/../models/Trip.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class DefaultController extends AppController
{
    public function index()
    {
        $this->render('starter', ['message']);
    }

    public function friend()
    {
        $this->render('friend');
    }

    public function starter()
    {
        $this->render('starter');
    }
    public function register()
    {
        $this->render('register');
    }

    public function add_project()
    {
        $this->render('add_project');
    }

    public function messages()
    {
        $this->render('messages');
    }

    public function notifications()
    {
        $this->render('notifications');
    }

    public function profile()
    {
        $this->render('profile');
    }
}
