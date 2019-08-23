<?php

namespace App\Service\Fight;

use App\Entity\Player\Player;
use App\Entity\Skill\SkillInterface;
use App\Service\Fight\Commentator\CommentatorInterface;


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
     * @var CommentatorInterface
     */
    private $commentator;

    /**
     * FightPlayer constructor.
     * @param Player $player
     * @param CommentatorInterface $commentator
     */
    public function __construct(Player $player, CommentatorInterface $commentator)
    {
        $this->player = $player;
        $this->commentator = $commentator;
    }

    /**
     * @param FightPlayer $defender
     */
    public function attack(FightPlayer $defender): void
    {
        $skills = $this->getPlayer()->getSkills();

        foreach ($skills as $skill) {
            if ($this->hasLuckToUse($skill)) {

                $skill->onAttack($this, $defender, $this->commentator);
            }
        }

        $this->hit($defender);
    }

    /**
     * @param FightPlayer $defender
     */
    public function hit(FightPlayer $defender): void
    {
        if(!$defender->isAlive()) {
            return;
        }

        if($defender->isLucky()) {

            $commentText = "{name} missed.";
            $this->commentator->addComment($commentText, $this->player, $defender->getPlayer());
            return;
        }

        $dmg = $this->calculateDamage($defender);
        $dmg = $defender->defend($this, $dmg);
        $defender->dealDamage($dmg);

        $commentText = "{name} hit opponent dealing {dmg} damage.";

        if($defender->getPlayer()->getStats()->getHealth() > 0) {
            $commentText .= " Opponent has {health_left} health left.";
        }

        $this->commentator->addComment($commentText, $this->player, $defender->getPlayer(), $dmg);
    }

    /**
     * @param FightPlayer $attacker
     * @param CommentatorInterface $commentator
     * @param $dmg
     * @return int
     */
    public function defend(FightPlayer $attacker, $dmg): int
    {
        foreach ($this->player->getSkills() as $skill) {
            if ($this->hasLuckToUse($skill)) {

                $dmg = $skill->onDefense($attacker, $this, $this->commentator, $dmg);
            }
        }

        return $dmg;
    }

    /**
     * @param FightPlayer $defender
     * @return int
     */
    private function calculateDamage(FightPlayer $defender): int
    {
        $dmg = $this->player->getStats()->getStrength() - $defender->getPlayer()->getStats()->getDefense();

        if ($dmg < 0) {
            $dmg = 0;
        }

        return $dmg;
    }

    /**
     * @param int $damage
     */
    public function dealDamage(int $damage): void
    {
        $health = $this->player->getStats()->getHealth() - $damage;

        if ($health < 0) {
            $health = 0;
        }

        $this->player->getStats()->setHealth($health);
    }

    /**
     * @return bool
     */
    public function isAlive(): bool
    {
        return $this->player->getStats()->getHealth() > 0;
    }

    /**
     * @return bool
     */
    public function isLucky(): bool
    {
        return rand(0, 100) <= $this->player->getStats()->getLuck();
    }

    /**
     * @param SkillInterface $skill
     * @return bool
     */
    public function hasLuckToUse(SkillInterface $skill): bool
    {
        return rand(0, 100) <= $skill->getProbability();
    }

    /**
     * @return Player
     */
    public function getPlayer(): Player
    {
        return $this->player;
    }
}