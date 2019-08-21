<?php

use App\Entity\Player\Player;
use App\Service\Fight\Commentator\Commentator;
use App\Service\Fight\Commentator\TextFightCommentFormatter;
use App\Service\Fight\FightFactory;
use App\Service\Fight\FightPlayer;
use App\Service\Fight\PriorityDeterminer\PriorityDeterminer;
use App\Service\StatsProvider\StaticPlayerStatsProvider;
use PHPUnit\Framework\TestCase;

final class CommentatorTest extends TestCase
{

    public function testAttack() : void
    {
        $heroStatProvider = new StaticPlayerStatsProvider(
            50,
            20,
            20,
            30,
            100
        );
        $hero = new Player("Orderus");
        $hero->setStats($heroStatProvider);

        $enemyStatProvider = new StaticPlayerStatsProvider(
            50,
            20,
            10,
            25,
            0
        );
        $enemy = new Player("Enemy");
        $enemy->setStats($enemyStatProvider);

        $textCommentFormatter = new TextFightCommentFormatter();

        $commentator = new Commentator($textCommentFormatter);

        $fightPlayer1 = new FightPlayer($hero);
        $fightPlayer2 = new FightPlayer($enemy);

        $fightPlayer1->attack($fightPlayer2, $commentator);

        $formattedComments = $commentator->getFormattedComments();

        $this->assertEquals(1, count($formattedComments));
        $this->assertEquals("Orderus hit opponent dealing 10 damage. Opponent has 40 health left.<br>", (string)$formattedComments[0]);

        $this->assertEquals(40, $enemy->getHealth());

    }


    public function testWinner() : void
    {
        $heroStatProvider = new StaticPlayerStatsProvider(
            50,
            100,
            20,
            30,
            100
        );
        $hero = new Player("Orderus");
        $hero->setStats($heroStatProvider);

        $enemyStatProvider = new StaticPlayerStatsProvider(
            10,
            20,
            10,
            25,
            0
        );
        $enemy = new Player("Enemy");
        $enemy->setStats($enemyStatProvider);

        $textCommentFormatter = new TextFightCommentFormatter();

        $commentator = new Commentator($textCommentFormatter);

        $priorityDeterminer = new PriorityDeterminer();

        $fightFactory = new FightFactory( $commentator, $priorityDeterminer);
        $sparingFight = $fightFactory->createSparingFight($hero, $enemy);

        $sparingFight->fight();

        $winner = $sparingFight->getWinner();

        $this->assertEquals($hero, $winner);
    }
}