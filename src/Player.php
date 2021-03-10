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
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function __toString()
    {
        return (string) $this->name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getPlace(): int
    {
        return $this->place;
    }

    /**
     * @return int
     */
    public function getPurse(): int
    {
        return $this->purse;
    }

    /**
     * @return bool
     */
    public function isInPenaltyBox(): bool
    {
        return $this->inPenaltyBox;
    }

    public function changePlace(int $roll, int $maxPlaces)
    {
        $this->place = ($this->place + $roll) % $maxPlaces;
    }

}