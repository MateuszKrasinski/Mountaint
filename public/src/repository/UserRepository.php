<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/User.php';

class UserRepository extends Repository
{

    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users u LEFT JOIN users_details ud 
            ON u.id_user_details = ud.id
            Left Join profile_details pd on pd.id = u.id_profile_details
            WHERE email = :email

        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return new User(
            $user['email'],
            $user['password'],
            $user['name'],
            $user['surname'],
            $user['phone'],
            $user['description'],
            $user['first_mountain'],
            $user['second_mountain'],
            $user['photo'],
            $user['likes'],
            $user['dislikes'],
            $user['id'],

        );
    }

    public function getUserById(int $id): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT u.id , email, password, name, surname, description, likes, dislikes, photo, first_mountain, second_mountain
            FROM users u INNER JOIN users_details ud
            ON u.id_user_details = ud.id inner join profile_details pd on pd.id = u.id_profile_details
            WHERE u.id = :id

        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($user == false) {
            return null;
        }
        return new User(
            $user['email'],
            $user['password'],
            $user['name'],
            $user['surname'],
            $user['phone'],
            $user['description'],
            $user['first_mountain'],
            $user['second_mountain'],
            $user['photo'],
            $user['likes'],
            $user['dislikes'],
            $user['id']
        );
    }

    public function getUsers(): ?array
    {
        $result = [];
        $stmt = $this->database->connect()->prepare('
            SELECT u.id , email, password, name, surname, description, likes, dislikes, photo, first_mountain, second_mountain
            FROM users u INNER JOIN users_details ud
            ON u.id_user_details = ud.id inner join profile_details pd on pd.id = u.id_profile_details
        ');
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($users as $user) {
            $result[] = new User(
                $user['email'],
                $user['password'],
                $user['name'],
                $user['surname'],
                $user['phone'],
                $user['description'],
                $user['first_mountain'],
                $user['second_mountain'],
                $user['photo'],
                $user['likes'],
                $user['dislikes'],
                $user['id']
            );
        }

        return $result;
    }

    public function getUsersByName($searchString): ?array
    {
        $searchString = '%' . strtolower($searchString) . '%';
        $stmt = $this->database->connect()->prepare('
            SELECT u.id , email, password, name, surname, description, likes, dislikes, photo, first_mountain, second_mountain
            FROM users u INNER JOIN users_details ud
            ON u.id_user_details = ud.id inner join profile_details pd on pd.id = u.id_profile_details
            WHERE LOWER(name) LIKE :search OR LOWER(surname) LIKE :search
        ');
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addUser(User $user)
    {
        $stmt2 = $this->database->connect()->prepare('
            INSERT INTO users_details (name,surname,phone)
            VALUES (?, ?, ?)
        ');

        $stmt2->execute([
            $user->getName(),
            $user->getSurname(),
            $user->getPhone()
        ]);
        $stmt3 = $this->database->connect()->prepare('
            INSERT INTO profile_details (description,likes,dislikes,photo,first_mountain,second_mountain)
            VALUES (?, ?, ?, ?, ?, ?)
            returning *
        ');

        $stmt3->execute([
            $user->getDescription(),
            $user->getLikes(),
            $user->getDislikes(),
            $user->getPhoto(),
            $user->getFirstMountain(),
            $user->getSecondMountain()

        ]);
        $lastInsertedRow = $stmt3->fetch(PDO::FETCH_ASSOC);
        $idForeignKeyProfileDetails = $lastInsertedRow['id'];
        $idForeignKeyUserDetails = $this->getUserDetailsId($user);

        $stmt = $this->database->connect()->prepare('
            INSERT INTO users (email, password, id_user_details, id_profile_details)
            VALUES (?, ?, ?,?)
        ');
        $stmt->execute([
            $user->getEmail(),
            $user->getPassword(),
            $idForeignKeyUserDetails,
            $idForeignKeyProfileDetails
        ]);

    }

    public function getUserDetailsId(User $user): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users_details WHERE name = :name AND surname = :surname AND phone = :phone
        ');
        $stmt->bindParam(':name', $user->getName(), PDO::PARAM_STR);
        $stmt->bindParam(':surname', $user->getSurname(), PDO::PARAM_STR);
        $stmt->bindParam(':phone', $user->getPhone(), PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['id'];
    }

    public function getProfileDetailsId(User $user): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.profile_details WHERE description = :description AND second_mountain = :secondMountain AND first_mountain = :firstMountain
        ');
        $stmt->bindParam(':description', $user->getDescription(), PDO::PARAM_STR);
//        $stmt->bindParam(':firstMountain', $user->getFirstMountain(), PDO::PARAM_STR);
//        $stmt->bindParam(':secondMountain', $user->getSecondMountain(), PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['id'];
    }

    public function getUserId(User $user): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE email = :email 
        ');
        $stmt->bindParam(':email', $user->getEmail(), PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['id'];
    }

    public function getUserProfileDetailsId(User $user): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE email = :email 
        ');
        $stmt->bindParam(':email', $user->getEmail(), PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['id_profile_details'];
    }

    public function setProfile(int $idProfileDetails, User $user): void
    {

        $stmt = $this->database->connect()->prepare('
            UPDATE public.profile_details
            SET first_mountain = (?),
                second_mountain = (?),
                photo = (?),
                description = (?)
            WHERE id = (?)
        ');
        $_POST['mountain1'] != "" ? $mountain1 = $_POST['mountain1'] : $mountain1 = $user->getFirstMountain();
        $_POST['mountain2'] != "" ? $mountain2 = $_POST['mountain2'] : $mountain2 = $user->getSecondMountain();
        $_FILES['file']['name'] != "" ? $file = $_FILES['file']['name'] : $file = $user->getPhoto();
        $stmt->execute([
            $mountain1,
            $mountain2,
            $file,
            $_POST['description'],
            $idProfileDetails
        ]);
    }
}