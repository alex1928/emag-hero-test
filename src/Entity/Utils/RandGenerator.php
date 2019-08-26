<?php

namespace App\Entity\Utils;

/**
 * Class RandGenerator
 * @package App\Entity\Utils
 */
class RandGenerator implements RandGeneratorInterface
{
    /**
     * @param int $min
     * @param int $max
     * @return int
     */
    public function rand(int $min, int $max): int
    {
        return rand($min, $max);
    }
}