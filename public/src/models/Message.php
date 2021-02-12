<?php


class Message
{
    private $to;
    private $from;
    private $content;
    private $time;

    /**
     * Message constructor.
     * @param $to
     * @param $from
     * @param $content
     * @param $time
     */
    public function __construct($to, $from, $content)
    {
        $this->to = $to;
        $this->from = $from;
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getTo():int
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
    public function getFrom():int
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
    public function getContent():string
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
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