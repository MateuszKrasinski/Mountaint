<?php

class Trip
{
    private $title;
    private $description;
    private $image;
    private $date_start;
    private $date_finish;
    private $time_start;
    private $time_finish;
    private $likes;
    private $dislikes;
    private $organizer;
    private $id;
    private $places;
    private $participants = [];

    public function getParticipant()
    {
        return $this->participants;
    }

    public function __construct($organizer, $title, $description, $image, $date_start, $time_start, $date_finish, $time_finish, $places,$participants, $likes = 0, $dislikes = 0, $id = null)
    {
        $this->organizer = $organizer;
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->date_start = $date_start;
        $this->date_finish = $date_finish;
        $this->time_start = $time_start;
        $this->time_finish = $time_finish;
        $this->likes = $likes;
        $this->dislikes = $dislikes;
        $this->id = $id;
        $this->participants = $participants;
        $this->places = $places;
    }

    /**
     * @return mixed
     */
    public function getPlaces(): string
    {
        return $this->places;
    }

    /**
     * @param mixed $places
     */
    public function setPlaces($places): void
    {
        $this->places = $places;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
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
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getDateStart()
    {
        return $this->date_start;
    }

    /**
     * @param mixed $date_start
     */
    public function setDateStart($date_start): void
    {
        $this->date_start = $date_start;
    }

    /**
     * @return mixed
     */
    public function getDateFinish()
    {
        return $this->date_finish;
    }

    /**
     * @param mixed $date_finish
     */
    public function setDateFinish($date_finish): void
    {
        $this->date_finish = $date_finish;
    }

    /**
     * @return mixed
     */
    public function getTimeStart()
    {
        return $this->time_start;
    }

    /**
     * @param mixed $time_start
     */
    public function setTimeStart($time_start): void
    {
        $this->time_start = $time_start;
    }

    /**
     * @return mixed
     */
    public function getTimeFinish()
    {
        return $this->time_finish;
    }

    /**
     * @param mixed $time_finish
     */
    public function setTimeFinish($time_finish): void
    {
        $this->time_finish = $time_finish;
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

    /**
     * @return mixed
     */
    public function getOrganizer()
    {
        return $this->organizer;
    }

    /**
     * @param mixed $organizer
     */
    public function setOrganizer($organizer): void
    {
        $this->organizer = $organizer;
    }

    /**
     * @return mixed|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed|null $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }


}