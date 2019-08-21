<?php

use App\Entity\Utils\Range;
use PHPUnit\Framework\TestCase;

final class RangeTest extends TestCase
{

    public function testRange() : void
    {
        $range = new Range(10, 15);
        $min = $range->getMin();
        $max = $range->getMax();
        $randRange = $range->getRand();

        $this->assertEquals(10, $min);
        $this->assertEquals(15, $max);
        $this->assertThat(
            $randRange,
            $this->logicalAnd(
                $this->greaterThanOrEqual(10),
                $this->lessThanOrEqual(15)
            )
        );
    }
}