<?php

namespace Tests;

use Trivia\Categories;
use Trivia\Category;
use PHPUnit\Framework\TestCase;
use Trivia\Question;

class CategoryTest extends TestCase
{
    public function test_is_linked_to_a_categories_item()
    {
        $category = new Category(Categories::ROCK);

        $this->assertEquals(Categories::ROCK, $category->getLabel());
    }

    public function test_is_not_linked_to_anything_but_a_categories_item()
    {
        $this->expectException(\InvalidArgumentException::class);

        $category = new Category('Toto');
    }

    public function test_can_have_questions()
    {
        $category = new Category(Categories::ROCK);

        $category->addQuestion(new Question('Rock question', Categories::ROCK));

        $this->assertCount(1, $category->getQuestions());
    }

    public function test_can_not_have_questions_in_a_different_category()
    {
        $category = new Category(Categories::ROCK);

        $this->expectException(\InvalidArgumentException::class);
        $category->addQuestion(new Question('Pop question', Categories::POP));
    }

    public function test_retrieves_the_first_question_when_asking_for_the_first_time()
    {
        $category = new Category(Categories::ROCK);

        for ($i = 1; $i <= 10; $i++) {
            $category->addQuestion(new Question('Rock question '.$i, Categories::ROCK));
        }

        $this->assertEquals('Rock question 1', $category->next()->getLabel());
    }

    public function test_can_retrieve_the_next_question_to_ask()
    {
        $category = new Category(Categories::ROCK);

        for ($i = 1; $i <= 10; $i++) {
            $category->addQuestion(new Question('Rock question '.$i, Categories::ROCK));
        }

        $category->next();
        $category->next();
        $category->next();

        $this->assertEquals('Rock question 4', $category->next()->getLabel());
    }


}
