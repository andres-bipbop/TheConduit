<?php
    require_once __DIR__ . "/../config/Database.php";

    class UsersEndpoints {

        private PDO $pdo;

        public function __construct()
        {
            $this->pdo = Database::getConnection();
        }

        public function getUserLoginData($username) {
            $stmt = $this->pdo->prepare("SELECT id, username, password, status FROM app_users WHERE username = ?");
            $stmt->bindValue(1, $username, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch();
            return $user;
        }

        public function getUserData($user_id) {
            $stmt = $this->pdo->prepare("SELECT * FROM app_users WHERE id = ?");
            $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $user_data = $stmt->fetch();
            return $user_data;
        }

        public function getUserSpaces($user_id) {
            $stmt = $this->pdo->prepare("SELECT s.* FROM getMembersBySpace gm LEFT JOIN app_spaces s ON gm.space_id = s.id WHERE gm.user_id = ?");
            $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $spaces = $stmt->fetchAll();
            return $spaces;
        }

        public function getUserInterests($user_id) {
            $stmt = $this->pdo->prepare("SELECT a.id, a.name, a.area FROM app_users_arguments ua JOIN app_arguments a ON ua.argument_id = a.id WHERE ua.user_id = ?");
            $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $arguments = $stmt->fetchAll();
            return $arguments;
        }

        public function getUserFollowers($user_id) {
            $stmt = $this->pdo->prepare("SELECT f.followed_id AS user_id, u.username FROM app_followers f JOIN app_users u ON f.followed_id = u.id WHERE f.follower_id = ?");
            $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $data = $stmt->fetchAll();
            return $data;
        }
    }
?>