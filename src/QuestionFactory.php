<?php

namespace Trivia;

use InvalidArgumentException;

/**
 * Class QuestionFactory
 * @package Trivia
 */
class QuestionFactory
{
    const QUESTION_LABELS = [
        Categories::SPORTS => "Sports Question",
        Categories::ROCK => "Rock Question",
        Categories::SCIENCE => "Science Question",
        Categories::POP => "Pop Question",
    ];

    /**
     * @param string $category
     * @param int $amount
     * @return Question[]
     */
    public function createList(string $category, int $amount)
    {
        $list = [];
        for ($i = 0; $i < $amount; $i++) {
            $list[] = $this->create($category, $i);
        }
        return $list;
    }

    /**
     * @param string $category
     * @param int $index
     * @return Question
     */
    public function create(string $category, int $index): Question
    {
        $questionLabel = $this->createLabel($category);
        return new Question($questionLabel . " " . $index, $category);
    }

    /**
     * @param string $category
     * @return string
     */
    private function createLabel(string $category)
    {
        if (isset(self::QUESTION_LABELS[$category])) {
            return self::QUESTION_LABELS[$category];
        }
        throw new InvalidArgumentException(sprintf(
            '$category must be in [%s], %s given',
            implode(', ', Categories::all()),
            $category
        ));
    }
}