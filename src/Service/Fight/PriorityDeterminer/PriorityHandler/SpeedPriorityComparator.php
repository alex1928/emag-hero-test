<?php

namespace App\Service\Fight\PriorityDeterminer\PriorityHandler;

use App\Entity\Player\PlayerStats;

/**
 * Class SpeedPriorityComparator
 * @package App\Service\Fight\PriorityComparator
 */
class SpeedPriorityComparator extends PriorityComparator
{
    /**
     * @param PlayerStats $stats1
     * @param PlayerStats $stats2
     * @return int|null
     */
    public function compare(PlayerStats $stats1, PlayerStats $stats2): ?int
    {
        if ($stats1->getSpeed() != $stats2->getSpeed()) {
            return $stats1->getSpeed() > $stats2->getSpeed();
        }

        return parent::compare($stats1, $stats2);
    }
}