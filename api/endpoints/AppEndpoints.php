<?php

require_once __DIR__ . '/../config/Database.php';

class AppEndpoints
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function getArguments($id): array
    {
        if ($id == null) {
            $stmt = $this->pdo->prepare('SELECT * FROM app_arguments');
        }
        else {
            $stmt = $this->pdo->prepare('SELECT * FROM app_arguments WHERE id = ?');
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
        }
        $stmt->execute();
        $arguments = $stmt->fetchAll();
        return $arguments;
    }
}

?>