<?php

namespace App\Service\Fight\PriorityHandler;

use App\Entity\Player\Player;

abstract class PriorityHandler implements PriorityHandlerInterface
{
    private $nextHandler;

    public function setNext(PriorityHandler $handler): PriorityHandler
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function handle(Player $player1, Player $player2): ?int
    {
        if($this->nextHandler) {
            return $this->nextHandler->handle($player1, $player2);
        }

        return null;
    }


}