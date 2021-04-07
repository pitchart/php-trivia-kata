<?php

namespace Trivia;

class Dice implements DiceInterface
{
    private $max;

    /**
     * Dice constructor.
     * @param $max
     */
    public function __construct($max)
    {
        $this->max = $max;
    }


    public function roll(): int
    {
        return rand(1,$this->max);
    }
}
