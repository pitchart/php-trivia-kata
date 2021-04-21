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

    /**
     * @return bool
     */
    public function enterPenaltyBox(): self
    {
        $this->inPenaltyBox = true;
        return $this;
    }

    /**
     * @return bool
     * @todo Does the player leave the penalty box?
     */
    public function leavePenaltyBox(): self
    {
        $this->inPenaltyBox = false;
        return $this;
    }

    /**
     * Places the player on his new position
     *
     * @param int $roll
     * @param int $numberOfPlaces
     */
    public function changePlace(int $roll, int $numberOfPlaces)
    {
        $this->place = ($this->place + $roll) % $numberOfPlaces;
    }

    /**
     *
     */
    public function incrementPurse()
    {
        $this->purse++;
    }
}