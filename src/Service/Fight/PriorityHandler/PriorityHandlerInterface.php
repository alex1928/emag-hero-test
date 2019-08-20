<?php

namespace App\Service\Fight\PriorityHandler;

use App\Entity\Player\Player;

/**
 * Interface PriorityHandlerInterface
 * @package App\Service\Fight\PriorityHandler
 */
interface PriorityHandlerInterface
{
    /**
     * @param PriorityHandler $handler
     * @return PriorityHandler
     */
    public function setNext(PriorityHandler $handler) : PriorityHandler;

    /**
     * @param Player $player1
     * @param Player $player2
     * @return int|null
     */
    public function handle(Player $player1, Player $player2) : ?int;
}