<?php

namespace App\Service\StatsProvider;

interface PlayerStatsProviderInterface
{
    public function getHealth();
    public function getStrength();
    public function getDefence();
    public function getSpeed();
    public function getLuck();
}