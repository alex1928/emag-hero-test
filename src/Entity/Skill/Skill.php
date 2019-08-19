<?php

namespace App\Entity\Skill;

abstract class Skill implements SkillInterface
{
    protected $name;

    protected $message;

    protected $propability;

    public function canUseSkill()
    {
        return rand(0, 100) <= $this->propability;
    }
}