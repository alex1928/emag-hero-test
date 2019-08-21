<?php

use App\Entity\Player\Player;
use App\Entity\Utils\Range;
use App\Service\StatsProvider\RandomPlayerStatsProvider;
use App\Service\StatsProvider\StaticPlayerStatsProvider;
use PHPUnit\Framework\TestCase;

final class PlayerStatsProviderTest extends TestCase
{

    public function testRandomPlayerStats() : void
    {
        $heroStatProvider = new RandomPlayerStatsProvider(
            new Range(10, 15),
            new Range(10, 15),
            new Range(10, 15),
            new Range(10, 15),
            new Range(10, 15)
        );

        $hero = new Player("Orderus");
        $hero->setStats($heroStatProvider);

        $this->assertThat(
            $hero->getHealth(),
            $this->logicalAnd(
                $this->greaterThanOrEqual(10),
                $this->lessThanOrEqual(15)
            )
        );

        $this->assertThat(
            $hero->getStrength(),
            $this->logicalAnd(
                $this->greaterThanOrEqual(10),
                $this->lessThanOrEqual(15)
            )
        );

        $this->assertThat(
            $hero->getDefense(),
            $this->logicalAnd(
                $this->greaterThanOrEqual(10),
                $this->lessThanOrEqual(15)
            )
        );

        $this->assertThat(
            $hero->getSpeed(),
            $this->logicalAnd(
                $this->greaterThanOrEqual(10),
                $this->lessThanOrEqual(15)
            )
        );

        $this->assertThat(
            $hero->getLuck(),
            $this->logicalAnd(
                $this->greaterThanOrEqual(10),
                $this->lessThanOrEqual(15)
            )
        );
    }

    public function testStaticPlayerStats() : void
    {
        $heroStatProvider = new StaticPlayerStatsProvider(
            10,
            15,
            20,
            25,
            30
        );

        $hero = new Player("Orderus");
        $hero->setStats($heroStatProvider);

        $this->assertEquals(10, $hero->getHealth());
        $this->assertEquals(15, $hero->getStrength());
        $this->assertEquals(20, $hero->getDefense());
        $this->assertEquals(25, $hero->getSpeed());
        $this->assertEquals(30, $hero->getLuck());

    }
}