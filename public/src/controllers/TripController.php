<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/Trip.php';
require_once __DIR__.'/../repository/TripRepository.php';

class TripController extends AppController {

    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../img/uploads/';

    private $message = [];
    private $tripRepository;

    public function __construct()
    {
        parent::__construct();
        $this->tripRepository = new TripRepository();
    }
    public function trip()

    {
        $trips = $this->tripRepository->getTrips();

        $this->render('trip', ['trips' => $trips]);
    }
    public function addTrip()
    {
        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            // TODO create new trip object and save it in database
            $trip = new Trip($_POST['title'], $_POST['description'], $_FILES['file']['name']);
            $this->tripRepository->addTrip($trip);

            return $this->render('trip', [
                'trips' => $this->tripRepository->getTrips(),
                'messages' => $this->message]);
        }
        return $this->render('add_project', ['messages' => $this->message]);
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
