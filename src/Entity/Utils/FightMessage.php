<?php

namespace App\Entity\Utils;

class FightMessage
{
    private $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function __toString() : string
    {
        return $this->message;
    }

    public function getMessage()
    {
        return $this->message;
    }
}