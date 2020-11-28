<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/Project.php';

class TripController extends AppController
{

    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg', 'image/jpg'];
    const UPLOAD_DIRECTORY = '/../img/uploads/';

    private $message = [];

    public function addTrip()
    {
        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__) . self::UPLOAD_DIRECTORY . $_FILES['file']['name']
            );

            // TODO create new project object and save it in database
            $project = new Project($_POST['title'], $_POST['description'], $_FILES['file']['name'], $_POST['date_start'], $_POST['date_finish']);

            return $this->render('trip', ['messages' => $this->message, 'project' => $project]);
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
