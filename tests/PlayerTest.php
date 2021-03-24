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
        $this->player = new Player('Toto');
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

    public function test_changes_place_without_reaching_max_value()
    {
        $this->player->changePlace(2, 5);

        $this->assertEquals(2, $this->player->getPlace());
    }

    public function test_changes_place_reaching_max_value()
    {
        $this->player->changePlace(6, 4);

        $this->assertEquals(2, $this->player->getPlace());
    }

    public function test_reaching_max_place_on_many_rolls_leads_to_initial_place()
    {
        $this->player->changePlace(2, 6);
        $this->player->changePlace(4, 6);

        $this->assertEquals(0, $this->player->getPlace());
    }

    public function test_increment_purse()
    {
        $this->player->incrementPurse();
        $this->assertEquals(1, $this->player->getPurse());
    }

    public function test_enters_penalty_box()
    {
        $this->player->enterPenaltyBox();
        $this->assertTrue($this->player->isInPenaltyBox());
    }

    public function test_leaves_penalty_box()
    {
        $this->player->enterPenaltyBox();
        $this->player->leavePenaltyBox();
        $this->assertFalse($this->player->isInPenaltyBox());
    }

}
