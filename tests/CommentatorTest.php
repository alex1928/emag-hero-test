<?php

use App\Entity\Player\Player;
use App\Entity\Utils\Range;
use App\Service\Fight\Commentator\Commentator;
use App\Service\Fight\Commentator\HTMLFightCommentFormatter;
use App\Service\Fight\Commentator\TextFightCommentFormatter;
use App\Service\StatsProvider\StaticPlayerStatsProvider;
use PHPUnit\Framework\TestCase;

final class CommentatorTest extends TestCase
{
    private $hero;
    private $enemy;
    private $textCommentFormatter;
    private $htmlCommentFormatter;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $heroStatProvider = new StaticPlayerStatsProvider(
            10,
            15,
            20,
            25,
            30
        );
        $this->hero = new Player("Orderus");
        $this->hero->setStats($heroStatProvider);

        $enemyStatProvider = new StaticPlayerStatsProvider(
            10,
            15,
            20,
            25,
            30
        );
        $this->enemy = new Player("Enemy");
        $this->enemy->setStats($enemyStatProvider);

        $this->textCommentFormatter = new TextFightCommentFormatter();
        $this->htmlCommentFormatter = new HTMLFightCommentFormatter();

        parent::__construct($name, $data, $dataName);
    }

    public function testTextCommentator() : void
    {
        $commentator = new Commentator($this->textCommentFormatter);

        $commentator->addComment("test comment", $this->hero, $this->enemy, 10);
        $commentator->addComment("test comment {name} {dmg} {health_left}", $this->hero, $this->enemy, 10);

        $plainComments = $commentator->getPlainComments();
        $formattedComments = $commentator->getFormattedComments();

        $this->assertEquals(2, count($plainComments));
        $this->assertEquals(2, count($formattedComments));

        $this->assertEquals("test comment", (string)$plainComments[0]);
        $this->assertEquals("test comment {name} {dmg} {health_left}", (string)$plainComments[1]);

        $this->assertEquals("test comment<br>", (string)$formattedComments[0]);
        $this->assertEquals("test comment Orderus 10 10<br>", (string)$formattedComments[1]);

        ob_start();
        $commentator->printFormattedComments();
        $result = ob_get_clean();

        $this->assertEquals("test comment<br>test comment Orderus 10 10<br>", $result);
    }

    public function testHTMLCommentator() : void
    {
        $commentator = new Commentator($this->htmlCommentFormatter);

        $commentator->addComment("test comment", $this->hero, $this->enemy, 10);
        $commentator->addComment("test comment {name} {dmg} {health_left}", $this->hero, $this->enemy, 10);

        $plainComments = $commentator->getPlainComments();
        $formattedComments = $commentator->getFormattedComments();

        $this->assertEquals(2, count($plainComments));
        $this->assertEquals(2, count($formattedComments));

        $this->assertEquals("test comment", (string)$plainComments[0]);
        $this->assertEquals("test comment {name} {dmg} {health_left}", (string)$plainComments[1]);

        $this->assertEquals("<div><p>test comment</p></div>", (string)$formattedComments[0]);
        $this->assertEquals("<div><p>test comment <strong>Orderus</strong> <strong>10</strong> <strong>10</strong></p></div>", (string)$formattedComments[1]);

        ob_start();
        $commentator->printFormattedComments();
        $result = ob_get_clean();

        $this->assertEquals("<div><p>test comment</p></div><div><p>test comment <strong>Orderus</strong> <strong>10</strong> <strong>10</strong></p></div>", $result);
    }
}