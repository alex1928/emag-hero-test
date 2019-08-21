<?php
require dirname(__DIR__).'/vendor/autoload.php';

use App\Entity\Player\Player;
use App\Service\StatsProvider\RandomPlayerStatsProvider;
use App\Entity\Utils\Range;
use App\Service\Fight\FightFactory;
use App\Service\Fight\PriorityDeterminer\PriorityDeterminer;
use App\Service\Fight\Commentator\Commentator;
use App\Service\Fight\Commentator\HTMLFightCommentFormatter;
//use App\Service\Fight\Commentator\TextFightCommentFormatter;
use App\Entity\Skill\StrikeTwiceSkill;
use App\Entity\Skill\HalfDamageSkill;


$heroStatProvider = new RandomPlayerStatsProvider(
    new Range(70, 100),
    new Range(70, 80),
    new Range(45, 55),
    new Range(40, 50),
    new Range(10, 30)
);

$monsterStatProvider = new RandomPlayerStatsProvider(
    new Range(60, 90),
    new Range(60, 90),
    new Range(40, 60),
    new Range(40, 60),
    new Range(25, 40)
);

$strikeTwiceSkill = new StrikeTwiceSkill();
$halfDamageSkill = new HalfDamageSkill();

$hero = new Player("Orderus");
$hero->setStats($heroStatProvider);
$hero->setSkills([$strikeTwiceSkill, $halfDamageSkill]);

$monster = new Player("Wild Beast");
$monster->setStats($monsterStatProvider);


$heroBeforeFight = clone $hero;
$monsterBeforeFight = clone $monster;


//$fightCommentFormatter = new TextFightCommentFormatter();
$fightCommentFormatter = new HTMLFightCommentFormatter();
$fightCommentator = new Commentator($fightCommentFormatter);
$priorityDeterminer = new PriorityDeterminer();

$fightFactory = new FightFactory($fightCommentator, $priorityDeterminer);
$sparingFight = $fightFactory->createSparingFight($hero, $monster);

$sparingFight->fight();

//very basic template.
require dirname(__DIR__).'/templates/index.php';