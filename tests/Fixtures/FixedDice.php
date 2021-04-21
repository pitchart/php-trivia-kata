<?php


namespace Tests\Fixtures;


use Trivia\DiceInterface;

class FixedDice implements DiceInterface
{
    /**
     * @var int
     */
    private $value;

    /**
     * FixedDice constructor.
     *
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->value = $value;
    }


    public function roll(): int
    {
        return $this->value;
    }

}