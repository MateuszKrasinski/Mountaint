<?php


class NotificationController extends AppController
{
    private UserRepository $userRepository;
    private logsRepository $logsRepository;
    private NotificationRepository $notificationRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->logsRepository = new logsRepository();
        $this->notificationRepository = new NotificationRepository();
    }

    public function getNotifications()
    {
        $this->render('notifications', ['notifications' => $this->notificationRepository->getNotifications()]);
    }

    public function newNotification($notificationTo, $content)
    {

    }
}