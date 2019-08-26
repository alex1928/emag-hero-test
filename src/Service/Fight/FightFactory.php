<?php

namespace App\Service\Fight;

use App\Entity\Player\Player;
use App\Entity\Utils\RandGenerator;
use App\Entity\Utils\RandGeneratorInterface;
use App\Service\Fight\Commentator\CommentatorInterface;
use App\Service\Fight\PriorityDeterminer\PriorityDeterminerInterface;

/**
 * Class FightFactory
 * @package App\Service\Fight
 */
class FightFactory
{
    /**
     * @return FightInterface
     */
    public function createSparingFight(CommentatorInterface $commentator, PriorityDeterminerInterface $priorityDeterminer, RandGeneratorInterface $randGenerator) : FightInterface
    {
        return new SparingFight($commentator, $priorityDeterminer, $randGenerator);
    }
}