<?php

use App\Service\Fight\Commentator\AugmentedComment;
use App\Service\Fight\Commentator\BasicComment;
use PHPUnit\Framework\TestCase;

class CommentsTest extends TestCase
{
    public function testBasicCommentOutput()
    {
        $commentText = "test comment text";
        $basicComment = new BasicComment($commentText);

        $this->assertEquals($commentText, $basicComment);
        $this->assertEquals($commentText, $basicComment->getText());
    }

    public function testAugmentedCommentOutput()
    {
        $someInt = 5;
        $someString = "test string";
        $correctOutput = "int: {$someInt}, string: {$someString}";

        $augmentedComment = new AugmentedComment("int: {int}, string: {string}", [
            "int" => $someInt,
            "string" => $someString,
        ]);

        $this->assertEquals($correctOutput, $augmentedComment);
        $this->assertEquals($correctOutput, $augmentedComment->getText());
    }
}