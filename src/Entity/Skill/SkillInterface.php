<?php

namespace App\Entity\Skill;

use App\Service\Fight\Commentator\CommentatorInterface;
use App\Service\Fight\FightPlayer;

interface SkillInterface
{
    public function getName(): string;
    public function getMessage(): string;
    public function getProbability(): int;
    public function onAttack(FightPlayer $attacker, FightPlayer $defender, CommentatorInterface $commentator): void;
    public function onDefense(FightPlayer $attacker, FightPlayer $defender, CommentatorInterface $commentator, $damage = 0): int;
}