<?php

namespace Tests;

use Generator;
use PHPUnit\Framework\TestCase;
use Tests\Fixtures\ArrayOutput;
use Trivia\Game;
use Trivia\Player;

class GameTest extends TestCase
{
    /**
     * @var Game
     */
    private $game;

    /**
     * @var ArrayOutput
     */
    private $arrayOutput;

    /**
     * @return Generator
     */
    public function pointsProvider()
    {
        yield from [
            'a_player_scores_6' => [6],
            'a_player_scores_more_than_6' => ['$points' => 9]
        ];
    }

    protected function setUp(): void
    {
        $this->arrayOutput = new ArrayOutput();
        $this->game = new Game($this->arrayOutput);
    }

    public function test_can_add_player()
    {
        $this->game->addPlayer(new Player('toto'));

        $this->assertSame(1, $this->game->howManyPlayers());
    }

    /**
     * @param int $points
     * @dataProvider pointsProvider
     */
    public function test_game_is_ended($points)
    {
        $playerMock = $this->getMockBuilder(Player::class)
            ->disableOriginalConstructor()->onlyMethods(['getPurse'])->getMock();
        $playerMock->expects($this->once())->method('getPurse')->willReturn($points);

        $this->game->addPlayer($playerMock);

        $this->assertTrue($this->game->isEnded());
    }

    public function test_game_is_not_ended_on_game_start()
    {
        $this->assertFalse($this->game->isEnded());
    }

    public function test_game_is_not_ended_when_a_player_scores_less_than_6()
    {
        $this->game->purses[3] = 4;
        $this->assertFalse($this->game->isEnded());
    }

    public function test_initializes_with_questions()
    {
        $this->assertCount(50, $this->game->popQuestions);
        $this->assertCount(50, $this->game->sportsQuestions);
        $this->assertCount(50, $this->game->scienceQuestions);
        $this->assertCount(50, $this->game->rockQuestions);
    }



}
