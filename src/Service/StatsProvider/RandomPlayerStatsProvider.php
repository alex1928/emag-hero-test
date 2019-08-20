<?php

namespace App\Service\StatsProvider;

use App\Entity\Utils\Range;


/**
 * Class PlayerStatsRandomizer
 * @package App\Service
 */
class RandomPlayerStatsProvider implements PlayerStatsProviderInterface
{
    /**
     * @var Range
     */
    private $healthRange;
    /**
     * @var Range
     */
    private $strengthRange;
    /**
     * @var Range
     */
    private $defenceRange;
    /**
     * @var Range
     */
    private $speedRange;
    /**
     * @var Range
     */
    private $luckRange;

    /**
     * RandomPlayerStatsProvider constructor.
     * @param Range $healthRange
     * @param Range $strengthRange
     * @param Range $defenceRange
     * @param Range $speedRange
     * @param Range $luckRange
     */
    public function __construct(
        Range $healthRange,
        Range $strengthRange,
        Range $defenceRange,
        Range $speedRange,
        Range $luckRange)
    {
        $this->healthRange = $healthRange;
        $this->strengthRange = $strengthRange;
        $this->defenceRange = $defenceRange;
        $this->speedRange = $speedRange;
        $this->luckRange = $luckRange;
    }

    /**
     * @return int
     */
    public function getHealth(): int
    {
        return $this->healthRange->getRand();
    }

    /**
     * @return int
     */
    public function getStrength(): int
    {
        return $this->strengthRange->getRand();
    }

    /**
     * @return int
     */
    public function getDefence(): int
    {
        return $this->defenceRange->getRand();
    }

    /**
     * @return int
     */
    public function getSpeed(): int
    {
        return $this->speedRange->getRand();
    }

    /**
     * @return int
     */
    public function getLuck(): int
    {
        return $this->luckRange->getRand();
    }

    /**
     * @return Range
     */
    public function getHealthRange(): Range
    {
        return $this->healthRange;
    }

    /**
     * @param $healthRange
     */
    public function setHealthRange($healthRange): void
    {
        $this->healthRange = $healthRange;
    }

    /**
     * @return Range
     */
    public function getStrengthRange(): Range
    {
        return $this->strengthRange;
    }

    /**
     * @param $strengthRange
     */
    public function setStrengthRange($strengthRange): void
    {
        $this->strengthRange = $strengthRange;
    }

    /**
     * @return Range
     */
    public function getDefenceRange(): Range
    {
        return $this->defenceRange;
    }

    /**
     * @param $defenceRange
     */
    public function setDefenceRange($defenceRange): void
    {
        $this->defenceRange = $defenceRange;
    }

    /**
     * @return Range
     */
    public function getSpeedRange(): Range
    {
        return $this->speedRange;
    }

    /**
     * @param $speedRange
     */
    public function setSpeedRange($speedRange): void
    {
        $this->speedRange = $speedRange;
    }

    /**
     * @return Range
     */
    public function getLuckRange(): Range
    {
        return $this->luckRange;
    }

    /**
     * @param $luckRange
     */
    public function setLuckRange($luckRange): void
    {
        $this->luckRange = $luckRange;
    }
}