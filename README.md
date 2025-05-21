# 📦 Boîte à Idées - Bloc 3 BAI

## 📝 Présentation

**Boîte à Idées** est une application web développée avec le framework **Laravel**, dans le cadre du BTS SIO SLAM.

Elle permet aux utilisateurs :
- de soumettre des idées,
- de commenter celles des autres,
- de modifier ou supprimer leurs propres contenus,
- avec des limites quotidiennes pour éviter le spam.

> Ce projet a été également utilisé comme **terrain d'entraînement pour les audits de cybersécurité** dans le cadre du Bloc 3 ("Agir en protection des données personnelles et de la sécurité numérique").

---

## 🧩 Fonctionnalités principales

- 🔐 Authentification utilisateur
- 🧠 Création, modification et suppression d’idées
- 💬 Ajout et suppression de commentaires (limités à 3 par jour)
- 📊 Dashboard d’administration
- ✅ Sécurisation progressive contre les attaques XSS (cross-site scripting)
- 📦 Importation de données (idées & commentaires) via fichiers CSV
- 🔎 Filtrage des contenus malveillants avec logs détaillés

---

## 🛠️ Stack technique

- **PHP 8.3**
- **Laravel 11**
- **MySQL**
- **Blade** (template Laravel)
- **Tailwind CSS** pour le style
- **CSV import** + détection d'injection HTML/JS/XML
- Scripts Python pour analyse/sécurisation

---

## 🔐 Focus cybersécurité

Le projet a été volontairement exposé à des **données malveillantes** pour entraîner la détection et la neutralisation d’attaques XSS stockées :
- Détection de balises `<script>`, HTML ou XML dans les idées/commentaires
- Génération automatique de logs (`OK` / `KO`) avec preuve de contamination
- Nettoyage des données via scripts Python + génération d'`INSERT` SQL propres

---

## 🧪 Exemple de scénario de test

1. Génération de 20 idées + 40 commentaires avec des payloads XSS (`<script>`, `javascript:`, etc.)
2. Exécution d’un script Python pour :
   - analyser les contenus ligne par ligne
   - logger les risques
   - produire un SQL propre
3. Vérification dans Laravel que les vues ne crashent plus

---

## 👨‍💻 Auteur

Projet réalisé par **Dervis Sahin** dans le cadre du BTS SIO SLAM, session 2025.

---

## 📁 Structure du projet

```
├── app/
│   ├── Models/
│   ├── Http/Controllers/
├── database/
│   ├── migrations/
│   ├── seeders/
├── resources/
│   ├── views/
│   │   ├── ideas/
│   │   ├── dashboard.blade.php
├── public/
├── routes/
│   └── web.php
```

---

## ✅ Statut

✔️ Application fonctionnelle  
✔️ Données vérifiées et nettoyées  
✔️ Conforme aux bonnes pratiques Laravel & sécurité basique

---

## 📄 Licence

Projet éducatif à but pédagogique uniquement — **non destiné à une mise en production**.
