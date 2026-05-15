# Documentazione API - Sistema Sociale

Documentazione completa dell'API RESTful per il sistema di social network, The Conduit.

## Indice

1. [Panoramica](#panoramica)
2. [Configurazione](#configurazione)
3. [Autenticazione](#autenticazione)
4. [Endpoints](#endpoints)
   - [Autenticazione](#endpoint-autenticazione)
   - [Token](#endpoint-token)
   - [Utenti](#endpoint-utenti)
   - [Post](#endpoint-post)
   - [Spazi](#endpoint-spazi)
   - [Commenti](#endpoint-commenti)
   - [App](#endpoint-app)
5. [Codici di Risposta](#codici-di-risposta)
6. [Gestione Errori](#gestione-errori)

---

## Panoramica

L'API fornisce un sistema completo per una piattaforma di social network con le seguenti funzionalità:

- **Autenticazione**: Login con JWT (JSON Web Tokens)
- **Gestione Utenti**: Profili utente, interessi, seguaci
- **Post**: Creazione e visualizzazione di post con allegati media
- **Spazi**: Comunità tematiche con gestione dei membri
- **Commenti**: Sistema di commenti e risposte ai post
- **Argomenti**: Gestione degli interessi e delle categorie

### Tecnologie

- **Linguaggio**: PHP
- **Database**: MySQL
- **Autenticazione**: JWT (Firebase PHP-JWT)
- **Formato dati**: JSON
- **Metodi HTTP**: GET, POST

### URL Base

```
https://bookish-rotary-phone-6976vjxwgp5rfqwv-80.app.github.dev/api/
```

---

## Configurazione

### Variabili di Configurazione

La configurazione è gestita nel file `config/config.php`:

```php
define('DB_HOST', 'localhost');           // Host database
define('DB_NAME', 'my_pellegrinelliandres5ie'); // Nome database
define('DB_USER', 'admin_andres');        // Utente database
define('DB_PASSWORD', 'root');            // Password database

define('ACCESS_TOKEN_KEY', '...');        // Chiave per access token
define('REFRESH_TOKEN_KEY', '...');       // Chiave per refresh token
define('LOGIN_SECRET_PEPPER', '...');     // Pepper per hash password
```

### Token JWT

- **Algorithm**: HS256
- **Access Token TTL**: 600 secondi (10 minuti)
- **Refresh Token TTL**: 604800 secondi (7 giorni)
- **Issuer**: https://localhost
- **Audience**: https://localhost

---

## Autenticazione

L'API utilizza un sistema di autenticazione basato su JWT con cookies e header Bearer.

### Modalità di Autenticazione

#### 1. Bearer Token (Header)

```
Authorization: Bearer <access_token>
```

#### 2. Cookie JWT

Token memorizzati come cookies HTTPOnly:
- `jwtAccess`: Token di accesso (10 minuti)
- `jwtRefresh`: Token di refresh (7 giorni)

### Flusso di Autenticazione

1. **Login**: Inviare credenziali e ricevere token
2. **Utilizzo**: Includere token in header o usare cookie
3. **Refresh**: Usare refresh token per ottenere nuovo access token

---

## Endpoints

### Endpoint Autenticazione

#### POST /credentials/login

Autentica un utente e genera token JWT.

**Request Body**:
```json
{
  "username": "string",
  "password": "string"
}
```

**Response (200 OK)**:
```json
{
  "message": "Login successful.",
  "userdata": {
    "id": 1,
    "username": "user123",
    "email": "user@example.com"
  },
  "accessToken": "eyJ0eXAiOiJKV1QiLC...",
  "refreshToken": "eyJ0eXAiOiJKV1QiLC..."
}
```

**Codici di Errore**:
- `400`: Username e password obbligatori
- `404`: Utente non trovato
- `403`: Account non verificato (status != "active")
- `401`: Credenziali non valide
- `500`: Errore interno

---

### Endpoint Token

#### POST /token/refresh

Genera un nuovo refresh token.

**Request Body**:
```json
{
  "username": "string",
  "id": "number"
}
```

**Response (200 OK)**:
```json
{
  "refreshToken": "eyJ0eXAiOiJKV1QiLC..."
}
```

---

#### GET /token/verify-access

Verifica che il token di accesso sia valido.

**Header Richiesto**:
```
Authorization: Bearer <access_token>
```

**Response (200 OK)**:
```json
{
  "message": "Access token is valid.",
  "userdata": {
    "id": 1,
    "username": "user123"
  }
}
```

**Codici di Errore**:
- `401`: Token non valido o scaduto

---

#### GET /token/verify-refresh

Verifica il refresh token e genera un nuovo access token.

**Modalità**:
- Bearer: `Authorization: Bearer <refresh_token>`
- Cookie: Usa `jwtRefresh` dal cookie

**Response (200 OK)**:
```json
{
  "accessToken": "eyJ0eXAiOiJKV1QiLC...",
  "userdata": {
    "id": 1,
    "username": "user123"
  }
}
```

**Codici di Errore**:
- `401`: Refresh token non valido o scaduto

---

### Endpoint Utenti

#### GET /users/getUserLoginData/{username}

Recupera i dati di login di un utente (id, username, email, password hash, status).

**Parametri**:
- `username` (path): Nome utente

**Response (200 OK)**:
```json
{
  "id": 1,
  "username": "user123",
  "email": "user@example.com",
  "password": "salt.hash",
  "status": "active"
}
```

**Codici di Errore**:
- `500`: Errore database

---

#### GET /users/getUserData/{id}

Recupera tutti i dati di un utente (profilo completo).

**Parametri**:
- `id` (path): ID utente

**Response (200 OK)**:
```json
{
  "id": 1,
  "username": "user123",
  "email": "user@example.com",
  "name": "John Doe",
  "bio": "Bio utente",
  "status": "active",
  "...": "altri campi"
}
```

**Autenticazione**: Non richiesta

---

#### GET /users/getUserSpaces/{id}

Recupera gli spazi a cui appartiene un utente.

**Parametri**:
- `id` (path): ID utente

**Autenticazione**: ✅ Richiesta

**Response (200 OK)**:
```json
[
  {
    "id": 1,
    "name": "Tecnologia",
    "description": "Spazio dedicato alla tecnologia",
    "iconUrl": "https://...",
    "bannerUrl": "https://...",
    "member_count": 150
  }
]
```

---

#### GET /users/getUserInterests/{id}

Recupera gli interessi/argomenti di un utente.

**Parametri**:
- `id` (path): ID utente

**Autenticazione**: ✅ Richiesta

**Response (200 OK)**:
```json
[
  {
    "id": 1,
    "name": "Programmazione",
    "area": "Technology"
  },
  {
    "id": 2,
    "name": "Web Development",
    "area": "Technology"
  }
]
```

---

#### GET /users/getUserFollowers/{id}

Recupera l'elenco dei seguiti da un utente.

**Parametri**:
- `id` (path): ID utente

**Autenticazione**: ✅ Richiesta

**Response (200 OK)**:
```json
[
  {
    "user_id": 2,
    "username": "followed_user",
    "name": "John Followed"
  }
]
```

---

### Endpoint Post

#### GET /posts/getCustomPosts/{id}

Recupera post personalizzati per un utente in base ai suoi interessi.

**Parametri**:
- `id` (path): ID utente
- Ordine: Per corrispondenza interessi, like, data

**Autenticazione**: ✅ Richiesta

**Response (200 OK)**:
```json
[
  {
    "id": 1,
    "user_id": 2,
    "title": "Titolo Post",
    "description": "Descrizione del post",
    "mediaFile_1": "uploads/...",
    "postLikes": 15,
    "postDate": "2026-05-15 10:30:00",
    "matchCount": 85
  }
]
```

**Limit**: 500 post

---

#### GET /posts/getFollowedFeed/{id}

Recupera il feed dei post degli utenti seguiti.

**Parametri**:
- `id` (path): ID utente
- Ordine: Data discendente

**Autenticazione**: ✅ Richiesta

**Response (200 OK)**:
```json
[
  {
    "id": 1,
    "user_id": 3,
    "title": "Post from followed user",
    "postedAt": "2026-05-15 14:20:00",
    "...": "altri campi"
  }
]
```

**Limit**: 500 post

---

#### GET /posts/getPostsByUser/{id}

Recupera tutti i post di un utente specifico.

**Parametri**:
- `id` (path): ID utente (opzionale)
- Ordine: Data discendente

**Autenticazione**: ✅ Richiesta

**Response (200 OK)**:
```json
[
  {
    "userId": 1,
    "id": 100,
    "title": "Mio primo post",
    "postDate": "2026-05-10 08:00:00"
  }
]
```

**Limit**: 500 post

---

#### GET /posts/getPostsBySpace/{id}

Recupera tutti i post di uno spazio specifico.

**Parametri**:
- `id` (path): ID spazio (opzionale)
- Ordine: Data discendente

**Autenticazione**: ✅ Richiesta

**Response (200 OK)**:
```json
[
  {
    "id": 50,
    "space_id": 2,
    "title": "Discussione tecnica",
    "postedAt": "2026-05-14 16:45:00"
  }
]
```

**Limit**: 500 post

---

#### POST /posts/createPost

Crea un nuovo post con titolo, descrizione e fino a 5 allegati media.

**Request Body (multipart/form-data)**:
```
- user_id: number (richiesto)
- title: string (richiesto)
- description: string (opzionale)
- images: file[] (max 5 file)
```

**Autenticazione**: ✅ Richiesta

**Response (201 Created)**:
```json
{
  "message": "Post created successfully.",
  "postId": 1001
}
```

**Gestione File**:
- Directory: `uploads/users/{user_id}/posts/`
- Naming: `post_<uniqid>.<ext>`
- Max file: 5
- Formati supportati: Tutti (nessuna restrizione nel codice)

**Codici di Errore**:
- `400`: Titolo obbligatorio o troppi file
- `500`: Errore database

---

### Endpoint Spazi

#### POST /spaces/createSpace

Crea un nuovo spazio.

**Request Body (JSON)**:
```json
{
  "name": "Nome Spazio",
  "iconUrl": "https://example.com/icon.png",
  "bannerUrl": "https://example.com/banner.png",
  "description": "Descrizione dello spazio"
}
```

**Autenticazione**: ✅ Richiesta

**Response (201 Created)**:
```json
{
  "message": "Space created successfully."
}
```

---

#### GET /spaces/getMembers/{spaceId}

Recupera i membri di uno spazio.

**Parametri**:
- `spaceId` (path): ID dello spazio
- Ordine: Data adesione ascendente

**Autenticazione**: ✅ Richiesta

**Response (200 OK)**:
```json
[
  {
    "id": 1,
    "user_id": 5,
    "space_id": 2,
    "username": "member1",
    "joinedAt": "2026-01-10 12:00:00"
  },
  {
    "id": 2,
    "user_id": 6,
    "space_id": 2,
    "username": "member2",
    "joinedAt": "2026-02-15 08:30:00"
  }
]
```

---

### Endpoint Commenti

#### GET /comments/getCommentsByPost/{postId}

Recupera i commenti di un post.

**Parametri**:
- `postId` (path): ID del post
- Ordine: Like discendente, data ascendente

**Autenticazione**: ✅ Richiesta

**Response (200 OK)**:
```json
[
  {
    "id": 1,
    "post_id": 100,
    "user_id": 3,
    "username": "commenter1",
    "content": "Ottimo post!",
    "likes": 5,
    "sentAt": "2026-05-15 11:00:00"
  }
]
```

---

#### GET /comments/getCommentReplies/{commentId}

Recupera le risposte a un commento.

**Parametri**:
- `commentId` (path): ID del commento genitore
- Ordine: Like discendente, data ascendente

**Autenticazione**: ✅ Richiesta

**Response (200 OK)**:
```json
[
  {
    "id": 2,
    "parent_comment_id": 1,
    "post_id": 100,
    "user_id": 4,
    "username": "replier1",
    "content": "Grazie per il feedback!",
    "likes": 2,
    "sentAt": "2026-05-15 12:30:00"
  }
]
```

---

### Endpoint App

#### GET /app/getArguments

Recupera gli argomenti (interessi/categorie) disponibili.

**Parametri**:
- `id` (path, opzionale): ID specifico argomento

**Autenticazione**: ✅ Richiesta

**Response - Tutti (200 OK)**:
```json
[
  {
    "id": 1,
    "name": "Programmazione",
    "area": "Technology",
    "description": "Argomenti di programmazione"
  },
  {
    "id": 2,
    "name": "Web Development",
    "area": "Technology",
    "description": "Sviluppo web"
  }
]
```

**Response - Specifico (200 OK)**:
```json
[
  {
    "id": 1,
    "name": "Programmazione",
    "area": "Technology"
  }
]
```

---

## Codici di Risposta

### Successo

| Codice | Descrizione |
|--------|-------------|
| `200` | OK - Richiesta riuscita |
| `201` | Created - Risorsa creata con successo |

### Errore Client

| Codice | Descrizione |
|--------|-------------|
| `400` | Bad Request - Parametri non validi |
| `401` | Unauthorized - Autenticazione fallita |
| `403` | Forbidden - Account non verificato |
| `404` | Not Found - Risorsa non trovata |

### Errore Server

| Codice | Descrizione |
|--------|-------------|
| `500` | Internal Server Error - Errore del server |

---

## Gestione Errori

### Formato Errore Standard

```json
{
  "error": "Tipo Errore",
  "message": "Descrizione dettagliata dell'errore"
}
```

### Tipi di Errore

#### Auth Error
Errori di autenticazione e autorizzazione:
```json
{
  "error": "Auth error",
  "message": "Missing authorization header."
}
```

#### Bad Request
Parametri mancanti o non validi:
```json
{
  "error": "Bad request",
  "message": "Username and password are required."
}
```

#### Not Found
Risorsa non trovata:
```json
{
  "error": "Not found",
  "message": "User not found."
}
```

#### Internal Error
Errori interni del server:
```json
{
  "error": "Internal error",
  "message": "Messaggio di errore specifico"
}
```

### Validazione Password

Le password sono memorizzate con il seguente formato:
```
{salt}.{hash}
```

Dove:
- **salt**: Valore casuale
- **hash**: SHA256(salt + plainPassword + LOGIN_SECRET_PEPPER)

La verifica utilizza `hash_equals()` per evitare timing attacks.

---

## Considerazioni di Sicurezza

### Autenticazione

- ✅ Token JWT con scadenza
- ✅ Cookies HTTPOnly per protezione XSS
- ✅ Hash password con salt e pepper
- ✅ Validazione token su endpoint protetti

### Autorizzazione

- ✅ CORS configurato per dominio specifico
- ✅ Endpoint sensibili richiedono autenticazione
- ✅ Validazione parametri con prepared statements

### Best Practices

- ✅ Prepared statements per prevenire SQL injection
- ✅ PDO con ERRMODE_EXCEPTION
- ✅ Singleton pattern per connessione database
- ✅ Validazione input su tutti gli endpoint

---

## Esempi di Utilizzo

### JavaScript/Fetch API

#### Login

```javascript
const response = await fetch('https://api.example.com/api/credentials/login', {
  method: 'POST',
  headers: { 'Content-Type': 'application/json' },
  body: JSON.stringify({
    username: 'user123',
    password: 'password'
  })
});

const data = await response.json();
localStorage.setItem('accessToken', data.accessToken);
```

#### Richiesta Autenticata

```javascript
const token = localStorage.getItem('accessToken');
const response = await fetch('https://api.example.com/api/users/getUserSpaces/1', {
  method: 'GET',
  headers: {
    'Authorization': `Bearer ${token}`
  }
});

const spaces = await response.json();
```

#### Creare Post

```javascript
const formData = new FormData();
formData.append('user_id', 1);
formData.append('title', 'Mio primo post');
formData.append('description', 'Descrizione del post');
formData.append('images', imageFile1);
formData.append('images', imageFile2);

const token = localStorage.getItem('accessToken');
const response = await fetch('https://api.example.com/api/posts/createPost', {
  method: 'POST',
  headers: {
    'Authorization': `Bearer ${token}`
  },
  body: formData
});
```

### cURL

#### Login

```bash
curl -X POST https://api.example.com/api/credentials/login \
  -H "Content-Type: application/json" \
  -d '{
    "username": "user123",
    "password": "password"
  }'
```

#### Richiesta Autenticata

```bash
curl -X GET https://api.example.com/api/users/getUserSpaces/1 \
  -H "Authorization: Bearer <access_token>"
```

---

## Struttura Progetto

```
api/
├── public/
│   └── index.php          # Entry point principale
├── auth/
│   └── TokenService.php   # Gestione JWT
├── config/
│   ├── config.php         # Configurazione database
│   └── Database.php       # Connessione database (Singleton)
├── endpoints/
│   ├── UsersEndpoints.php
│   ├── PostEndpoints.php
│   ├── SpaceEndpoints.php
│   ├── CommentEndpoints.php
│   └── AppEndpoints.php
├── composer.json          # Dipendenze (Firebase JWT)
└── .htaccess             # Rewrite rules Apache
```

---

## Support e Contatti

Per domande o segnalazioni di bug, contattare il team di sviluppo.

**Versione API**: 1.0  
**Ultimo aggiornamento**: 15 Maggio 2026
