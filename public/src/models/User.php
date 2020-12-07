<?php

class User {
    private $email;
    private $password;
    private $name;
    private $surname;
    private $id;
    private $photo;
    private $numberOfHearts;
    private $numberOfMinuses;
    private $description;

    public function __construct(
        string $email,
        string $password,
        string $name,
        string $surname,
        string $id,
        string $description = '',
        string $photo = __DIR__.'/img/person2.svg',
        int $numberOfHearts = 0 ,
        int $numberOfMinuses = 0
    ) {
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
        $this->id = $id;
        $this->photo = $photo;
        $this->numberOfMinuses = $numberOfMinuses;
        $this->numberOfHearts = $numberOfHearts;
        $this->description = $description;
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
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getPhoto(): string
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setPhoto(string $photo): void
    {
        $this->photo = $photo;
    }

    /**
     * @return int
     */
    public function getNumberOfHearts(): int
    {
        return $this->numberOfHearts;
    }

    /**
     * @param int $numberOfHearts
     */
    public function setNumberOfHearts(int $numberOfHearts): void
    {
        $this->numberOfHearts = $numberOfHearts;
    }

    /**
     * @return int
     */
    public function getNumberOfMinuses(): int
    {
        return $this->numberOfMinuses;
    }

    /**
     * @param int $numberOfMinuses
     */
    public function setNumberOfMinuses(int $numberOfMinuses): void
    {
        $this->numberOfMinuses = $numberOfMinuses;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }


}