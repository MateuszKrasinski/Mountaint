<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Trip.php';

class TripRepository extends Repository
{
    public static function getTripById(int $id): ?Trip
    {
        $stmt = Database::getInstance() ->connect()->prepare('
            SELECT * FROM public.trips WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();

        $trip = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($trip == false) {
            return null;
        }

        return new Trip(
            $trip['title'],
            $trip['description'],
            $trip['date_finish'],
            $trip['date_start'],
        );
    }
}