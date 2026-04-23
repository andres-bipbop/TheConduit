<?php
session_start();

// Configurazione database
define('DB_HOST', 'localhost');
define('DB_USER', 'admin_andres');
define('DB_PASS', 'root');
define('DB_MAIN', 'main_db');
define('DB_TEMPLATE', 'tenant_template');

// Gestione errori
error_reporting(E_ALL);
ini_set('display_errors', 0); // 0 in produzione, 1 in sviluppo

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_MAIN . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch (PDOException $e) {
    die("Errore di connessione al database: " . $e->getMessage());
}

// Funzione helper per ottenere connessione a un DB tenant
function getTenantConnection($dbName) {
    try {
        return new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . $dbName . ";charset=utf8mb4",
            DB_USER,
            DB_PASS,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    } catch (PDOException $e) {
        return null; // Database non esiste o errore connessione
    }
}

// Sanitizzazione nome database
function sanitizeDbName($name) {
    $name = strtolower(trim($name));
    $name = preg_replace('/[^a-z0-9_]/', '_', $name);
    $name = preg_replace('/_{2,}/', '_', $name);
    return 'tenant_' . $name;
}
?>