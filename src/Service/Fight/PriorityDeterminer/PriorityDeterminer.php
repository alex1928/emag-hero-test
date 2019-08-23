<?php

namespace App\Service\Fight\PriorityDeterminer;

use App\Entity\Player\Player;
use App\Service\Fight\PriorityDeterminer\PriorityHandler\LuckPriorityComparator;
use App\Service\Fight\PriorityDeterminer\PriorityHandler\RandomPriorityComparator;
use App\Service\Fight\PriorityDeterminer\PriorityHandler\SpeedPriorityComparator;

/**
 * Class PriorityDeterminer
 * @package App\Service\Fight\PriorityDeterminer
 */
class PriorityDeterminer implements PriorityDeterminerInterface
{
    /**
     * @var SpeedPriorityComparator
     */
    private $speedPriorityComparator;
    /**
     * @var LuckPriorityComparator
     */
    private $luckPriorityComparator;
    /**
     * @var RandomPriorityComparator
     */
    private $randomPriorityComparator;

    /**
     * PriorityDeterminer constructor.
     */
    public function __construct()
    {
        $this->speedPriorityComparator = new SpeedPriorityComparator();
        $this->luckPriorityComparator = new LuckPriorityComparator();
        $this->randomPriorityComparator = new RandomPriorityComparator();

        $this->speedPriorityComparator->setNext($this->luckPriorityComparator)->setNext($this->randomPriorityComparator);
    }

    /**
     * @param Player $player1
     * @param Player $player2
     * @return Player
     */
    public function getFirst(Player $player1, Player $player2): Player
    {
        $stats1 = $player1->getStats();
        $stats2 = $player2->getStats();

        $result = $this->speedPriorityComparator->compare($stats1, $stats2);

        return $result ? $player1 : $player2;
    }
}