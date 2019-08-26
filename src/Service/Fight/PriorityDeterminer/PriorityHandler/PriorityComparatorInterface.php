<?php

namespace App\Service\Fight\PriorityDeterminer\PriorityHandler;

use App\Entity\Player\PlayerStats;

interface PriorityComparatorInterface
{
    public function setNext(PriorityComparator $comparator) : PriorityComparator;
    public function compare(PlayerStats $stats1, PlayerStats $stats2) : bool;
}