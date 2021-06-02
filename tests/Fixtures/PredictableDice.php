<?php


namespace Tests\Fixtures;


use Trivia\DiceInterface;

class PredictableDice implements DiceInterface
{
    /**
     * @var array
     */
    private $values;

    /**
     * PredictableDice constructor.
     *
     * @param array $value
     */
    public function __construct(array $values)
    {
        $this->values = $values;
    }

    public function roll(): int
    {
        return array_shift($this->values);
    }
}