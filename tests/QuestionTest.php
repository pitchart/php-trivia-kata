<?php

namespace Tests;

use Trivia\Categories;
use Trivia\Question;
use PHPUnit\Framework\TestCase;

class QuestionTest extends TestCase
{
    public function test_can_not_be_created_for_unexisting_category()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf(
        "Trying to create a question with invalid category name 'unexisting category', only values in [%s] are allowed",
            implode(', ', Categories::all())
        ));

        $question = new Question('label', 'unexisting category');
    }
}
