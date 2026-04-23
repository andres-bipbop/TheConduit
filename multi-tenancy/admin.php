<?php
require_once 'config.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Ottieni lista tenant
$tenants = $pdo->query("SELECT * FROM tenants ORDER BY created_at DESC")->fetchAll();

// Conta quanti tenant
$totalTenants = count($tenants);
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Tenant Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏢 Dashboard Tenant Manager</h1>
            <div class="user-info">
                <span>Ciao, <?= htmlspecialchars($_SESSION['user']) ?></span>
                <a href="logout.php" class="btn-logout">🚪 Esci</a>
            </div>
        </div>
        
        <div class="stats">
            <div class="stat-card">
                <div class="stat-number"><?= $totalTenants ?></div>
                <div class="stat-label">Tenant attivi</div>
            </div>
        </div>
        
        <div class="actions">
            <a href="create_tenant.php" class="btn btn-success">➕ Nuovo Tenant</a>
        </div>
        
        <?php if (empty($tenants)): ?>
            <div class="empty-state">
                <p>📭 Nessun tenant ancora creato</p>
                <p>Clicca su "Nuovo Tenant" per iniziare</p>
            </div>
        <?php else: ?>
            <table class="tenant-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome Tenant</th>
                        <th>Database</th>
                        <th>Data creazione</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tenants as $t): ?>
                    <tr>
                        <td><?= $t['id'] ?></td>
                        <td><strong><?= htmlspecialchars($t['name']) ?></strong></td>
                        <td><code><?= htmlspecialchars($t['db_name']) ?></code></td>
                        <td><?= date('d/m/Y H:i', strtotime($t['created_at'])) ?></td>
                        <td>
                            <a href="delete_tenant.php?id=<?= $t['id'] ?>" 
                               class="btn-delete"
                               onclick="return confirm('⚠️ Sei sicuro? Verrà ELIMINATO il database <?= htmlspecialchars($t['db_name']) ?> e tutti i dati.')">
                                🗑️ Elimina
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>