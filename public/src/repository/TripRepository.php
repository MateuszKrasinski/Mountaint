<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Trip.php';

class TripRepository extends Repository
{

    public function getTrip(int $id): ?Trip
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.trips WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $trip = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($trip == false) {
            return null;
        }

        return new Trip(
            $trip['title'],
            $trip['description'],
            $trip['image']
        );
    }

    public function addTrip(Trip $trip): void
    {
        $date = new DateTime();
        $stmt = $this->database->connect()->prepare('
            INSERT INTO trips (title, description, image, created_at, id_assigned_by)
            VALUES (?, ?, ?, ?, ?)
        ');

        //TODO you should get this value from logged user session
        $assignedById = 1;

        $stmt->execute([
            $trip->getTitle(),
            $trip->getDescription(),
            $trip->getImage(),
            $date->format('Y-m-d'),
            $assignedById
        ]);
    }

    public function getTrips(): array{
        $result = [];
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM trips
        ');
        $stmt->execute();
        $trips = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($trips as $trip){
            $result[] = new Trip(
                $trip['title'],
                $trip['description'],
                $trip['image']
            );
        }

        return $result;
    }
}