<?php

namespace App\Entity\Utils;

interface RandGeneratorInterface
{
    public function rand(int $min, int $max);
}