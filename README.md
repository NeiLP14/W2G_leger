# 🖥️ WorkTogether – Client Léger (Application Web Symfony)

## 📌 Présentation

WorkTogether est une application web développée avec le framework **Symfony** dans le cadre du BTS SIO SLAM.

Elle permet de gérer :
- les utilisateurs
- les offres
- les baies (infrastructure)
- les réservations

L’application est accessible via un navigateur web (client léger) et repose sur une architecture client-serveur avec une base de données MySQL.

---

## 🏗️ Architecture

- **Client léger** : Navigateur web (HTML, CSS, JS, Twig)
- **Serveur web** : Apache2 (Linux)
- **Backend** : Symfony (PHP)
- **Base de données** : MySQL / MariaDB

---

## 🛠️ Technologies utilisées

- PHP 8.x
- Symfony 7
- Twig (moteur de templates)
- MySQL / MariaDB
- Apache2
- HTML5 / CSS3 / JavaScript
- Composer

---

## 📂 Structure du projet

W2G_leger/
│── assets/              # Fichiers front (JS, CSS)
│── config/              # Configuration Symfony
│── migrations/          # Migrations base de données
│── public/              # Point d’entrée (index.php)
│── src/                 # Code source (Controllers, Services...)
│── templates/           # Vues Twig
│── tests/               # Tests unitaires
│── var/                 # Cache et logs
│── vendor/              # Dépendances Composer
│── .env                 # Variables d’environnement
│── composer.json        # Dépendances PHP

---

## ⚙️ Installation

### 1. Cloner le projet

```bash
git clone <url_du_repo>
cd W2G_leger
````

---

### 2. Installer les dépendances

```bash
composer install
```

---

### 3. Créer la base de données

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

---

### 4. Lancer l’application

```bash
symfony server:start
```

---

## 🌐 Accès à l’application

* Local : [http://localhost](http://localhost)

---

## 🔐 Authentification

L’application utilise **Symfony Security** pour :

* la connexion utilisateur
* la gestion des rôles (admin, technicien, comptable)
* la protection des routes

---

## 📊 Fonctionnalités principales

* 👤 Gestion des utilisateurs
* 📦 Gestion des offres
* 🗄️ Gestion des baies
* 📅 Gestion des réservations
* 🔎 Consultation des données
* 📱 Interface responsive (mobile / desktop)
* ⚠️ Messages flash (feedback utilisateur)

---

## 🚀 Déploiement

Déploiement sur serveur Linux :

* OS : Debian / Ubuntu
* Serveur web : Apache2
* PHP installé et configuré
* Base de données MySQL
* Projet placé dans `/var/www/`

---

## 🧠 Bonnes pratiques

* Ne jamais exposer le fichier `.env`
* Utiliser `.env.local` en production
* Séparer environnement dev / prod
* Vérifier les permissions (`www-data`)

---

## 👨‍💻 Auteur

Projet réalisé dans le cadre du **BTS SIO SLAM – Session 2026**
