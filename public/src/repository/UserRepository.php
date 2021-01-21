<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/User.php';

class UserRepository extends Repository
{
    public function getUsersFromIdArray(array $usersId){
        $result = [];
        foreach ($usersId as $userId){
            $user =  $this->getUserById($userId);
            array_push($result,$user);
        }
        return $result;
    }

    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT u.id , email, password, name, surname, description, array_to_json(likes) as likes,
                   array_to_json(dislikes) as dislikes, photo, first_mountain, second_mountain, array_to_json(followers)
                       as followers, array_to_json(following) as following
            FROM users u INNER JOIN users_details ud
            ON u.id_user_details = ud.id inner join profile_details pd on pd.id = u.id_profile_details
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
            json_decode($user['likes']),
            json_decode($user['dislikes']),
            json_decode($user['followers']),
            json_decode($user['following']),
            $user['id'],

        );
    }

    public function getUserById(int $id): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT u.id , email, password, name, surname, description, array_to_json(likes) as like,
                   array_to_json(dislikes) as dislike, photo, first_mountain, second_mountain, array_to_json(followers)
                       as fers, array_to_json(following) as fing
            FROM users u INNER JOIN users_details ud
            ON u.id_user_details = ud.id inner join profile_details pd on pd.id = u.id_profile_details
            where u.id = :id
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
            json_decode($user['like']),
            json_decode($user['dislike']),
            json_decode($user['fers']),
            json_decode($user['fing']),
            $user['id']
        );
    }

    public function getUsers(): ?array
    {
        $result = [];
        $stmt = $this->database->connect()->prepare('
            SELECT * from all_users
        ');
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($users as $user) {
            if($user['id']!= $_SESSION['idUser'])
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
                json_decode($user['like']),
                json_decode($user['dislike']),
                json_decode($user['fers']),
                json_decode($user['fing']),
                $user['id']
            );
        }

        return $result;
    }
    public function getMyFollowed(): ?array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT u.id , email, password, name, surname, description, array_to_json(likes) as like,
                   array_to_json(dislikes) as dislike, photo, first_mountain, second_mountain, array_to_json(followers)
                       as fers, array_to_json(following) as fing
            FROM users u INNER JOIN users_details ud
            ON u.id_user_details = ud.id inner join profile_details pd on pd.id = u.id_profile_details
        ');
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($users as $user){
            $followers = json_decode($user['fers']);
            if(in_array($_SESSION['idUser'], $followers))
            {
                $user['like'] = json_decode($user['like']);
                $user['dislike'] = json_decode($user['dislike']);
                array_push($result, $user);
            }
        }
        return $result;

    }
    public function getNotMyFollowed(): ?array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT u.id , email, password, name, surname, description, array_to_json(likes) as like,
                   array_to_json(dislikes) as dislike, photo, first_mountain, second_mountain, array_to_json(followers)
                       as fers, array_to_json(following) as fing
            FROM users u INNER JOIN users_details ud
            ON u.id_user_details = ud.id inner join profile_details pd on pd.id = u.id_profile_details
        ');
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($users as $user){
            $followers = json_decode($user['fers']);
            if((!in_array($_SESSION['idUser'], $followers) && ($user['id'] != $_SESSION['idUser'])))
            {
                $user['like'] = json_decode($user['like']);
                $user['dislike'] = json_decode($user['dislike']);
                array_push($result, $user);
            }
        }
        return $result;

    }
    public function getAllFriends(): ?array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT u.id , email, password, name, surname, description, array_to_json(likes) as like,
                   array_to_json(dislikes) as dislike, photo, first_mountain, second_mountain, array_to_json(followers)
                       as fers, array_to_json(following) as fing
            FROM users u INNER JOIN users_details ud
            ON u.id_user_details = ud.id inner join profile_details pd on pd.id = u.id_profile_details
        ');
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($users as $user){
            if( ($user['id'] != $_SESSION['idUser']))
            {
                $user['like'] = json_decode($user['like']);
                $user['dislike'] = json_decode($user['dislike']);
                array_push($result, $user);
            }
        }
        return $result;

    }
    public function getUsersByName($searchString): ?array
    {
        $searchString = '%' . strtolower($searchString) . '%';
        $stmt = $this->database->connect()->prepare('
            SELECT u.id , email, password, name, surname, description, array_to_json(likes) as like, array_to_json(dislikes) as dislike, photo, first_mountain, second_mountain
            FROM users u INNER JOIN users_details ud
            ON u.id_user_details = ud.id inner join profile_details pd on pd.id = u.id_profile_details
            WHERE LOWER(name) LIKE :search OR LOWER(surname) LIKE :search
        ');
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($users as $user){
            if( ($user['id'] != $_SESSION['idUser']))
            {
                $user['like'] = json_decode($user['like']);
                $user['dislike'] = json_decode($user['dislike']);
                array_push($result, $user);
            }
        }
        return $result;
    }
    public function emailInBase($mail){
        $stmt = $this->database->connect()->prepare('
            select * from users
            where email = :email
        ');
        $stmt->bindParam(':email',$mail , PDO::PARAM_STR);
        $isEmailInBase=$stmt->execute();
        if ($isEmailInBase)
            return true;
        return false;
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
            $user->getSecondMountain(),

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
            SELECT * FROM public.users_details WHERE name = :name AND surname = :surname 
        ');
        $id1 = $user->getName();
        $id2 = $user->getSurname();
//        $id3 = $user->getPhone();
        $stmt->bindParam(':name',$id1 , PDO::PARAM_STR);
        $stmt->bindParam(':surname',$id2 , PDO::PARAM_STR);
//        $stmt->bindParam(':phone', $id3, PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['id'];
    }

    public function getProfileDetailsId(User $user): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.profile_details WHERE description = :description AND second_mountain = :secondMountain AND first_mountain = :firstMountain
        ');
        $desc = $user->getDescription();
        $stmt->bindParam(':description', $desc, PDO::PARAM_STR);
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
        $mail = $user->getEmail();
        $stmt->bindParam(':email',$mail , PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['id'];
    }

    public function getUserProfileDetailsId(User $user): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE email = :email 
        ');
        $mail = $user->getEmail();
        $stmt->bindParam(':email',$mail , PDO::PARAM_STR);
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

    public function like(int $id)
    {
        $user = $this->getUserById($id);
        if ((!(in_array($_SESSION['idUser'], $user->getDislikes()))) && (!(in_array($_SESSION['idUser'], $user->getLikes())))) {
            $stmt = $this->database->connect()->prepare('
            update profile_details
            set likes = array_append(likes, :id_user)
            WHERE profile_details.id = :id;
         ');
            $id_det = $this->getUserProfileDetailsId($user);
            $stmt->bindParam(':id', $id_det, PDO::PARAM_INT);
            $stmt->bindParam(':id_user', $_SESSION['idUser'], PDO::PARAM_INT);
            $stmt->execute();
        }else if ((in_array($_SESSION['idUser'], $user->getLikes()))) {
            $stmt = $this->database->connect()->prepare('
            update profile_details
            set likes = array_remove(likes, :id_user)
            WHERE profile_details.id = :id;
         ');
            $id_det = $this->getUserProfileDetailsId($user);
            $stmt->bindParam(':id', $id_det, PDO::PARAM_INT);
            $stmt->bindParam(':id_user', $_SESSION['idUser'], PDO::PARAM_INT);
            $stmt->execute();
        }

    }

    public function dislike(int $id)
    {
        $user = $this->getUserById($id);
        if ((!(in_array($_SESSION['idUser'], $user->getDislikes()))) && (!(in_array($_SESSION['idUser'], $user->getLikes())))) {
            $stmt = $this->database->connect()->prepare('
            update profile_details
            set dislikes = array_append(dislikes, :id_user)
            WHERE profile_details.id = :id;
         ');
            $id_det = $this->getUserProfileDetailsId($user);
            $stmt->bindParam(':id', $id_det, PDO::PARAM_INT);
            $stmt->bindParam(':id_user', $_SESSION['idUser'], PDO::PARAM_INT);
            $stmt->execute();
        }else if ((in_array($_SESSION['idUser'], $user->getDislikes()))) {
            $stmt = $this->database->connect()->prepare('
            update profile_details
            set dislikes = array_remove(dislikes, :id_user)
            WHERE profile_details.id = :id;
         ');
            $id_det = $this->getUserProfileDetailsId($user);
            $stmt->bindParam(':id', $id_det, PDO::PARAM_INT);
            $stmt->bindParam(':id_user', $_SESSION['idUser'], PDO::PARAM_INT);
            $stmt->execute();
        }
    }
    public function follow(int $id)
    {
        $idLogged = $_SESSION['idUser'];
        $followedUser = $this->getUserById($id);
        $followedUserIdDetails = $this->getUserProfileDetailsId($followedUser);
        $followingUser = $this->getUserById($_SESSION['idUser']);
        $followingUserIdDetails = $this->getUserProfileDetailsId($followingUser);
        $stmt = $this->database->connect()->prepare('
            update profile_details
            set followers = array_append(followers, :id_user)
            WHERE profile_details.id = :id;
         ');
        $stmt->bindParam(':id',$followedUserIdDetails,PDO::PARAM_INT);
        $stmt->bindParam(':id_user', $idLogged, PDO::PARAM_INT);
        $stmt->execute();

        $stmt2 = $this->database->connect()->prepare('
            update profile_details
            set following = array_append(following, :id_user)
            WHERE profile_details.id = :id;
         ');
        $stmt2->bindParam(':id',$followingUserIdDetails,PDO::PARAM_INT);
        $stmt2->bindParam(':id_user',$id,PDO::PARAM_INT);
        $stmt2->execute();
    }
}