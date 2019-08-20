<?php

namespace App\Service\Fight;

use App\Entity\Player\Player;
use App\Entity\Skill\SkillInterface;
use App\Service\Fight\Commentator\Commentator;

/**
 * Class FightPlayer
 * @package App\Service\Fight
 */
class FightPlayer
{
    /**
     * @var Player
     */
    private $player;

    /**
     * FightPlayer constructor.
     * @param Player $player
     */
    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    /**
     * @return bool
     */
    public function isAlive()
    {
        return $this->player->getHealth() > 0;
    }

    /**
     * @return bool
     */
    public function isLucky()
    {
        return rand(0, 100) <= $this->player->getLuck();
    }

    /**
     * @param FightPlayer $defender
     * @param Commentator $commentator
     */
    public function attack(FightPlayer $defender, Commentator $commentator)
    {
        foreach($this->getPlayer()->getSkills() as $skill) {
            if($this->hasLuckToUse($skill)) {

                $skill->onAttack($this, $defender, $commentator);
            }
        }

        $this->hit($defender, $commentator);
    }

    /**
     * @param FightPlayer $defender
     * @param Commentator $commentator
     */
    public function hit(FightPlayer $defender, Commentator $commentator)
    {
        if(!$defender->isAlive()) {
            return;
        }

        if($defender->isLucky()) {

            $commentText = "{name} missed.";
            $commentator->addComment($commentText, $this->player, $defender->getPlayer());
            return;
        }

        $dmg = $this->getDmg($defender);
        $dmg = $defender->defend($this, $commentator, $dmg);
        $defender->dealDamage($dmg);

        $commentText = "{name} hit opponent dealing {dmg} damage.";
        $commentator->addComment($commentText, $this->player, $defender->getPlayer(), $dmg);
    }

    /**
     * @param FightPlayer $attacker
     * @param Commentator $commentator
     * @param $dmg
     * @return int
     */
    public function defend(FightPlayer $attacker, Commentator $commentator, $dmg) : int
    {
        foreach($this->player->getSkills() as $skill) {
            if($this->hasLuckToUse($skill)) {

                $dmg = $skill->onDefense($attacker, $this, $commentator, $dmg);
            }
        }

        return $dmg;
    }

    /**
     * @param FightPlayer $defender
     * @return int|mixed
     */
    private function getDmg(FightPlayer $defender)
    {
        $dmg = $this->player->getStrength() - $defender->getPlayer()->getDefense();

        if($dmg < 0)
            $dmg = 0;

        return $dmg;
    }

    /**
     * @param int $damage
     */
    public function dealDamage(int $damage)
    {
        $health = $this->player->getHealth() - $damage;

        if($health < 0) {
            $health = 0;
        }

        $this->player->setHealth($health);
    }

    /**
     * @param SkillInterface $skill
     * @return bool
     */
    public function hasLuckToUse(SkillInterface $skill)
    {
        return rand(0, 100) <= $skill->getProbability();
    }

    /**
     * @return Player
     */
    public function getPlayer()
    {
        return $this->player;
    }
}