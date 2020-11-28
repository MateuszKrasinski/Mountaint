<?php

class Project
{
    private $title;
    private $description;
    private $image;
    private $date_start;
    private $date_finish;


    public function getDateStart()
    {
        return $this->date_start;
    }

    public function setDateStart($date_start)
    {
        $this->date_start = $date_start;
    }


    public function getDateFinish()
    {
        return $this->date_finish;
    }


    public function setDateFinish($date_finish)
    {
        $this->date_finish = $date_finish;
    }

    public function __construct($title, $description, $image, $date_start, $date_finish)
    {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->date_start = $date_start;
        $this->date_finish = $date_finish;

    }


    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }
}