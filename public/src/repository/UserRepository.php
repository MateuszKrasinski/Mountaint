<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{

    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users u LEFT JOIN users_details ud 
            ON u.id_user_details = ud.id WHERE email = :email
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
            $user['phone']
        );
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
        $stmt = $this->database->connect()->prepare('
            SELECT id FROM public.users_details WHERE phone = :phone
        ');
        $phone = $user->getPhone();
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->execute();

        $userID= $stmt->fetch(PDO::FETCH_ASSOC);
        $idForeignKey = $userID['id'];
        $stmt = $this->database->connect()->prepare('
            INSERT INTO users (email, password, id_user_details)
            VALUES (?, ?, ?)
        ');
        $stmt->execute([
            $user->getEmail(),
            $user->getPassword(),
            $idForeignKey
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
}