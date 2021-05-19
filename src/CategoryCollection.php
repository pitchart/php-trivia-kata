<?php

namespace Trivia;

/***
 * Class CategoryCollection
 * @package Trivia
 */
class CategoryCollection
{
    /**
     * @var array
     */
    private $categories = [];

    /**
     * @param Question $question
     */
    public function add(Question ...$questions)
    {
        foreach ($questions as $question)
        {
            $category = $question->getCategory();
            if (!isset($this->categories[$category])) {
                $this->categories[$category] = new Category($category);
            }
            $this->categories[$category]->addQuestion($question);
        }
    }

    /**
     * @param string $categoryLabel
     * @return mixed
     */
    public function next(string $categoryLabel)
    {
        if (isset($this->categories[$categoryLabel]))
        {
            return $this->categories[$categoryLabel]->next();
        }
        return null;
    }
}