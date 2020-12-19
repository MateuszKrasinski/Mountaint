<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController {

    private $message = [];
    private $userRepository;
    static $loggedUser;
    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }
    public function login()
    {
        $userRepository = new UserRepository();

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $userRepository->getUser($email);

        if (!$user) {
            return $this->render('login', ['messages' => ['User not found!']]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email not exist!']]);
        }

        if ($user->getPassword() !== $password) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }
        self::$loggedUser = $user;
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/trip");
    }
    public function newUser(): void
    {
            $user = new User($_POST['email'], $_POST['password'], $_POST['name'], $_POST['surname'], $_POST['phone']);
            $this->userRepository->addUser($user);
            $this->render('friend');
        }
}