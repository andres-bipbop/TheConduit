async function apiFetch(url) {
    let response = await fetch(url, {
    method: 'GET',
    credentials: 'include'
    });

    if (response.status === 401) {
    // Tenta il refresh
    const refreshed = await renewRefreshToken();
    if (!refreshed) {
        // Il refresh è fallito e la funzione ha già reindirizzato al login
        throw new Error('Refresh token fallito, reindirizzamento in corso...');
    }
    // Riprova la richiesta originale
    response = await fetch(url, {
        method: 'GET',
        credentials: 'include'
    });
    }

    if (!response.ok) {
    throw new Error(`API error: ${response.status} ${response.statusText}`);
    }

    return response.json();
}

async function renewRefreshToken() {
    try {
    const response = await fetch(APP_CONFIG.ENDPOINTS.token.verifyRefresh, {
        method: 'GET',
        credentials: 'include'
    });
    
    if (!response.ok) {
        alert('Sessione scaduta. Effettua nuovamente il login.');
        window.location.href = 'loginForm.php';
        return false;
    }
    
    return true;
    } catch (error) {
    console.error('Token renewal error:', error);
    // Oppure qui se c'è un errore di rete durante il refresh
    window.location.href = 'loginForm.php';
    return false;
    }
}