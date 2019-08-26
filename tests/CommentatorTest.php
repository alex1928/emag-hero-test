<?php

use App\Service\Fight\Commentator\AugmentedComment;
use App\Service\Fight\Commentator\BasicComment;
use App\Service\Fight\Commentator\Commentator;
use PHPUnit\Framework\TestCase;

class CommentatorTest extends TestCase
{
    private $commentator;

    protected function setUp()
    {
        $this->commentator = new Commentator();
    }

    public function testAddingTextComment()
    {
        $this->commentator->addTextComment("test comment");

        $this->assertContains("test comment", $this->commentator->getComments());
    }

    public function testAddingBasicComment()
    {
        $comment = new BasicComment("test comment");
        $this->commentator->addComment($comment);

        $this->assertContains("test comment", $this->commentator->getComments());
    }

    public function testAddingAugmentedComment()
    {
        $someInt = 5;
        $someString = "test string";
        $correctResult = "test comment {$someInt}, {$someString}";

        $comment = new AugmentedComment("test comment {int}, {string}", [
            "int" => $someInt,
            "string" => $someString,
        ]);

        $this->commentator->addComment($comment);

        $this->assertContains($correctResult, $this->commentator->getComments());
    }

    public function testAddingMultipleComments()
    {
        $this->commentator->addTextComment("first comment");
        $this->commentator->addTextComment("second comment");

        $this->assertCount(2, $this->commentator->getComments());
    }
}