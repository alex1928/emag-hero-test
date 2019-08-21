<?php

namespace App\Service\Fight\PriorityDeterminer;

use App\Entity\Player\Player;
use App\Service\Fight\PriorityDeterminer\PriorityHandler\LuckPriorityHandler;
use App\Service\Fight\PriorityDeterminer\PriorityHandler\RandomPriorityHandler;
use App\Service\Fight\PriorityDeterminer\PriorityHandler\SpeedPriorityHandler;

/**
 * Class PriorityDeterminer
 * @package App\Service\Fight\PriorityDeterminer
 */
class PriorityDeterminer implements PriorityDeterminerInterface
{
    /**
     * @var SpeedPriorityHandler
     */
    private $speedPriorityHandler;
    /**
     * @var LuckPriorityHandler
     */
    private $luckPriorityHandler;
    /**
     * @var RandomPriorityHandler
     */
    private $randomPriorityHandler;

    /**
     * PriorityDeterminer constructor.
     */
    public function __construct()
    {
        $this->speedPriorityHandler = new SpeedPriorityHandler();
        $this->luckPriorityHandler = new LuckPriorityHandler();
        $this->randomPriorityHandler = new RandomPriorityHandler();

        $this->speedPriorityHandler->setNext($this->luckPriorityHandler)->setNext($this->randomPriorityHandler);
    }

    /**
     * @param Player $player1
     * @param Player $player2
     * @return Player
     */
    public function getFirst(Player $player1, Player $player2): Player
    {
        $result = $this->speedPriorityHandler->handle($player1, $player2);

        return $result ? $player1 : $player2;
    }
}