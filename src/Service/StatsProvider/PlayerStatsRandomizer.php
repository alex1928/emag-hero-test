<?php

namespace App\Service\StatsProvider;

use App\Entity\Utils\Range;


/**
 * Class PlayerStatsRandomizer
 * @package App\Service
 */
class PlayerStatsRandomizer implements PlayerStatsProviderInterface
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
     * PlayerStatsRandomizer constructor.
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
    public function getHealth()
    {
        return $this->randStat($this->healthRange);
    }

    /**
     * @return int
     */
    public function getStrength()
    {
        return $this->randStat($this->strengthRange);
    }

    /**
     * @return int
     */
    public function getDefence()
    {
        return $this->randStat($this->defenceRange);
    }

    /**
     * @return int
     */
    public function getSpeed()
    {
        return $this->randStat($this->speedRange);
    }

    /**
     * @return int
     */
    public function getLuck()
    {
        return $this->randStat($this->luckRange);
    }

    /**
     * @param Range $range
     * @return int
     */
    private function randStat(Range $range) : int
    {
        return rand($range->getMin(), $range->getMax());
    }

    /**
     * @return Range
     */
    public function getHealthRange()
    {
        return $this->healthRange;
    }

    /**
     * @param Range $healthRange
     */
    public function setHealthRange($healthRange)
    {
        $this->healthRange = $healthRange;
    }

    /**
     * @return Range
     */
    public function getStrengthRange()
    {
        return $this->strengthRange;
    }

    /**
     * @param Range $strengthRange
     */
    public function setStrengthRange($strengthRange)
    {
        $this->strengthRange = $strengthRange;
    }

    /**
     * @return Range
     */
    public function getDefenceRange()
    {
        return $this->defenceRange;
    }

    /**
     * @param Range $defenceRange
     */
    public function setDefenceRange($defenceRange)
    {
        $this->defenceRange = $defenceRange;
    }

    /**
     * @return Range
     */
    public function getSpeedRange()
    {
        return $this->speedRange;
    }

    /**
     * @param Range $speedRange
     */
    public function setSpeedRange($speedRange)
    {
        $this->speedRange = $speedRange;
    }

    /**
     * @return Range
     */
    public function getLuckRange()
    {
        return $this->luckRange;
    }

    /**
     * @param Range $luckRange
     */
    public function setLuckRange($luckRange)
    {
        $this->luckRange = $luckRange;
    }
}