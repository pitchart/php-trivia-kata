<?php


namespace Trivia;


class Player
{
    private $name;

    private $place = 0;

    private $purse = 0;

    private $inPenaltyBox = false;

    /**
     * Player constructor.
     *
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    public function __toString()
    {
        return (string) $this->name;
    }


}