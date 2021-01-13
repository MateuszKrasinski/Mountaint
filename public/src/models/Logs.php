<?php


class Logs
{
    private $name;
    private $surname;
    private $browser;
    private $dataTime;
    private $host;

    private $device;
    private $id;

    /**
     * Logs constructor.
     * @param $name
     * @param $surname
     * @param $browser
     * @param $dataTime
     * @param $host
     * @param $device
     */
    public function __construct($name, $surname, $browser, $dataTime, $host, $device)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->browser = $browser;
        $this->dataTime = $dataTime;
        $this->host = $host;
        $this->device = $device;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return mixed
     */
    public function getDevice():string
    {
        return $this->device;
    }

    /**
     * @param mixed $device
     */
    public function setDevice($device): void
    {
        $this->device = $device;
    }

    /**
     * @return mixed
     */
    public function getDataTime()
    {
        return $this->dataTime;
    }

    /**
     * @param mixed $dataTime
     */
    public function setDataTime($dataTime): void
    {
        $this->dataTime = $dataTime;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param mixed $host
     */
    public function setHost($host): void
    {
        $this->host = $host;
    }

    /**
     * @return mixed
     */
    public function getBrowser()
    {
        return $this->browser;
    }

    /**
     * @param mixed $browser
     */
    public function setBrowser($browser): void
    {
        $this->browser = $browser;
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







}