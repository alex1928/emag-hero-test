<?php

use App\Entity\Player\Player;
use App\Entity\Player\PlayerStats;
use App\Entity\Skill\HalfDamageSkill;
use App\Entity\Skill\SkillFactory;
use App\Entity\Skill\StrikeTwiceSkill;
use App\Entity\Utils\RandGenerator;
use App\Service\Fight\Commentator\Commentator;
use App\Service\Fight\FightPlayer;
use PHPUnit\Framework\TestCase;

class SkillTest extends TestCase
{
    private $commentator;
    private $randGenerator;
    private $fightPlayer1;
    private $fightPlayer2;

    protected function setUp()
    {
        $this->commentator = new Commentator();
        $this->randGenerator = $this->createMock(RandGenerator::class);
        $this->randGenerator->method("rand")->willReturn(100);

        $playerStats1 = new PlayerStats();
        $playerStats1->setHealth(50);
        $playerStats1->setStrength(50);
        $playerStats1->setDefense(50);
        $playerStats1->setSpeed(50);
        $playerStats1->setLuck(50);

        $playerStats2 = clone $playerStats1;
        $playerStats2->setDefense(20);

        $player1 = new Player("player1", $playerStats1);
        $player2 = new Player("player2", $playerStats2);

        $this->fightPlayer1 = new FightPlayer($player1, $this->commentator, $this->randGenerator);
        $this->fightPlayer2 = new FightPlayer($player2, $this->commentator, $this->randGenerator);
    }

    public function testSkillFactory()
    {
        $factory = new SkillFactory();
        $halfDamageSkill = $factory->createHalfDamageSkill();
        $strikeTwiceSkill = $factory->createStrikeTwiceSkill();

        $this->assertInstanceOf(HalfDamageSkill::class, $halfDamageSkill);
        $this->assertInstanceOf(StrikeTwiceSkill::class, $strikeTwiceSkill);
    }

    public function testHalfDamageSkill()
    {
        $halfDamageSkill = new HalfDamageSkill();

        $expectedComment = "{$this->fightPlayer1->getPlayer()->getName()} used Magic Shield and will take only half of damage!";
        $damage = 50;

        $damage = $halfDamageSkill->onDefense($this->fightPlayer1, $this->fightPlayer2, $this->commentator, $damage);

        $this->assertEquals(25, $damage);
        $this->assertContains($expectedComment, $this->commentator->getComments());
    }

    public function testStrikeTwiceSkill()
    {
        $halfDamageSkill = new StrikeTwiceSkill();

        $expectedComment = "{$this->fightPlayer1->getPlayer()->getName()} used Rapid Strike and will hit enemy two times!";

        $halfDamageSkill->onAttack($this->fightPlayer1, $this->fightPlayer2, $this->commentator);

        $this->assertCount(2, $this->commentator->getComments());
        $this->assertContains($expectedComment, $this->commentator->getComments());
    }
}