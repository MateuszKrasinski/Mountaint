<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Trip.php';

class TripRepository extends Repository
{


    public function getTrip(int $id): ?Trip
    {
        $stmt = $this->database->connect()->prepare('
            SELECT array_to_json(participants) as part, array_to_json(likes) as like, array_to_json(dislikes) as dislike
                 , * FROM public.trips WHERE id = :id
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
            json_decode($trip['part']),
            json_decode($trip['like']),
            json_decode($trip['dislike']),
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
            INSERT INTO trips (title, description, image, created_at, id_assigned_by, likes, dislikes, date_start,time_start,
                               date_finish, time_finish, places, participants )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,? )
        ');

        $assignedById = $_SESSION['idUser'];

        $stmt->execute([
            $trip->getTitle(),
            $trip->getDescription(),
            $trip->getImage(),
            $date->format('Y-m-d'),
            $assignedById,
            $trip->getLikes(),
            $trip->getDislikes(),
            $trip->getDateStart(),
            $trip->getTimeStart(),
            $trip->getDateFinish(),
            $trip->getTimeFinish(),
            $trip->getPlaces(),
            (($trip->getParticipant()))
        ]);

//        $stmt = $this->database->connect()->prepare('
//            INSERT INTO users_trips (id_user, id_trip)
//            VALUES (?, ?)
//        ');
//        $stmt->execute([$_SESSION['idUser'], $this->getTripId($trip)]);
    }

    public function getTrips(): array
    {
        $result = [];
        $stmt = $this->database->connect()->prepare('
            SELECT array_to_json(participants) as part, array_to_json(likes) as like, array_to_json(dislikes) as dislike, * FROM trips
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
                json_decode($trip['part']),
                json_decode($trip['like']),
                json_decode($trip['dislike']),
                $trip['id'],
            );
        }

        return $result;
    }

    public function getOtherTrips()
    {
        $stmt = $this->database->connect()->prepare('
            SELECT array_to_json(participants) as parti ,array_to_json(likes) as like,
                   array_to_json(dislikes) as dislike,* FROM trips 
        ');
        $stmt->execute();

        $trips = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($trips as $trip){
            $participants = json_decode($trip['parti']);
            if (!in_array($_SESSION['idUser'],$participants)){
                $trip['participants']=json_decode($trip['parti']);
                $trip['like'] = json_decode($trip['like']);
                $trip['dislike'] = json_decode($trip['dislike']);
                array_push($result,$trip);
            }
        }
        return $result;
    }
    public function getJoinedTrips()
    {
        $stmt = $this->database->connect()->prepare('
            SELECT array_to_json(participants) as parti ,array_to_json(likes) as like,
                   array_to_json(dislikes) as dislike,* FROM trips 
        ');
        $stmt->execute();

        $trips = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($trips as $trip){
            $participants = json_decode($trip['parti']);
            if ((in_array($_SESSION['idUser'],$participants)&& $_SESSION['idUser'] != $participants[0])){
                $trip['participants']=json_decode($trip['parti']);
                $trip['like'] = json_decode($trip['like']);
                $trip['dislike'] = json_decode($trip['dislike']);
                array_push($result,$trip);
            }
        }
        return $result;
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
            SELECT array_to_json(participants) as parti ,array_to_json(likes) as like,
                   array_to_json(dislikes) as dislike,* FROM trips  WHERE LOWER(title) LIKE :search OR LOWER(description) LIKE :search
        ');
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();
        $trips =  $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($trips as $trip){
                $trip['participants']=json_decode($trip['parti']);
                $trip['like'] = json_decode($trip['like']);
                $trip['dislike'] = json_decode($trip['dislike']);
                array_push($result,$trip);
            }
        return $result;
    }

    public function like(int $id)
    {
        $trip = $this->getTrip($id);
        if ((!(in_array($_SESSION['idUser'], $trip->getDislikes()))) && (!(in_array($_SESSION['idUser'], $trip->getLikes())))) {
            $stmt = $this->database->connect()->prepare('
            update trips
            set likes = array_append(likes, :id_user)
            WHERE trips.id = :id;
         ');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':id_user', $_SESSION['idUser'], PDO::PARAM_INT);
            $stmt->execute();
        } else if ((in_array($_SESSION['idUser'], $trip->getLikes()))) {
            $stmt = $this->database->connect()->prepare('
            update trips
            set likes = array_remove(likes, :id_user)
            WHERE trips.id = :id;
         ');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':id_user', $_SESSION['idUser'], PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    public function dislike(int $id)
    {
        $trip = $this->getTrip($id);
        if ((!(in_array($_SESSION['idUser'], $trip->getDislikes()))) && (!(in_array($_SESSION['idUser'], $trip->getLikes())))) {
            $stmt = $this->database->connect()->prepare('
            update trips
            set dislikes = array_append(dislikes, :id_user)
            WHERE trips.id = :id;
         ');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':id_user', $_SESSION['idUser'], PDO::PARAM_INT);
            $stmt->execute();
        } else if ((in_array($_SESSION['idUser'], $trip->getDislikes()))) {
            $stmt = $this->database->connect()->prepare('
            update trips
            set dislikes = array_remove(dislikes, :id_user)
            WHERE trips.id = :id;
         ');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':id_user', $_SESSION['idUser'], PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    public function newParticipant(int $id)
    {
        $trip = $this->getTrip($id);
        $participants = ($trip->getParticipant())?$trip->getParticipant():[];
        if (!(in_array($_SESSION['idUser'], $participants))) {
            $stmt = $this->database->connect()->prepare('
            update trips
            set participants = array_append(participants, :id_user)
            WHERE trips.id = :id;
        ');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':id_user', $_SESSION['idUser'], PDO::PARAM_INT);
            $stmt->execute();
        }


    }
    public function myTrips(): array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT array_to_json(participants) as parti ,array_to_json(likes) as like,
                   array_to_json(dislikes) as dislike,* FROM trips 
        ');
        $stmt->execute();

        $trips = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($trips as $trip){
            $participants = json_decode($trip['parti']);
            if ($_SESSION['idUser'] == $participants[0]){
                $trip['participants']=json_decode($trip['parti']);
                $trip['like'] = json_decode($trip['like']);
                $trip['dislike'] = json_decode($trip['dislike']);
                array_push($result,$trip);
            }
        }
        return $result;
    }
    public function allTrips(){
        $stmt = $this->database->connect()->prepare('
            SELECT array_to_json(participants) as parti ,array_to_json(likes) as like,
                   array_to_json(dislikes) as dislike,* FROM trips 
        ');
        $stmt->execute();

        $trips = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($trips as $trip){
                $trip['participants'] = json_decode($trip['parti']);
                $trip['like'] = json_decode($trip['like']);
                $trip['dislike'] = json_decode($trip['dislike']);
                array_push($result,$trip);
        }
        return $result;
    }
    public function userTrips(): array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT array_to_json(participants) as parti ,array_to_json(likes) as likes,
                   array_to_json(dislikes) as dislikes,* FROM trips 
        ');
        $stmt->execute();

        $trips = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($trips as $trip){
            $participants = json_decode($trip['parti']);
            if (in_array($_SESSION['idUser'],$participants)){
                $trip['like'] = json_decode($trip['like']);
                $trip['dislike'] = json_decode($trip['dislike']);
                array_push($result,$trip);
            }
        }
        return $result;
    }
}