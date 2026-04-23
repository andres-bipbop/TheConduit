<?php
require_once 'config.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$error = '';
$success = '';

$tablesWithData = [
    'app_arguments',
    'app_roles', 
    'app_permissions',
    'app_role_composition'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    
    if (empty($name)) {
        $error = 'Inserisci un nome per il tenant';
    } else {
        $dbName = sanitizeDbName($name);
        
        // Verifica se esiste già
        $stmt = $pdo->prepare("SELECT id FROM tenants WHERE name = ? OR db_name = ?");
        $stmt->execute([$name, $dbName]);
        
        if ($stmt->fetch()) {
            $error = 'Un tenant con questo nome esiste già';
        } else {
            try {
                // 1. Salva nel DB master
                $stmt = $pdo->prepare("INSERT INTO tenants (name, db_name) VALUES (?, ?)");
                $stmt->execute([$name, $dbName]);
                
                // 2. Crea il database
                $pdo->exec("CREATE DATABASE `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
                
                // 3. Disabilita foreign key
                $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
                
                // 4. Copia le tabelle
                $tables = $pdo->query("
                    SELECT table_name 
                    FROM information_schema.tables 
                    WHERE table_schema = 'tenant_template' 
                    AND table_type = 'BASE TABLE'
                ")->fetchAll(PDO::FETCH_COLUMN);
                
                foreach ($tables as $table) {
                    $pdo->exec("CREATE TABLE `$dbName`.`$table` LIKE tenant_template.`$table`");
                    
                    if (in_array($table, $tablesWithData)) {
                        $pdo->exec("INSERT INTO `$dbName`.`$table` SELECT * FROM tenant_template.`$table`");
                    }
                }
                
                // 5. Copia le viste
                $views = $pdo->query("
                    SELECT table_name 
                    FROM information_schema.tables 
                    WHERE table_schema = 'tenant_template' 
                    AND table_type = 'VIEW'
                ")->fetchAll(PDO::FETCH_COLUMN);
                
                foreach ($views as $view) {
                    try {
                        $row = $pdo->query("SHOW CREATE VIEW tenant_template.`$view`")->fetch(PDO::FETCH_ASSOC);
                        if ($row && isset($row['Create View'])) {
                            $createSQL = $row['Create View'];
                            $createSQL = preg_replace('/DEFINER=`[^`]+`@`[^`]+`\s+/', '', $createSQL);
                            $createSQL = str_replace('tenant_template', $dbName, $createSQL);
                            $pdo->exec($createSQL);
                        }
                    } catch (PDOException $e) {
                        // Ignora errori sulle viste
                    }
                }
                
                // 6. Riabilita foreign key
                $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
                
                $success = "Tenant '$name' creato con successo!";
                echo "<script>setTimeout(function(){ window.location.href = 'admin.php'; }, 2000);</script>";
                
            } catch (PDOException $e) {
                $error = "Errore: " . $e->getMessage();
            }
        }
    }
}
?>
<!-- Qui continua l'HTML come sopra -->
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea Tenant - Tenant Manager</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .info-box {
            background: #e3f2fd;
            border-left: 4px solid #2196f3;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .info-box h4 {
            margin: 0 0 10px 0;
            color: #1976d2;
        }
        .info-box ul {
            margin: 0;
            padding-left: 20px;
        }
        .info-box li {
            margin: 5px 0;
        }
        code {
            background: #f4f4f4;
            padding: 2px 5px;
            border-radius: 3px;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>➕ Crea Nuovo Tenant</h1>
            <a href="admin.php" class="btn-back">← Torna alla dashboard</a>
        </div>
        
        <?php if ($error): ?>
            <div class="error">❌ <?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="success">✅ <?= htmlspecialchars($success) ?></div>
            <p style="text-align: center; margin-top: 20px;">
                <a href="admin.php" class="btn btn-primary">Torna alla dashboard</a>
            </p>
        <?php endif; ?>
        
        <?php if (!$success && $_SERVER['REQUEST_METHOD'] !== 'POST'): ?>
        
        <div class="info-box">
            <h4>📋 Cosa verrà creato</h4>
            <ul>
                <li><strong>Tutte le tabelle</strong> della tua applicazione (con struttura completa)</li>
                <li><strong>Tutte le viste</strong> (getActiveUsers, getCommentsByPost, ecc.)</li>
                <li><strong>Chiavi primarie, foreign key e indici</strong> mantenuti</li>
                <li><strong>Dati predefiniti</strong> per le tabelle: 
                    <code>app_arguments</code>, <code>app_roles</code>, 
                    <code>app_permissions</code>, <code>app_role_composition</code>
                </li>
                <li><strong>Tabelle vuote</strong> per: 
                    <code>app_users</code>, <code>app_posts</code>, <code>app_comments</code>, 
                    <code>app_members</code>, <code>app_spaces</code>, ecc.
                </li>
            </ul>
        </div>
        
        <form method="POST" class="create-form">
            <div class="form-group">
                <label for="name">Nome del tenant:</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       required 
                       placeholder="Es: Azienda Rossi, Comune di Milano, Scuola XYZ"
                       autofocus>
                <small>Il database verrà chiamato: <strong>tenant_</strong> + nome_senza_spazi</small>
            </div>
            
            <button type="submit" class="btn btn-primary">🚀 Crea Tenant</button>
            <a href="admin.php" class="btn btn-secondary">Annulla</a>
        </form>
        <?php endif; ?>
    </div>
</body>
</html>