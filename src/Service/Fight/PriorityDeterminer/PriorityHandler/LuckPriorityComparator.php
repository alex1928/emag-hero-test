<?php

namespace App\Service\Fight\PriorityDeterminer\PriorityHandler;

use App\Entity\Player\PlayerStats;

/**
 * Class LuckPriorityComparator
 * @package App\Service\Fight\PriorityComparator
 */
class LuckPriorityComparator extends PriorityComparator
{

    /**
     * @param PlayerStats $stats1
     * @param PlayerStats $stats2
     * @return bool
     */
    public function compare(PlayerStats $stats1, PlayerStats $stats2): bool
    {
        if ($stats1->getLuck() != $stats2->getLuck()) {
            return $stats1->getLuck() > $stats2->getLuck();
        }

        return parent::compare($stats1, $stats2);
    }
}