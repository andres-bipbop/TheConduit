# The Conduit
A real-time discord-style chat application between two or more users. It also supports voice calls, video calls, community servers and other features.

Cognome: Pellegrinelli

Nome: Andres

Titolo: The Conduit

Tagline: Explore the conduit.

Descrizione: Un'app di social media in cui puoi creare e unirti a comunità (formalmente "Spaces"), creare post e chattare con altre persone.

Target: tutti.

Competitors: Reddit, Substack

Tecnologie: html, css, php, js

**Link pubblico al prototipo della web app:** https://bebop-jam-sessions.lovable.app

Pagine disponibili: /auth, /dashboard, /community/:id, /create-community, /profile, /settings, /chat/:friendId

# Analisi dei requisiti

## 1. Utente Esterno
**Azioni possibili:**
- Registrazione
- Login

## 2. Utente Loggato

### 2.1 Pagina Principale
**Azioni possibili:**
- Creare Comunità
- Selezionare Comunità
- Aggiungere Comunità
- Aggiungere Amici
- Aprire Chat Amico
- Visualizzare richieste di amicizia
- Visualizzare post di altri utenti
- Creare post

### 2.2 Gestione del Profilo
**Azioni possibili:**
- Modificare Nome Utente
- Modificare Foto Profilo
- Modificare Descrizione Profilo

### 2.3 Impostazioni Personali
**Azioni possibili:**
- Gestisci Preferenze
- Gestisci Impostazioni Account

### 2.4 Chat con altro utente
**Azioni possibili:**
- Inviare messaggi
- Avviare una chiamata vocale
- Avviare una videochiamata

### 2.5 Post
**Azioni possibili:**
- Mettere Like
- Mettere commenti
- Condividere

## 3. Proprietario di una Comunità

### 3.1 Gestione Membri
**Azioni possibili:**
- Visualizzare Membri
- Sospendere Membro
- Bannare Membro
- Modificare Ruoli Membri

### 3.2 Impostazioni Comunità
**Azioni possibili:**
- Impostare Privata/Publica
- Definire Numero Massimo Membri
- Modificare Nome Comunità
- Aggiungere Immagine Comunità
- Modificare Descrizione Comunità
- Creare Link Invito

### 3.3 Struttura Comunità
**Azioni possibili:**
- Creare/Modificare/Eliminare Canale Testuale
- Creare/Modificare/Eliminare Canale Vocale
- Creare/Modificare/Eliminare Canale Post

## 4. Membro di una Comunità
**Azioni possibili:**
- Scrivere Messaggi
- Partecipare Canale Vocale
- Pubblicare Post Privato/Pubblico
- Visualizzare Profili Amici
- Abbandonare Comunità

## 5. Membro Sospeso
**Azioni possibili:**
- Abbandonare Comunità
- Inviare messaggio al propietario della comunità


Diagramma UML dei casi d'uso:
<img width="1356" height="1151" alt="casid&#39;uso drawio" src="https://github.com/user-attachments/assets/70891733-6d17-4718-99a9-a2b9036d3016" />

Diagramma UML delle classi:
<img width="5550" height="4321" alt="Blank diagram" src="https://github.com/user-attachments/assets/8711b162-3659-4d42-b3ad-db1260757c1e" />

Schema ER:
<img width="5459" height="4675" alt="Blank diagram (2)" src="https://github.com/user-attachments/assets/d9496270-d921-4f82-8fe5-446cf095653a" />


