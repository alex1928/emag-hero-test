<?php

use App\Entity\Player\Player;
use App\Entity\Utils\Range;
use App\Service\StatsProvider\PlayerStatsRandomizer;
use PHPUnit\Framework\TestCase;

final class PlayerStatsProviderTest extends TestCase
{

    public function testRandomPlayerStats() : void
    {
        $heroStatProvider = new PlayerStatsRandomizer(
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
}