<?php

namespace App\Service\Fight\PriorityDeterminer\PriorityHandler;

use App\Entity\Player\PlayerStats;

/**
 * Class RandomPriorityComparator
 * @package App\Service\Fight\PriorityComparator
 */
class RandomPriorityComparator extends PriorityComparator
{
    /**
     * @param PlayerStats $stats1
     * @param PlayerStats $stats2
     * @return bool
     */
    public function compare(PlayerStats $stats1, PlayerStats $stats2): bool
    {
        return rand(0, 1) ? true : false;
    }
}