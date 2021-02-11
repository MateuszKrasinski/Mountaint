<?php


class Notification
{
    private User  $to;
    private User $from;
    private $type;
    private $trip;
    private $time;


    public function __construct(User $from, User $to, $type, Trip $trip = null)
    {
        $this->to = $to;
        $this->from = $from;
        $this->type = $type;
            $this->trip = $trip;
    }

    /**
     * @return Trip
     */
    public function getTrip(): ?Trip
    {
        return $this->trip;
    }

    /**
     * @param Trip $trip
     */
    public function setTrip(Trip $trip): void
    {
        $this->trip = $trip;
    }



    /**
     * @return mixed
     */
    public function getTo():User
    {
        return $this->to;
    }

    /**
     * @param mixed $to
     */
    public function setTo($to): void
    {
        $this->to = $to;
    }

    /**
     * @return mixed
     */
    public function getFrom(): User
    {
        return $this->from;
    }

    /**
     * @param mixed $from
     */
    public function setFrom($from): void
    {
        $this->from = $from;
    }

    /**
     * @return mixed
     */
    public function getType():string
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time): void
    {
        $this->time = $time;
    }

}