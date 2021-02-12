<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/Trip.php';
require_once __DIR__ . '/../repository/TripRepository.php';

class TripController extends AppController
{

    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../img/uploads/';

    private $message = [];
    private $tripRepository;
    private $notificationRepository;

    public function joinTrip($isProfileView = false)
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);
            if ($decoded['option'] == "join") {
                $this->tripRepository->newParticipant($decoded['id_trip']);
                $this->notificationRepository->newNotification($this->tripRepository->getTripOwner($decoded['id_trip']), "joined your trip"."/".$decoded['id_trip']);

            } elseif ($decoded['option'] == "leave")
                $this->tripRepository->removeParticipant($decoded['id_trip'], false);
            elseif ($decoded['option'] == "remove")
                $this->tripRepository->removeParticipant($decoded['id_trip'], true);
        }
        if ($isProfileView) $this->trip();
    }


    public function joinTripFromProfile()
    {
        http_response_code(200);
        $this->tripRepository->newParticipant($_POST['id']);
        $trips = $this->tripRepository->getTrips();

        $this->render('trip', ['trips' => $trips]);
    }

    public function tripProfile()

    {
        $id = intval($_GET['profile']);
        $trip = $this->tripRepository->getTrip(($id));
        $participantsId = $this->tripRepository->getTripParticipants($id);
        $participants = [];
        $userRepository = new UserRepository();
        foreach ($participantsId as $participantId) {
            $participants[] = $userRepository->getUserById($participantId['id_user']);
        }
        $this->render('trip_profile', ['trip' => $trip, 'participants' => $participants]);


    }

    public function filterTrips($filter)
    {
        http_response_code(200);
        $joinedTrips = $this->tripRepository->getTripsId("joinedTrips");
        $myTrips = $this->tripRepository->getTripsId("myTrips");
        echo json_encode(['trips' => $this->tripRepository->filter($filter), 'joined' => $joinedTrips, 'myTrips' => $myTrips]);
    }

    public function __construct()
    {
        parent::__construct();
        $this->tripRepository = new TripRepository();
        $this->notificationRepository = new NotificationRepository();
    }

    public function trip()

    {
        $trips = $this->tripRepository->getTrips();
        $joinedTrips = $this->tripRepository->getTripsId("joinedTrips");
        $myTrips = $this->tripRepository->getTripsId("myTrips");
        $this->render('trip', ['trips' => $trips, 'joined' => $joinedTrips, 'myTrips' => $myTrips]);
    }

    public function addTrip()
    {
        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__) . self::UPLOAD_DIRECTORY . $_FILES['file']['name']
            );

            $trip = new Trip($_SESSION['userID'], $_POST['title'], $_POST['description'], $_FILES['file']['name'], $_POST['date_start'],
                $_POST['time_start'], $_POST['date_finish'], $_POST['time_finish'], $_POST['places']);
            $this->tripRepository->addTrip($trip);
            $id = $this->tripRepository->getTripId($trip);
            $this->tripRepository->newParticipant($id, "true");
            $joinedTrips = $this->tripRepository->getTripsId("joinedTrips");
            $myTrips = $this->tripRepository->getTripsId("myTrips");
            return $this->render('trip', [
                'trips' => $this->tripRepository->getTrips(), 'joined' => $joinedTrips, 'myTrips' => $myTrips,
                'messages' => $this->message]);
        }
        return $this->render('add_project', ['messages' => $this->message]);
    }

    public function search()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);
            $joinedTrips = $this->tripRepository->getTripsId("joinedTrips");
            $myTrips = $this->tripRepository->getTripsId("myTrips");
            $trips = $this->tripRepository->getProjectByTitle($decoded['search']);
            echo json_encode(['trips' => $trips, 'joined' => $joinedTrips, 'myTrips' => $myTrips]);
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


