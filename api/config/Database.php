<?php

require_once "config.php";

class Database
{
    private static ?PDO $instance = null;

    // Singleton: reuse the same connection across the request
    public static function getConnection(): PDO
    {
        if (self::$instance === null) {
            self::$instance = self::createConnection();
        }

        return self::$instance;
    }

    private static function createConnection(): PDO
    {
        $host   = DB_HOST ?? throw new RuntimeException('DB_HOST not set');
        $dbname = DB_NAME ?? throw new RuntimeException('DB_NAME not set');
        $user   = DB_USER ?? throw new RuntimeException('DB_USER not set');
        $pass   = DB_PASSWORD ?? throw new RuntimeException('DB_PASSWORD not set');
        $port   = '3306';

        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // throw exceptions on error
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // arrays by default
            PDO::ATTR_EMULATE_PREPARES => false, // use real prepared statements
        ];

        try {
            return new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            // Don't expose connection details in the message
            throw new RuntimeException('Database connection failed.', 0, $e);
        }
    }
}

?>