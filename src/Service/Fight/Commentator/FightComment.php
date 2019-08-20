<?php

namespace App\Service\Fight\Commentator;


/**
 * Class FightComment
 * @package App\Service\Fight\Commentator
 */
class FightComment
{

    /**
     * @var string
     */
    private $playerName;
    /**
     * @var string
     */
    private $text;
    /**
     * @var int
     */
    private $dmg = 0;
    /**
     * @var int
     */
    private $healthLeft = 0;

    /**
     * FightComment constructor.
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getPlayerName(): string
    {
        return $this->playerName;
    }

    /**
     * @param $playerName
     */
    public function setPlayerName(string $playerName): void
    {
        $this->playerName = $playerName;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }

    /**
     * @return int
     */
    public function getDmg(): int
    {
        return $this->dmg;
    }

    /**
     * @param $dmg
     */
    public function setDmg($dmg): void
    {
        $this->dmg = $dmg;
    }

    /**
     * @return int
     */
    public function getHealthLeft(): int
    {
        return $this->healthLeft;
    }

    /**
     * @param $healthLeft
     */
    public function setHealthLeft($healthLeft): void
    {
        $this->healthLeft = $healthLeft;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->text;
    }

}