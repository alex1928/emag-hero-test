<?php

namespace App\Service\Fight\PriorityHandler;

use App\Entity\Player\Player;

/**
 * Class PriorityHandler
 * @package App\Service\Fight\PriorityHandler
 */class PriorityHandler implements PriorityHandlerInterface
{
    /**
     * @var PriorityHandler
     */
    private $nextHandler;

    /**
     * @param PriorityHandler $handler
     * @return PriorityHandler
     */
    public function setNext(PriorityHandler $handler): PriorityHandler
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    /**
     * @param Player $player1
     * @param Player $player2
     * @return int|null
     */
    public function handle(Player $player1, Player $player2): ?int
    {
        if($this->nextHandler) {
            return $this->nextHandler->handle($player1, $player2);
        }

        return null;
    }
}