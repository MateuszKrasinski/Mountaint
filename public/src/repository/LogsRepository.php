<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Logs.php';
class LogsRepository extends Repository
{
    public function addLogs(Logs $log): void
    {
        $date = new DateTime();
        $stmt = $this->database->connect()->prepare('
            INSERT INTO logs(name ,surname, browser, date, host, device,time)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ');
        $stmt->execute([
            $log->getName(),
            $log->getSurname(),
            $log->getBrowser(),
            $date->format('Y-m-d'),
            $log->getHost(),
            $log->getDevice(),
            $date->format('H:i:s'),

        ]);

    }
}