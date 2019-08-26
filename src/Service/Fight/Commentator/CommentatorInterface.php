<?php

namespace App\Service\Fight\Commentator;

interface CommentatorInterface
{
    public function addComment(CommentInterface $comment): void;
    public function addTextComment(string $text): void;
    public function getComments(): array;
}