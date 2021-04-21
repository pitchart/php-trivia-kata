<?php


namespace Trivia;


class Question
{
    /**
     * @var string
     */
    private $label;

    /**
     * @var string
     */
    private $category;


    /**
     * Question constructor.
     *
     * @param string $label
     */
    public function __construct(string $label, string $category)
    {
        if (!in_array($category, Categories::all())) {
            throw new \InvalidArgumentException(sprintf(
                "Trying to create a question with invalid category name '%s', only values in [%s] are allowed",
                $category, implode(', ', Categories::all())
            ));
        }
        $this->label = $label;
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }
}