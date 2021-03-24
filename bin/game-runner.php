<?php

require_once __DIR__.'/../vendor/autoload.php';

use Trivia\Game;

$aGame = new Game();

$aGame->addPlayer("Chet");
$aGame->addPlayer("Pat");
$aGame->addPlayer("Sue");


do {

    $aGame->roll(rand(0,5) + 1);

    if (rand(0,9) == 7) {
        $aGame->wrongAnswer();
    } else {
        $aGame->correctAnswer();
    }



} while (!$aGame->isEnded());