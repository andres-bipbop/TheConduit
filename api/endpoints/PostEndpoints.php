<?php
    require_once __DIR__ . "/../config/Database.php";

    class PostEndpoints {

        private PDO $pdo;

        public function __construct()
        {
            $this->pdo = Database::getConnection();
        }

        public function getCustomPosts($id) {
            $stmt = $this->pdo->prepare("SELECT * FROM getCustomPosts WHERE user_id = ? ORDER BY matchCount DESC, postLikes DESC, postDate DESC LIMIT 500");
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            $posts = $stmt->fetchAll();
            return $posts;
        }

        public function getFollowedFeed($user_id) {
            $stmt = $this->pdo->prepare("SELECT * FROM getFollowedFeed WHERE user_id = ? ORDER BY postedAt DESC LIMIT 500");
            $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $posts = $stmt->fetchAll();
            return $posts;
        }

        public function getPostsBySpace($space_id) {
            $stmt = $this->pdo->prepare("SELECT * FROM getPostsBySpace WHERE space_id = ? ORDER BY postedAt DESC LIMIT 500");
            $stmt->bindValue(1, $space_id, PDO::PARAM_INT);
            $stmt->execute();
            $posts = $stmt->fetchAll();
            return $posts;
        }

        public function getPostsByUser($user_id) {
            $stmt = $this->pdo->prepare("SELECT * FROM getPostsByUser WHERE userId = ? ORDER BY postDate DESC LIMIT 500");
            $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $posts = $stmt->fetchAll();
            return $posts;
        }

        public function createPost($user_id, $title, $description, $mediaFiles) {
            $stmt = $this->pdo->prepare("INSERT INTO app_posts (user_id, title, description, mediaFile_1, mediaFile_2, mediaFile_3, mediaFile_4, mediaFile_5) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
            $stmt->bindValue(2, $title, PDO::PARAM_STR);
            $stmt->bindValue(3, $description, PDO::PARAM_STR);
            $stmt->bindValue(4, $mediaFiles[0] ?? null, PDO::PARAM_STR);
            $stmt->bindValue(5, $mediaFiles[1] ?? null, PDO::PARAM_STR);
            $stmt->bindValue(6, $mediaFiles[2] ?? null, PDO::PARAM_STR);
            $stmt->bindValue(7, $mediaFiles[3] ?? null, PDO::PARAM_STR);
            $stmt->bindValue(8, $mediaFiles[4] ?? null, PDO::PARAM_STR);
            $stmt->execute();
            return $this->pdo->lastInsertId();
        }
    }
?>