<?php
require_once 'AppController.php';

class DefaultController extends AppController
{
    public function index()
    {
        $this->render('login', ['message']);
    }

    public function friend()
    {
        $this->render('friend');
    }

    public function starter()
    {
        $this->render('starter');
    }

    public function trip()
    {
        $this->render('trip');
    }

    public function addProject()
    {
        $this->render('add_project');
    }
}
