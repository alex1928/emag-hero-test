<?php

namespace App\Service\StatsProvider;


/**
 * Class StaticPlayerStatsProvider created mostly to allow easy fight testing
 * @package App\Service\StatsProvider
 */
class StaticPlayerStatsProvider implements PlayerStatsProviderInterface
{
    /**
     * @var int
     */
    private $health;
    /**
     * @var int
     */
    private $strength;
    /**
     * @var int
     */
    private $defence;
    /**
     * @var int
     */
    private $speed;
    /**
     * @var int
     */
    private $luck;

    /**
     * StaticPlayerStatsProvider constructor.
     * @param int $healthRange
     * @param int $strengthRange
     * @param int $defenceRange
     * @param int $speedRange
     * @param int $luckRange
     */
    public function __construct(
        int $healthRange,
        int $strengthRange,
        int $defenceRange,
        int $speedRange,
        int $luckRange)
    {
        $this->health = $healthRange;
        $this->strength = $strengthRange;
        $this->defence = $defenceRange;
        $this->speed = $speedRange;
        $this->luck = $luckRange;
    }

    /**
     * @return int
     */
    public function getHealth(): int
    {
        return $this->health;
    }

    /**
     * @return int
     */
    public function getStrength(): int
    {
        return $this->strength;
    }

    /**
     * @return int
     */
    public function getDefence(): int
    {
        return $this->defence;
    }

    /**
     * @return int
     */
    public function getSpeed(): int
    {
        return $this->speed;
    }

    /**
     * @return int
     */
    public function getLuck(): int
    {
        return $this->luck;
    }

}