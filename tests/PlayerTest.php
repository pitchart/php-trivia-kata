<?php

namespace Tests;

use Trivia\Player;
use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{
    /**
     * @var Player
     */
    private $player;

    protected function setUp(): void
    {
        $this->player = new Player('Toto', 1);
    }

    public function test_has_a_name()
    {
        $this->assertEquals('Toto', $this->player->getName());
    }

    public function test_has_0_place_on_creation()
    {
        $this->assertEquals(0 , $this->player->getPlace());
    }

    public function test_is_not_in_penalty_box_on_creation()
    {
        $this->assertFalse($this->player->isInPenaltyBox());
    }

    public function test_has_not_scored_on_creation()
    {
        $this->assertEquals(0, $this->player->getPurse());
    }

    public function test_changes_place_without_riching_max_value()
    {

    }

    public function test_changes_place_riching_max_value()
    {

    }

}
