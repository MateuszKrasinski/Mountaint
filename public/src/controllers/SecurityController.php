<?php
session_start();

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class SecurityController extends AppController
{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../img/uploads/';
    private $message = [];
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }
    public function searchFriend(){
        $users = $this->userRepository->getUsersByName($_POST['name']);

        $this->render('friend', ['users' => $users]);
    }

    public function profile()

    {
        $user = $this->userRepository->getUser($_SESSION['email']);

        $this->render('profile', ['user' => $user]);
    }
    public function friendProfile()

    {
        $user = $this->userRepository->getUser($_GET['email']);
        $this->render('friend_profile', ['user' => $user]);

    }
    public function friend()

    {
        $users = $this->userRepository->getUsers();

        $this->render('friend', ['users' => $users]);

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
        $_SESSION['email'] = $email;
        $_SESSION['idUser'] = $userRepository->getUserId($user);
        $_SESSION['idProfileDetails'] = $userRepository->getUserProfileDetailsId($user);
        $_SESSION['idUserDetails'] = $userRepository->getUserDetailsId($user);
        $_SESSION['user'] = $user;

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/profile");
    }

    public function newUser(): void
    {
        $user = new User($_POST['email'], $_POST['password'], $_POST['name'], $_POST['surname'], $_POST['phone']);
        $this->userRepository->addUser($user);
        $this->render('login');
    }

    public function setProfile()
    {


        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__) . self::UPLOAD_DIRECTORY . $_FILES['file']['name']
            );

            $user = $this->userRepository->getUser($_SESSION['email']);
            $idProfileDetails = $this->userRepository->getUserProfileDetailsId($user);
            $this->userRepository->setProfile($idProfileDetails,$user);
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/friend");
        }
        else{
            $user = $this->userRepository->getUser($_SESSION['email']);
            $idProfileDetails = $this->userRepository->getUserProfileDetailsId($user);
            $this->userRepository->setProfile($idProfileDetails, $user);
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/friend");
        }

    }

    private function validate(array $file): bool
    {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->message[] = 'File is too large for destination file system.';
            return false;
        }

        if (!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->message[] = 'File type is not supported.';
            return false;
        }
        return true;
    }
}