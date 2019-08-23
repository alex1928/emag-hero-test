<?php

namespace App\Entity\Utils;

class RandGenerator implements RandGeneratorInterface
{
    public function rand(int $min, int $max): int
    {
        return rand($min, $max);
    }
}