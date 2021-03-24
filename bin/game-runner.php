<?php

require_once __DIR__.'/../vendor/autoload.php';

use Trivia\Game;
use Trivia\Player;

$aGame = new Game();

$aGame->addPlayer(new Player("Chet"));
$aGame->addPlayer(new Player("Pat"));
$aGame->addPlayer(new Player("Sue"));


do {

    $aGame->roll(rand(0,5) + 1);

    if (rand(0,9) == 7) {
        $aGame->wrongAnswer();
    } else {
        $aGame->correctAnswer();
    }



} while (!$aGame->isEnded());