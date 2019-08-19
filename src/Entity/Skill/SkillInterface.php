<?php

namespace App\Entity\Skill;


interface SkillInterface
{
    public function canUseSkill();
    public function onAttack();
    public function onDefense();
}