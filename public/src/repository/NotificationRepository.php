<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Notification.php';
class NotificationRepository extends Repository
{
    private $userRepository ;
    private $tripRepository ;
    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->tripRepository = new TripRepository();
    }

    public function newNotification($notificationTo,
                                    $content)
    {
        $date = new DateTime();
        $stmt = $this->database->connect()->prepare('
            insert into notifications (notification_from, notification_to, notification_type) values (?,?,?)
        ');
        $stmt->execute([
            $_SESSION['idUser'],
            $notificationTo,
            $content,
        ]);
    }
    public function getNotifications(){
        $stmt = $this->database->connect()->prepare('
            select notification_from, notification_to, notification_type from notifications
            where notification_to = :id_to
                  
            order by time
 
        ');
        $result = [];
        $stmt->bindParam(':id_to', $_SESSION['idUser'], PDO::PARAM_INT);
        $stmt->execute();
        $notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($notifications as $ntf) {
            if(strpos( $ntf['notification_type'],'/')){
                $notif = explode('/',$ntf['notification_type']);
                $trip = $this->tripRepository->getTrip(intval($notif[1]));
                array_push($result, new Notification($this->userRepository->getUserById($ntf['notification_from']), $this->userRepository->getUserById($ntf['notification_to']), $notif[0],$trip));

            }else
            array_push($result, new Notification($this->userRepository->getUserById($ntf['notification_from']), $this->userRepository->getUserById($ntf['notification_to']), $ntf['notification_type']));
        }
        return $result;
    }
}