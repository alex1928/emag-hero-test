<?php

use App\Entity\Player\Player;
use App\Service\Fight\PriorityDeterminer\PriorityDeterminer;
use App\Service\StatsProvider\StaticPlayerStatsProvider;
use PHPUnit\Framework\TestCase;

final class PriorityDeterminerTest extends TestCase
{
    public function testSpeedPriority() : void
    {
        $heroStatProvider = new StaticPlayerStatsProvider(
            10,
            10,
            10,
            15,
            10
        );

        $monsterStatProvider = new StaticPlayerStatsProvider(
            10,
            10,
            10,
            10,
            10
        );

        $player1 = new Player("Player1");
        $player1->setStats($heroStatProvider);

        $player2 = new Player("Player2");
        $player2->setStats($monsterStatProvider);
        $priorityDeterminer = new PriorityDeterminer();

        $firstPlayer = $priorityDeterminer->getFirst($player1, $player2);
        $this->assertEquals($player1, $firstPlayer);

        $firstPlayer = $priorityDeterminer->getFirst($player2, $player1);
        $this->assertEquals($player1, $firstPlayer);
    }

    public function testLuckPriority() : void
    {
        $heroStatProvider = new StaticPlayerStatsProvider(
            10,
            10,
            10,
            10,
            15
        );

        $monsterStatProvider = new StaticPlayerStatsProvider(
            10,
            10,
            10,
            10,
            10
        );

        $player1 = new Player("Player1");
        $player1->setStats($heroStatProvider);

        $player2 = new Player("Player2");
        $player2->setStats($monsterStatProvider);
        $priorityDeterminer = new PriorityDeterminer();

        $firstPlayer = $priorityDeterminer->getFirst($player1, $player2);
        $this->assertEquals($player1, $firstPlayer);

        $firstPlayer = $priorityDeterminer->getFirst($player2, $player1);
        $this->assertEquals($player1, $firstPlayer);
    }

    public function testRandomPriority() : void
    {
        $heroStatProvider = new StaticPlayerStatsProvider(
            10,
            10,
            10,
            10,
            10
        );

        $monsterStatProvider = new StaticPlayerStatsProvider(
            10,
            10,
            10,
            10,
            10
        );

        $player1 = new Player("Player1");
        $player1->setStats($heroStatProvider);

        $player2 = new Player("Player2");
        $player2->setStats($monsterStatProvider);
        $priorityDeterminer = new PriorityDeterminer();

        $firstPlayer = $priorityDeterminer->getFirst($player1, $player2);

        $this->assertContains($firstPlayer, [$player1, $player2]);
    }
}