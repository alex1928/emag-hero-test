<?php

namespace App\Service\Fight;

use App\Entity\Player\Player;
use App\Entity\Skill\SkillInterface;
use App\Entity\Utils\RandGenerator;
use App\Entity\Utils\RandGeneratorInterface;
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
     * @var RandGenerator
     */
    private $luckRandGenerator;

    /**
     * FightPlayer constructor.
     * @param Player $player
     * @param CommentatorInterface $commentator
     * @param RandGeneratorInterface $luckRandGenerator
     */
    public function __construct(Player $player, CommentatorInterface $commentator, RandGeneratorInterface $luckRandGenerator)
    {
        $this->player = $player;
        $this->commentator = $commentator;
        $this->luckRandGenerator = $luckRandGenerator;
    }

    /**
     * @param FightPlayer $defender
     */
    public function attack(FightPlayer $defender): void
    {
        $skills = $this->getPlayer()->getSkills();

        foreach ($skills as $skill) {
            if ($this->hasLuckToUse($skill, $this->luckRandGenerator)) {

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
        if (!$defender->isAlive()) {
            return;
        }

        if ($defender->isLucky($this->luckRandGenerator)) {

            $commentText = "{$this->player->getName()} missed.";
            $this->commentator->addTextComment($commentText);
            return;
        }

        $damage = $this->calculateDamage($defender);
        $damage = $defender->defend($this,  $damage);
        $defender->dealDamage($damage);

        $this->commentHit($defender, $damage);
    }

    /**
     * @return bool
     */
    public function isAlive(): bool
    {
        $playerStats = $this->player->getStats();

        return $playerStats->getHealth() > 0;
    }

    /**
     * @param RandGenerator $randGenerator
     * @return bool
     */
    private function isLucky(RandGenerator $randGenerator): bool
    {
        $luck = $this->player->getStats()->getLuck();

        return $randGenerator->rand(0, 100) <= $luck;
    }

    /**
     * @param FightPlayer $defender
     * @return int
     */
    private function calculateDamage(FightPlayer $defender): int
    {
        $attackerStats = $this->player->getStats();
        $defenderStats = $defender->getPlayer()->getStats();

        if ($defenderStats->getDefense() >= $attackerStats->getStrength()) {
            return 0;
        }

        $damage = $attackerStats->getStrength() - $defenderStats->getDefense();

        return $damage;
    }

    /**
     * @param FightPlayer $attacker
     * @param $damage
     * @return int
     */
    public function defend(FightPlayer $attacker, int $damage): int
    {
        $playerSkills = $this->player->getSkills();

        foreach ($playerSkills as $skill) {
            $damage = $this->tryUseSkill($skill, $attacker, $damage);
        }

        return $damage;
    }

    /**
     * @param $skill
     * @param FightPlayer $attacker
     * @param $damage
     * @return int
     */
    private function tryUseSkill(SkillInterface $skill, FightPlayer $attacker, int $damage): int
    {
        if ($this->hasLuckToUse($skill, $this->luckRandGenerator)) {

            $damage = $skill->onDefense($attacker, $this, $this->commentator, $damage);
        }
        return $damage;
    }

    /**
     * @param SkillInterface $skill
     * @param RandGenerator $randGenerator
     * @return bool
     */
    private function hasLuckToUse(SkillInterface $skill, RandGenerator $randGenerator): bool
    {
        $skillProbability = $skill->getProbability();

        return $randGenerator->rand(0, 100) <= $skillProbability;
    }

    /**
     * @param int $damage
     */
    private function dealDamage(int $damage): void
    {
        $health = $this->player->getStats()->getHealth() - $damage;

        if ($health < 0) {
            $health = 0;
        }

        $this->player->getStats()->setHealth($health);
    }

    /**
     * @param FightPlayer $defender
     * @param int $damage
     */
    private function commentHit(FightPlayer $defender, int $damage): void
    {
        $defenderStats = $defender->getPlayer()->getStats();
        $defenderHealthLeft = $defenderStats->getHealth();

        $commentText = "{$this->player->getName()} hit opponent dealing {$damage} damage.";

        if ($defenderHealthLeft > 0) {
            $commentText .= " Opponent has {$defenderHealthLeft} health left.";
        }

        $this->commentator->addTextComment($commentText);
    }

    /**
     * @return Player
     */
    public function getPlayer(): Player
    {
        return $this->player;
    }
}