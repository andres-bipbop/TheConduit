# The Conduit
Cognome: Pellegrinelli

Nome: Andres

Titolo: The Conduit

Tagline: Explore the conduit.

Descrizione: Un'app di social media in cui puoi creare e unirti a comunità (formalmente "Spaces"), creare post e chattare con altre persone.

Target: tutti.

Competitors: Reddit, Substack, X

Tecnologie: html, css, php, js

---

# 🚀 Requisiti di Sistema e Setup

## 📋 Requisiti Hardware Minimi

| Componente | Requisito Minimo | Consigliato |
|-----------|------------------|-----------|
| CPU | 1 Core (2 GHz) | 2+ Cores (2.5+ GHz) |
| RAM | 2 GB | 4+ GB |
| Disco | 5 GB liberi | 10+ GB liberi |
| Connessione | Adattatore di rete | 1 Gbps |

## 🔧 Requisiti Software

### Obbligatori
- **Apache 2.4+** (Web Server)
- **MariaDB 10.3+** o **MySQL 8.0+** (Database)
- **PHP 7.4+** (Backend)
- **Composer** (Gestore dipendenze PHP)
- **Node.js 14+** (Per build Tailwind CSS)
- **npm 6+** (Gestore pacchetti Node.js)

### Opzionali ma Consigliati
- **Docker** (Per MailHog e containerizzazione)


## ⚙️ Configurazione

### 1. Clona il Repository

```bash
git clone https://github.com/andres-bipbop/TheConduit.git
cd TheConduit/progetto
```

### 2. Installa Dipendenze PHP

```bash
# Installa dipendenze per il backend API
cd api
composer install
cd ..
```

### 3. Installa Dipendenze Node.js

```bash
# Installa pacchetti npm (per Tailwind CSS)
npm install
```

### 4. Configura il Database

#### Accesso a MariaDB

```bash
# Su Linux/macOS
sudo mariadb

# Su Windows
mysql -u root
```

#### Comandi Setup Database

```sql
-- Crea database
CREATE DATABASE my_pellegrinelliandres5ie CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Crea utente
CREATE USER 'admin_andres'@'localhost' IDENTIFIED BY 'YOUR_SECURE_PASSWORD';

-- Concedi permessi
GRANT ALL PRIVILEGES ON my_pellegrinelliandres5ie.* TO 'admin_andres'@'localhost';
FLUSH PRIVILEGES;
EXIT;

## 🚀 Avviamento Servizi - Quick Start

### Metodo Automatico (Consigliato)

```bash
# Rendi eseguibile e avvia lo script
chmod +x start.sh
./start.sh
```

### Metodo Manuale

```bash
# Avvia Apache
sudo systemctl start apache2     # Linux
sudo apachectl start             # macOS

# Avvia MariaDB
sudo systemctl start mariadb     # Linux
sudo mysql.server start          # macOS

# Avvia MailHog (richiede Docker)
docker run -d -p 1025:1025 -p 8025:8025 mailhog/mailhog

# Verifica stato
sudo systemctl status apache2
sudo systemctl status mariadb
docker ps
```

## 🔌 Porte Utilizzate

| Servizio | Porta | Descrizione |
|----------|-------|-------------|
| Apache (HTTP) | 80 | Web Server |
| MariaDB | 3306 | Database |
| MailHog SMTP | 1025 | Email simulato |
| MailHog UI | 8025 | Interfaccia web MailHog |

## 📧 MailHog - Email Simulator

MailHog intercetta gli email SMTP durante lo sviluppo. **Non serve credenziale reale.**

### Accesso Web UI

**URL:** http://localhost:8025

**Features:**
- 📧 Visualizza email inviati
- 🔍 Ricerca per mittente/destinatario
- 📝 Preview HTML
- 📎 Scarica allegati
- 🗑️ Cancella email

**Perché MailHog?**
- ✅ Perfetto per testing email
- ✅ Niente configurazione SMTP reale
- ✅ Interfaccia intuitiva
- ✅ Docker-based (facile deploy)
