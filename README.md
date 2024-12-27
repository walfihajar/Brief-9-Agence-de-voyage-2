# Gestion des Réservations pour un Site de Voyage 

## Description du Projet

Ce projet a pour objectif de concevoir une application web permettant aux clients de réserver des activités et des offres touristiques, tout en offrant une gestion efficace des utilisateurs et des réservations. Le projet repose sur une architecture orientée objet (OOP) afin de rendre l'application flexible et évolutive.

### Fonctionnalités Principales

- **Authentification et autorisation** : Gestion des utilisateurs avec des rôles distincts (administrateur, client, visiteur).
- **Gestion des activités** : Ajouter, modifier, ou supprimer des activités (vols, hôtels, circuits).
- **Gestion des réservations** : Réaliser des réservations, modifier ou annuler celles-ci.
- **Consultation d’offres** : Les visiteurs peuvent consulter les offres sans s'inscrire.

---

## Technologies Utilisées

- **HTML5** : Structure de base du site web.
- **CSS3** : Pour la mise en forme et la création d’un design responsive.
- **PHP** : Langage de programmation utilisé pour le backend, avec une approche orientée objet.
- **MySQL** : Base de données utilisée pour stocker les informations relatives aux utilisateurs, activités et réservations.
- **Git** : Contrôle de version pour gérer le code source.
- **UML** : Diagrammes utilisés pour modéliser les processus et la structure de l’application.

---

## Structure du Projet

### Backend

. **Classes PHP** : Le projet suit une approche orientée objet, avec des classes et des objets pour gérer les utilisateurs, les activités et les réservations. Chaque classe représente une entité (par exemple, `User`, `Activity`, `Reservation`).
   
. **Base de données MySQL** : La base de données contient les tables pour les utilisateurs, les activités et les réservations. Elle est gérée avec des commandes SQL pour la création, la modification, et l’insertion des données.

. **Authentification et sécurité** : L'authentification des utilisateurs se fait via un système sécurisé avec gestion des rôles. Un utilisateur doit s'authentifier avant de pouvoir effectuer une réservation ou accéder à certaines fonctionnalités.

### Frontend

. **Interface Utilisateur (UI)** : Le design de l’interface est simple et intuitif, permettant aux utilisateurs de naviguer facilement entre les différentes sections du site.

---

## Diagrammes UML

Des diagrammes UML ont été créés pour illustrer les différentes classes et leurs relations dans le système. Vous pouvez les consulter pour mieux comprendre la structure du code et la logique du système.

---



## Conclusion

Ce projet vise à fournir une solution moderne et flexible pour la gestion des réservations de voyages, tout en appliquant les meilleures pratiques de la programmation orientée objet en PHP et en utilisant une base de données MySQL pour stocker les données essentielles.

---
