<?php

namespace App\Service\Fight\PriorityDeterminer\PriorityHandler;

use App\Entity\Player\PlayerStats;

/**
 * Class PriorityComparator
 * @package App\Service\Fight\PriorityComparator
 */class PriorityComparator implements PriorityComparatorInterface
{
    /**
     * @var PriorityComparator
     */
    private $nextHandler;

    /**
     * @param PriorityComparator $comparator
     * @return PriorityComparator
     */
    public function setNext(PriorityComparator $comparator): PriorityComparator
    {
        $this->nextHandler = $comparator;
        return $comparator;
    }

    /**
     * @param PlayerStats $stats1
     * @param PlayerStats $stats2
     * @return int|null
     */
    public function compare(PlayerStats $stats1, PlayerStats $stats2): ?int
    {
        if ($this->nextHandler) {
            return $this->nextHandler->compare($stats1, $stats2);
        }

        return null;
    }
}