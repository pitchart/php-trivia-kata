<?php


namespace Trivia;


class Question
{
    /**
     * @var string
     */
    private $label;

    /**
     * Question constructor.
     *
     * @param string $label
     */
    public function __construct(string $label)
    {
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

}