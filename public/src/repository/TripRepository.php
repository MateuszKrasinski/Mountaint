<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Trip.php';

class TripRepository extends Repository
{


    public function getTrip(int $id): ?Trip
    {
        $stmt = $this->database->connect()->prepare('
            SELECT  * FROM public.trips WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $trip = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($trip == false) {
            return null;
        }

        return new Trip(
            $trip["id_assigned_by"],
            $trip['title'],
            $trip['description'],
            $trip['image'],
            $trip['date_start'],
            $trip['time_start'],
            $trip['date_finish'],
            $trip['time_finish'],
            $trip['places'],
            $this->getTripParticipants($id),
            $trip['id'],
        );
    }


    public function getLikes(int $id)
    {
        $userRepository = new UserRepository();
        $stmt = $this->database->connect()->prepare('
            select id_user
            from users_trips
            where id_trip = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $participantsID = ($stmt->fetchAll(PDO::FETCH_ASSOC));
        $participants = [];
        foreach ($participantsID as $participantID) {
            $participants[] = $userRepository->getUserById($participantID['id_user']);

        }
        return $participants;
    }

    public function addTrip(Trip $trip): void
    {
        $date = new DateTime();
        $stmt = $this->database->connect()->prepare('
            INSERT INTO trips (title, description, image, created_at, id_assigned_by,  date_start,time_start,
                               date_finish, time_finish, places,participants)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)
        ');

        $assignedById = $_SESSION['idUser'];

        $stmt->execute([
            $trip->getTitle(),
            $trip->getDescription(),
            $trip->getImage(),
            $date->format('Y-m-d'),
            $assignedById,
            $trip->getDateStart(),
            $trip->getTimeStart(),
            $trip->getDateFinish(),
            $trip->getTimeFinish(),
            $trip->getPlaces(),
            $trip->getParticipants(),
        ]);
    }

    public function getTrips(): array
    {
        $result = [];
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM trips
        ');
        $stmt->execute();
        $trips = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($trips as $trip) {
            $result[] = new Trip(
                $trip["id_assigned_by"],
                $trip['title'],
                $trip['description'],
                $trip['image'],
                $trip['date_start'],
                $trip['time_start'],
                $trip['date_finish'],
                $trip['time_finish'],
                $trip['places'],
                $trip['participants'],
                $trip['id'],
            );
        }

        return $result;
    }

    public function getTripParticipants($tripId): array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT id_user FROM users_trips where id_trip = :id_trip
        ');
        $stmt->bindParam(':id_trip', $tripId, PDO::PARAM_INT);
        $stmt->execute();
        $participants = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $participants;
    }

    public function getOtherTrips()
    {
        $stmt = $this->database->connect()->prepare('
            select *
            from trips
            where id in (select id_trip as entity
             from users_trips
                      left join trips t on t.id = users_trips.id_trip
             where   id_trip not in (select id_trip
                                   from users_trips
                                   where id_user = :id_user)
             GROUP BY id_trip)
        ');
        $stmt->bindParam(':id_user', $_SESSION['idUser'], PDO::PARAM_INT);
        $stmt->execute();
        $trips = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $trips;
    }

    public function getJoinedTrips()
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users_trips
            inner join trips t on t.id = users_trips.id_trip
            where id_user = :id_user AND owner = false
        ');
        $stmt->bindParam(':id_user', $_SESSION['idUser'], PDO::PARAM_INT);
        $stmt->execute();
        $trips = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $trips;
    }

    public function getTripId(Trip $trip): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.trips WHERE title = :title AND description = :description
        ');
        $stmt->bindParam(':title', $trip->getTitle(), PDO::PARAM_STR);
        $stmt->bindParam(':description', $trip->getDescription(), PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['id'];
    }

    public function getProjectByTitle(string $searchString): array
    {
        $searchString = '%' . strtolower($searchString) . '%';
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM trips  WHERE LOWER(title) LIKE :search OR LOWER(description) LIKE :search
        ');
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();
        $trips = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $trips;
    }


    public function newParticipant(int $id, $iSOwner = "false")
    {
        $stmt2 = $this->database->connect()->prepare('
                INSERT INTO  users_trips (id_user, id_trip, owner)
                 VALUES (?,?,?)');
        $stmt2->execute([$_SESSION['idUser'], $id, $iSOwner]);
        $stmt3 = $stmt = $this->database->connect()->prepare('
                update trips set  participants =  participants + 1
                where id = :id

        ');
        $stmt3->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt3->execute();

    }
    public function removeParticipant(int $id, $iSOwner = "false")
    {
        $stmt2 = $this->database->connect()->prepare('
                delete  from users_trips 
                    where id_trip = :id_trip AND id_user=:id_user ');
        $stmt2->bindParam(':id_trip',$id,PDO::PARAM_INT);
        $stmt2->bindParam(':id_user',$_SESSION['idUser'],PDO::PARAM_INT);
        $stmt2->execute();
        $stmt3 = $stmt = $this->database->connect()->prepare('
                update trips set  participants =  participants - 1
                where id = :id

        ');
        $stmt3->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt3->execute();

    }
    public function myTrips(): array
    {
        $stmt = $this->database->connect()->prepare('
            select * from users_trips
            left join trips t on t.id = users_trips.id_trip
            where id_user = :id_user and owner = true
        ');
        $stmt->bindParam(':id_user', $_SESSION['idUser'], PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);;
    }

    public function joinedTripsId(): array{
        $stmt = $this->database->connect()->prepare('
            SELECT id_trip FROM users_trips
            inner join trips t on t.id = users_trips.id_trip
            where id_user = :id_user AND owner = false
        ');
        $stmt->bindParam(':id_user', $_SESSION['idUser'], PDO::PARAM_INT);
        $stmt->execute();
        $trips = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $trips;
    }
    public function myTripsId(){
        $stmt = $this->database->connect()->prepare('
            select id_trip from users_trips
            left join trips t on t.id = users_trips.id_trip
            where id_user = :id_user and owner = true
        ');
        $stmt->bindParam(':id_user', $_SESSION['idUser'], PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);;
    }
    public function allTrips()
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM trips 
        ');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



}