<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/User.php';

class UserRepository extends Repository
{
    public function getUsersFromIdArray(array $usersId)
    {
        $result = [];
        foreach ($usersId as $userId) {
            $user = $this->getUserById($userId);
            array_push($result, $user);
        }
        return $result;
    }

    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT u.id , email, password, name, surname, description, likes,dislikes, photo, first_mountain, second_mountain
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

            $user['id'],

        );
    }

    public function getUserById(int $id): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT u.id , email, password, name, surname, description,likes,dislikes, photo, first_mountain, second_mountain
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
            $user['likes'],
            $user['dislikes'],
            $user['id']
        );
    }

    public function getUsers(): ?array
    {
        $result = [];
        $stmt = $this->database->connect()->prepare('
            SELECT u.id , email, password, name, surname, description,likes,dislikes, photo, first_mountain, second_mountain
            FROM users u INNER JOIN users_details ud
            ON u.id_user_details = ud.id inner join profile_details pd on pd.id = u.id_profile_details
        ');
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($users as $user) {
            if ($user['id'] != $_SESSION['idUser'])
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
                    $user['followers'],
                    $user['followed'],
                    $user['id']
                );
        }

        return $result;
    }

    public function getMyFollowed(): ?array
    {
        $stmt = $this->database->connect()->prepare('
            select * from user_following_user
                  inner join users u on u.id = user_following_user.id_user_followed
                  INNER JOIN users_details ud
                             ON u.id_user_details = ud.id inner join profile_details pd on pd.id = u.id_profile_details
                where user_following_user.id_user_following = :id
                group by  id_user_following,id_user_followed, u.id, ud.id,pd.id

        ');
        $stmt->bindParam(':id', $_SESSION['idUser'], PDO::PARAM_INT);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;

    }

    public function getNotMyFollowed(): ?array
    {
        $stmt = $this->database->connect()->prepare('
            select * from users
    inner join profile_details p on p.id = users.id_profile_details
inner join users_details ud on ud.id = users.id_user_details
where users.id!=:id and  users.id not  in (select id_user_followed from user_following_user
                                                                inner join users u on u.id = user_following_user.id_user_followed
                                                                INNER JOIN users_details ud
                                                                           ON u.id_user_details = ud.id inner join profile_details pd on pd.id = u.id_profile_details
                               where user_following_user.id_user_following = :id
                               group by id_user_following, id_user_followed,u.id, ud.id,pd.id)

        ');
        $stmt->bindParam(':id', $_SESSION['idUser'], PDO::PARAM_INT);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;

    }

    public function getAllFriends(): ?array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT u.id , email, password, name, surname, description, photo, first_mountain, second_mountain
            FROM users u INNER JOIN users_details ud
            ON u.id_user_details = ud.id inner join profile_details pd on pd.id = u.id_profile_details
            where u.id != :id
        ');
        $stmt->bindParam(':id', $_SESSION['idUser'], PDO::PARAM_INT);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $users;

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
        foreach ($users as $user) {
            if (($user['id'] != $_SESSION['idUser'])) {
                array_push($result, $user);
            }
        }
        return $result;
    }

    public function emailInBase($mail)
    {

        $users = $this->getUsers();
        foreach ($users as $user) {
            if ($user->getEmail() === $mail)
                return true;
        }
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
        $stmt->bindParam(':name', $id1, PDO::PARAM_STR);
        $stmt->bindParam(':surname', $id2, PDO::PARAM_STR);
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
    public function getLikedUsers(){
        $stmt = $this->database->connect()->prepare('
            select id_liked from user_liking_user
            where id_liking=:id
        ');
        $stmt->bindParam(':id', $_SESSION['idUser'], PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    public function getDisLikedUsers(){
        $stmt = $this->database->connect()->prepare('
            select id_disliked from user_disliking_user
            where id_disliking=:id
        ');
        $stmt->bindParam(':id', $_SESSION['idUser'], PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    public function getUserId(User $user): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE email = :email 
        ');
        $mail = $user->getEmail();
        $stmt->bindParam(':email', $mail, PDO::PARAM_STR);
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
        $stmt->bindParam(':email', $mail, PDO::PARAM_STR);
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
        $stmt = $this->database->connect()->prepare('
            update profile_details
            set likes = likes+1
            WHERE profile_details.id = :id;
         ');
        $id_det = $this->getUserProfileDetailsId($user);
        $stmt->bindParam(':id', $id_det, PDO::PARAM_INT);
        $stmt->execute();
        $stmt2 = $this->database->connect()->prepare('
            insert into user_liking_user(id_liking, id_liked)
            values (?,?)
         ');
        $stmt2->execute([$_SESSION['idUser'], $id]);
    }
    public function unlike(int $id)
    {
        $user = $this->getUserById($id);
        $stmt = $this->database->connect()->prepare('
            update profile_details
            set likes = likes-1
            WHERE profile_details.id = :id;
         ');
        $id_det = $this->getUserProfileDetailsId($user);
        $stmt->bindParam(':id', $id_det, PDO::PARAM_INT);
        $stmt->execute();
        $stmt2 = $this->database->connect()->prepare('
            delete from  user_liking_user
            where id_liked = :id_liked AND id_liking = :id_liking
         ');
        $stmt2->bindParam('id_liked', $id);
        $stmt2->bindParam('id_liking', $_SESSION['idUser']);
        $stmt2->execute();
    }

    public function dislike(int $id)
    {
        $user = $this->getUserById($id);
        $stmt = $this->database->connect()->prepare('
            update profile_details
            set dislikes = dislikes+1
            WHERE profile_details.id = :id;
         ');
        $id_det = $this->getUserProfileDetailsId($user);
        $stmt->bindParam(':id', $id_det, PDO::PARAM_INT);
        $stmt->execute();
        $stmt2 = $this->database->connect()->prepare('
            insert into user_disliking_user(id_disliking, id_disliked)
            values (?,?)
         ');
        $stmt2->execute([$_SESSION['idUser'], $id]);
    }
    public function undislike(int $id)
    {
        $user = $this->getUserById($id);
        $stmt = $this->database->connect()->prepare('
            update profile_details
            set dislikes = dislikes-1
            WHERE profile_details.id = :id;
         ');
        $id_det = $this->getUserProfileDetailsId($user);
        $stmt->bindParam(':id', $id_det, PDO::PARAM_INT);
        $stmt->execute();
        $stmt2 = $this->database->connect()->prepare('
            delete from  user_disliking_user
            where id_disliked = :id_disliked AND id_disliking = :id_disliking
         ');
        $stmt2->bindParam('id_disliked', $id);
        $stmt2->bindParam('id_disliking', $_SESSION['idUser']);
        $stmt2->execute();
    }
    public function follow(int $id)
    {
        $idLogged = $_SESSION['idUser'];
        $stmt = $this->database->connect()->prepare('
            INSERT INTO user_following_user(id_user_following, id_user_followed)
             VALUES (?,?)
            ');
        $stmt->execute([$idLogged, $id]);
        $stmt2 = $this->database->connect()->prepare('
            update profile_details set followers = followers+1
            where id = :id;
            ');
        $followed = $this->getUserProfileDetailsId($this->getUserById($id));
        $stmt2->bindParam(":id", $followed, PDO::PARAM_INT);
        $stmt2->execute();
        $stmt3 = $this->database->connect()->prepare('
            update profile_details set followed = followed+1
            where id = :id;
            ');
        $followed = $this->getUserProfileDetailsId($this->getUserById($id));
        $logged = $this->getUserProfileDetailsId($this->getUserById($_SESSION['idUser']));
        $stmt3->bindParam(":id", $logged, PDO::PARAM_INT);
        $stmt3->execute();

    }
}