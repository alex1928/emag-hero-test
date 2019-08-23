<?php

namespace App\Entity\Player;

/**
 * Class PlayerStatsState
 * @package App\Entity\Player
 */
class PlayerStatsState
{
    /**
     * @var PlayerStats
     */
    private $stats;

    /**
     * PlayerStatsState constructor.
     * @param PlayerStats $stats
     */
    public function __construct(PlayerStats $stats)
    {
        $this->stats = new PlayerStats();
        $this->setStats($stats);
    }

    /**
     * @param PlayerStats $stats
     */
    public function setStats(PlayerStats $stats)
    {
        $this->stats->setHealth($stats->getHealth());
        $this->stats->setStrength($stats->getStrength());
        $this->stats->setDefense($stats->getDefense());
        $this->stats->setSpeed($stats->getSpeed());
        $this->stats->setLuck($stats->getLuck());
    }

    /**
     * @param PlayerStats $stats
     */
    public function getStats(PlayerStats $stats)
    {
        $stats->setHealth($this->stats->getHealth());
        $stats->setStrength($this->stats->getStrength());
        $stats->setDefense($this->stats->getDefense());
        $stats->setSpeed($this->stats->getSpeed());
        $stats->setLuck($this->stats->getLuck());
    }
}