<?php

namespace App\Entity\Skill;


use App\Service\Fight\Commentator\Commentator;
use App\Service\Fight\FightPlayer;

interface SkillInterface
{
    public function getName();
    public function getMessage();
    public function getProbability();
    public function onAttack(FightPlayer $attacker, FightPlayer $defender, Commentator $commentator);
    public function onDefense(FightPlayer $attacker, FightPlayer $defender, Commentator $commentator, $dmg = 0) : int;
}