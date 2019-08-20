<?php

namespace App\Entity\Skill;


use App\Service\Fight\Commentator\Commentator;
use App\Service\Fight\FightPlayer;

interface SkillInterface
{
    public function getName(): string;
    public function getMessage(): string;
    public function getProbability(): int;
    public function onAttack(FightPlayer $attacker, FightPlayer $defender, Commentator $commentator): void;
    public function onDefense(FightPlayer $attacker, FightPlayer $defender, Commentator $commentator, $dmg = 0): int;
}