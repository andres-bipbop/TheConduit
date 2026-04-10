<?php
    require_once __DIR__ . "/../config/Database.php";

    class SpaceEndpoints {

        private PDO $pdo;

        public function __construct()
        {
            $this->pdo = Database::getConnection();
        }

        public function createSpace($name, $iconUrl, $bannerUrl, $description, $maxMembers) {
            $stmt = $this->pdo->prepare("INSERT INTO app_spaces (name, iconUrl, bannerUrl, description, maxMembers) VALUES (?, ?, ?, ?, ?)");
            $stmt->bindValue(1, $name, PDO::PARAM_STR);
            $stmt->bindValue(2, $iconUrl, PDO::PARAM_STR);
            $stmt->bindValue(3, $bannerUrl, PDO::PARAM_STR);
            $stmt->bindValue(4, $description, PDO::PARAM_STR);
            $stmt->bindValue(5, $maxMembers, PDO::PARAM_INT);
            $stmt->execute();
            return $this->pdo->lastInsertId();
        }

        public function getMembers($spaceId) {
            $stmt = $this->pdo->prepare("SELECT * FROM getSpaceMembers WHERE space_id = ? ORDER BY joinedAt ASC");
            $stmt->bindValue(1, $spaceId, PDO::PARAM_INT);
            $stmt->execute();
            $members = $stmt->fetchAll();
            return $members;
        }
    }
?>