<?php

class User
{
    private $email;
    private $password;
    private $name;
    private $surname;
    private $phone;
    private $id;
    private $description;
    private $firstMountain;
    private $secondMountain;
    private $photo;
    private $likes;
    private $dislikes;
    private $followers;
    private $following;

    public function __construct($email, $password, $name, $surname, $phone, $description = "Opis",
                                $firstMountain = "mountain#1", $secondMountain = "mountain2#2",
                                $photo = "/public/img/uploads/person.svg", $likes = 0, $dislikes = 0,
                                $followers = 0, $following = 0,
                                $id = null)
    {
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
        $this->phone = $phone;
        $this->description = $description;
        $this->firstMountain = $firstMountain;
        $this->secondMountain = $secondMountain;
        $this->photo = $photo;
        $this->likes = $likes;
        $this->dislikes = $dislikes;
        $this->followers= $followers;
        $this->following = $following;
        $this->id = $id;
    }

    /**
     * @return mixed|string
     */
    public function getFollowers():int
    {
        return $this->followers;
    }

    /**
     * @param mixed|string $followers
     */
    public function setFollowers(string $followers): void
    {
        $this->followers = $followers;
    }


    public function getFollowing(): int
    {
        return $this->following;
    }


    public function setFollowing(string $following): void
    {
        $this->following = $following;
    }


    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     */
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getFirstMountain()
    {
        return $this->firstMountain;
    }

    /**
     * @param mixed $firstMountain
     */
    public function setFirstMountain($firstMountain): void
    {
        $this->firstMountain = $firstMountain;
    }

    /**
     * @return mixed
     */
    public function getSecondMountain()
    {
        return $this->secondMountain;
    }

    /**
     * @param mixed $secondMountain
     */
    public function setSecondMountain($secondMountain): void
    {
        $this->secondMountain = $secondMountain;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo): void
    {
        $this->photo = $photo;
    }

    /**
     * @return mixed
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * @param mixed $likes
     */
    public function setLikes($likes): void
    {
        $this->likes = $likes;
    }

    /**
     * @return mixed
     */
    public function getDislikes()
    {
        return $this->dislikes;
    }

    /**
     * @param mixed $dislikes
     */
    public function setDislikes($dislikes): void
    {
        $this->dislikes = $dislikes;
    }

}