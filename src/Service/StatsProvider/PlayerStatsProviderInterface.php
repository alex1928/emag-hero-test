<?php

namespace App\Service\StatsProvider;

interface PlayerStatsProviderInterface
{
    public function getHealth(): int;
    public function getStrength(): int;
    public function getDefence(): int;
    public function getSpeed(): int;
    public function getLuck(): int;
}