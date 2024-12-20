# Projet : Site Web avec Multi-Rôles

## Description
Un site web qui permet :
- Aux utilisateurs (clients) de découvrir les menus proposés par un chef, s’inscrire, se connecter et réserver une expérience culinaire.
- Aux chefs (administrateurs) de se connecter, gérer les réservations et consulter des statistiques sur les demandes.

## Fonctionnalités Principales

### 1. Inscription et Connexion
- Les utilisateurs et chefs peuvent s’inscrire et se connecter.
- Une fois connectés, ils sont redirigés vers des pages différentes selon leur rôle : 
  - **Utilisateur (Client)** : page pour consulter les menus et effectuer des réservations.
  - **Chef** : tableau de bord pour gérer les réservations et voir des statistiques.

### 2. Page Utilisateur (Client)
- **Consultation des Menus** :
  - Voir les menus proposés par le chef.
- **Réservation** :
  - Réserver une expérience culinaire en choisissant une date, une heure et le nombre de personnes.
- **Gestion des Réservations** :
  - Consulter l’historique des réservations.
  - Modifier ou annuler des réservations.

### 3. Page Chef (Dashboard)
- **Gestion des Réservations** :
  - Accepter ou refuser les demandes de réservations selon la disponibilité.
- **Statistiques Détaillées** :
  - Nombre de demandes en attente.
  - Nombre de demandes approuvées pour la journée.
  - Nombre de demandes approuvées pour le jour suivant.
  - Détails du prochain client et de sa réservation.
  - Nombre total de clients inscrits.

### 4. Design
- **Responsive Design** :
  - Compatible avec toutes les tailles d’écrans (mobile, tablette, desktop).
- **Esthétique** :
  - Design moderne et élégant, représentant le luxe.
- **UX/UI** :
  - Interface intuitive pour une navigation fluide.

## Fonctionnalités JavaScript

### Validation des Formulaires avec Regex
- Validation des entrées utilisateurs dans les formulaires (email, téléphone, mot de passe, etc.) grâce à des expressions régulières.

### Formulaires Dynamiques d’Ajout de Menus
- Les chefs peuvent ajouter dynamiquement plusieurs plats dans un menu.
- Possibilité d’ajouter ou de supprimer des champs de saisie sans recharger la page.

### Modals Dynamiques
- Affichage d’informations via des modals sans rechargement de la page (détails de réservation, confirmation d’action, messages d’erreur).

### SweetAlerts
- Intégration de SweetAlert pour afficher des alertes visuelles et élégantes (confirmation de réservation, annulation, etc.).

## Sécurité des Données

### Hashage des Mots de Passe
- Les mots de passe sont hachés avant d’être stockés dans la base de données pour garantir leur sécurité.

### Protection contre les Failles XSS (Cross-Site Scripting)
- Nettoyage et échappement des entrées utilisateurs pour éviter les attaques XSS.

### Prévention des Injections SQL
- Utilisation de requêtes préparées pour interagir avec la base de données, prévenant ainsi les injections SQL.

### Protection contre les Attaques CSRF (Bonus)
- Implémentation d’un token CSRF pour sécuriser les actions sensibles comme les réservations, les inscriptions et les modifications de profil.

## Installation
1. Clonez le dépôt :
   ```bash
   git clone https://github.com/azddineharchaoui/chef
   ```
2. Installez les dépendances :
   ```bash
   npm install
   ```
3. Configurez la base de données dans le fichier `.env`.
4. Lancez le serveur :
   ```bash
   npm start
   ```
5. Accédez au site sur [http://localhost:3000](http://localhost:3000).

## Technologies Utilisées
- **Frontend** : HTML, CSS, JavaScript (SweetAlert, Modals Dynamiques)
- **Backend** : PHP
- **Base de Données** : MySQL 
- **Sécurité** : bcrypt (hashage), protection XSS et CSRF

## Contributions
Les contributions sont les bienvenues. Veuillez créer une issue avant de soumettre une pull request.

