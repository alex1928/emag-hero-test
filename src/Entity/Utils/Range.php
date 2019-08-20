<?php

namespace App\Entity\Utils;


/**
 * Class Range
 * @package App\Entity\Utils
 */
class Range
{
    /**
     * @var int
     */
    private $min;
    /**
     * @var int
     */
    private $max;

    /**
     * Range constructor.
     * @param int $min
     * @param int $max
     */
    public function __construct(int $min, int $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @return int
     */
    public function getMin(): int
    {
        return $this->min;
    }

    /**
     * @param $min
     */
    public function setMin($min): void
    {
        $this->min = $min;
    }

    /**
     * @return int
     */
    public function getMax(): int
    {
        return $this->max;
    }

    /**
     * @param $max
     */
    public function setMax($max): void
    {
        $this->max = $max;
    }

    /**
     * @return int
     */
    public function getRand(): int
    {
        return rand($this->getMin(), $this->getMax());
    }
}