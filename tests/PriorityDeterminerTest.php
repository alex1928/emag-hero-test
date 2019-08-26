<?php

use App\Entity\Player\Player;
use App\Entity\Player\PlayerStats;
use App\Service\Fight\PriorityDeterminer\PriorityDeterminer;
use PHPUnit\Framework\TestCase;

class PriorityDeterminerTest extends TestCase
{
    private $priorityDeterminer;
    private $player1;
    private $player2;

    protected function setUp()
    {
        $this->priorityDeterminer = new PriorityDeterminer();

        $playerStats1 = new PlayerStats();
        $playerStats1->setHealth(50);
        $playerStats1->setStrength(50);
        $playerStats1->setDefense(50);
        $playerStats1->setSpeed(50);
        $playerStats1->setLuck(50);

        $playerStats2 = clone $playerStats1;

        $this->player1 = new Player("player1", $playerStats1);
        $this->player2 = new Player("player2", $playerStats2);
    }

    public function testSpeedPriority()
    {
        $this->player1->getStats()->setSpeed(60);
        $first = $this->priorityDeterminer->getFirst($this->player1, $this->player2);

        $this->assertEquals($this->player1, $first);
    }

    public function testSpeedPriorityInversed()
    {
        $this->player2->getStats()->setSpeed(60);
        $first = $this->priorityDeterminer->getFirst($this->player1, $this->player2);

        $this->assertEquals($this->player2, $first);
    }

    public function testLuckPriority()
    {
        $this->player1->getStats()->setLuck(60);

        $first = $this->priorityDeterminer->getFirst($this->player1, $this->player2);

        $this->assertEquals($this->player1, $first);
    }

    public function testLuckPriorityInversed()
    {
        $this->player2->getStats()->setLuck(60);

        $first = $this->priorityDeterminer->getFirst($this->player1, $this->player2);

        $this->assertEquals($this->player2, $first);
    }
}