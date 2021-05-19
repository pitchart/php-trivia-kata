<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Trivia\Categories;
use Trivia\CategoryCollection;
use Trivia\Question;

class CategoryCollectionTest extends TestCase
{
    public function testAddQuestionToCategory()
    {
        $categoryCollection = new CategoryCollection();
        $question = new Question('Random question', Categories::POP);
        $categoryCollection->add($question);
        $this->assertSame($question, $categoryCollection->next(Categories::POP));
    }

    public function testGetMissingCategory()
    {
        $categoryCollection = new CategoryCollection();
        $this->assertNull($categoryCollection->next(Categories::POP));
    }
}