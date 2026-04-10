<?php

require_once __DIR__ . '/../config/Database.php';

class CommentEndpoints
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function getCommentsByPost(int $postId): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM getCommentsByPost WHERE post_id = :post_id ORDER BY likes DESC, sentAt ASC');
        $stmt->bindValue(1, $postId, PDO::PARAM_INT);
        $stmt->execute();
        $comments = $stmt->fetchAll();
        return $comments;
    }

    public function getCommentReplies(int $commentId): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM getCommentReplies WHERE parent_comment_id = :comment_id ORDER BY likes DESC, sentAt ASC');
        $stmt->bindValue(1, $commentId, PDO::PARAM_INT);
        $stmt->execute();
        $replies = $stmt->fetchAll();
        return $replies;
    }
}