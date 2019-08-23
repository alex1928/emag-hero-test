<?php

namespace App\Entity\Skill;

/**
 * Class SkillFactory
 * @package App\Entity\Skill
 */
class SkillFactory
{
    /**
     * @return SkillInterface
     */
    public function createHalfDamageSkill(): SkillInterface
    {
        return new HalfDamageSkill();
    }

    /**
     * @return SkillInterface
     */
    public function createStrikeTwiceSkill(): SkillInterface
    {
        return new StrikeTwiceSkill();
    }
}