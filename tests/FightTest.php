<?php

use App\Entity\Player\Player;
use App\Entity\Player\PlayerStats;
use App\Entity\Utils\RandGenerator;
use App\Service\Fight\Commentator\Commentator;
use App\Service\Fight\FightFactory;
use App\Service\Fight\FightPlayer;
use App\Service\Fight\PriorityDeterminer\PriorityDeterminer;
use App\Service\Fight\SparingFight;
use PHPUnit\Framework\TestCase;

class FightTest extends TestCase
{
    private $commentator;
    private $randGenerator;
    private $priorityDeterminer;
    private $fightPlayer1;
    private $fightPlayer2;

    protected function setUp()
    {
        $this->commentator = new Commentator();
        $this->randGenerator = $this->createMock(RandGenerator::class);
        $this->randGenerator->method("rand")->willReturn(100);

        $this->priorityDeterminer = new PriorityDeterminer();

        $playerStats1 = new PlayerStats();
        $playerStats1->setHealth(50);
        $playerStats1->setStrength(50);
        $playerStats1->setDefense(50);
        $playerStats1->setSpeed(50);
        $playerStats1->setLuck(0);

        $playerStats2 = clone $playerStats1;
        $playerStats2->setDefense(20);

        $player1 = new Player("player1", $playerStats1);
        $player2 = new Player("player2", $playerStats2);

        $this->fightPlayer1 = new FightPlayer($player1, $this->commentator, $this->randGenerator);
        $this->fightPlayer2 = new FightPlayer($player2, $this->commentator, $this->randGenerator);
    }

    public function testFightFactory()
    {
        $factory = new FightFactory();
        $sparingFactory = $factory->createSparingFight($this->commentator, $this->priorityDeterminer, $this->randGenerator);

        $this->assertInstanceOf(SparingFight::class, $sparingFactory);
    }

    public function testPlayerIsAlive()
    {
        $this->fightPlayer1->getPlayer()->getStats()->setHealth(0);

        $this->assertEquals(false, $this->fightPlayer1->isAlive());
        $this->assertEquals(true, $this->fightPlayer2->isAlive());
    }

    public function testDealDamage()
    {
        $this->fightPlayer1->hit($this->fightPlayer2);

        $playerStats = $this->fightPlayer2->getPlayer()->getStats();

        $this->assertEquals(20, $playerStats->getHealth());
    }

    public function testPlayerAttack()
    {
        $expectedComment = "{$this->fightPlayer1->getPlayer()->getName()} hit opponent dealing 30 damage. Opponent has 20 health left.";

        $this->fightPlayer1->attack($this->fightPlayer2);
        $playerStats = $this->fightPlayer2->getPlayer()->getStats();

        $this->assertEquals(20, $playerStats->getHealth());
        $this->assertContains($expectedComment, $this->commentator->getComments());
    }

    public function testPlayerAttackMiss()
    {
        $expectedComment = "{$this->fightPlayer1->getPlayer()->getName()} missed.";

        $this->fightPlayer2->getPlayer()->getStats()->setLuck(100);

        $this->fightPlayer1->attack($this->fightPlayer2);
        $playerStats = $this->fightPlayer2->getPlayer()->getStats();

        $this->assertEquals(50, $playerStats->getHealth());
        $this->assertContains($expectedComment, $this->commentator->getComments());
    }
}