<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Trivia\Game;
use Trivia\Player;

class GameTest extends TestCase
{
    /**
     * @var Game
     */
    private $game;

    protected function setUp(): void
    {
        $this->game = new Game();
        ob_start();
    }

    protected function tearDown(): void
    {
        $output = ob_get_contents();
        ob_end_clean();
    }

    public function test_can_add_player()
    {
        $this->game->addPlayer(new Player('toto'));

        $this->assertSame(1, $this->game->howManyPlayers());
    }

    public function test_game_is_ended_when_a_player_scores_6()
    {

    }

    public function test_game_is_not_ended_when_a_player_scores_less_than_6()
    {

    }



}
