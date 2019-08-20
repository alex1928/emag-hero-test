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
    public function getMin()
    {
        return $this->min;
    }

    /**
     * @param int $min
     */
    public function setMin($min)
    {
        $this->min = $min;
    }

    /**
     * @return int
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * @param int $max
     */
    public function setMax($max)
    {
        $this->max = $max;
    }


}