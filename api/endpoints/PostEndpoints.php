<?php
    require_once __DIR__ . "/../config/Database.php";

    class PostEndpoints {

        private PDO $pdo;

        public function __construct()
        {
            $this->pdo = Database::getConnection();
        }

        public function getCustomPosts($id) {
            $stmt = $this->pdo->prepare("SELECT * FROM getPersonalizedFeed WHERE user_id = ? ORDER BY match_score DESC, likes DESC, postedAt DESC LIMIT 500");
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
            $stmt = $this->pdo->prepare("SELECT * FROM getPostsByUser WHERE user_id = ? ORDER BY postedAt DESC LIMIT 500");
            $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $posts = $stmt->fetchAll();
            return $posts;
        }
    }
?>