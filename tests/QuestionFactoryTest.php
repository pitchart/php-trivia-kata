<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Trivia\Categories;
use Trivia\QuestionFactory;

/**
 * Class QuestionFactoryTest
 * @package Tests
 */
class QuestionFactoryTest extends TestCase
{
    public function testCreate()
    {
        $questionFactory = new QuestionFactory();
        $result = $questionFactory->createList(Categories::POP, 50);
        $this->assertCount(50, $result);
    }
}