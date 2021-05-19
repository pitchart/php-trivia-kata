<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Trivia\Categories;
use Trivia\CategoryCollection;
use Trivia\ConsoleOutput;
use Trivia\Game;
use Trivia\Player;
use Trivia\QuestionFactory;

$categoryCollection = new CategoryCollection();
$questionFactory = new QuestionFactory();

foreach (Categories::all() as $categoryLabel) {
    $questions = $questionFactory->createList($categoryLabel, 50);
    $categoryCollection->add(...$questions);
}

$aGame = new Game(new ConsoleOutput(), $categoryCollection);

$aGame->addPlayer(new Player("Chet"));
$aGame->addPlayer(new Player("Pat"));
$aGame->addPlayer(new Player("Sue"));


do {

    $aGame->roll();

    if (rand(0, 9) == 7) {
        $aGame->wrongAnswer();
    } else {
        $aGame->correctAnswer();
    }


} while (!$aGame->isEnded());