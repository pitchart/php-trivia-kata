<?php


namespace Trivia;


class Category implements \Countable
{
    /**
     * @var array
     */
    private $questions = [];
    /**
     * @var string
     */
    private $label;

    /**
     * Category constructor.
     *
     * @param string $label
     */
    public function __construct(string $label)
    {
        if (!in_array($label, Categories::all())) {
            throw new \InvalidArgumentException(sprintf(
                "Trying to create a category with invalid category name '%s', only values in [%s] are allowed",
                $label, implode(', ', Categories::all())
            ));
        }
        $this->label = $label;
    }


    public function getLabel(): string
    {
        return $this->label;
    }

    public function addQuestion(Question $question)
    {
        if ($question->getCategory() !== $this->label) {
            throw new \InvalidArgumentException("Can only add questions in category $this->label");
        }

        $this->questions[] = $question;
    }

    /**
     * @return array
     */
    public function getQuestions(): array
    {
        return $this->questions;
    }

    public function next(): Question
    {
        $current = current($this->questions);
        next($this->questions);
        return $current;
    }

    /**
     * @inheritDoc
     */
    public function count()
    {
        return count($this->questions);
    }


}