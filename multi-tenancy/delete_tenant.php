<?php
require_once 'config.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$error = '';

if ($id <= 0) {
    header('Location: admin.php');
    exit;
}

try {
    // Ottieni info del tenant
    $stmt = $pdo->prepare("SELECT * FROM tenants WHERE id = ?");
    $stmt->execute([$id]);
    $tenant = $stmt->fetch();
    
    if (!$tenant) {
        header('Location: admin.php');
        exit;
    }
    
    $dbName = $tenant['db_name'];
    $tenantName = $tenant['name'];
    
    // Inizia transazione
    $pdo->beginTransaction();
    
    // 1. Elimina il database fisico
    $pdo->exec("DROP DATABASE IF EXISTS `$dbName`");
    
    // 2. Elimina il record dal DB master
    $stmt = $pdo->prepare("DELETE FROM tenants WHERE id = ?");
    $stmt->execute([$id]);
    
    // 3. Commit transazione
    $pdo->commit();
    
    $_SESSION['message'] = "Tenant '$tenantName' eliminato con successo";
    $_SESSION['message_type'] = 'success';
    
} catch (PDOException $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    $error = "Errore durante l'eliminazione: " . $e->getMessage();
    $_SESSION['message'] = $error;
    $_SESSION['message_type'] = 'error';
}

header('Location: admin.php');
exit;
?>