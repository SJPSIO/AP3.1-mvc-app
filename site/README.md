# Exemple PHP/MySQL avec architecture MVC

Petite application CRUD (gestion de produits) illustrant le modèle **MVC** (Modèle-Vue-Contrôleur) en PHP natif, sans framework.

## Structure du projet

```
mvc-app/
├── config/
│   └── database.php        # Paramètres de connexion BDD
├── core/
│   ├── Database.php         # Connexion PDO (singleton)
│   ├── Controller.php        # Contrôleur de base (render, redirect)
│   └── Router.php            # Routeur / front controller
├── models/
│   └── ProductModel.php       # Accès aux données (requêtes SQL)
├── controllers/
│   └── ProductController.php   # Logique métier / orchestration
├── views/
│   └── products/
│       ├── index.php           # Liste des produits
│       ├── create.php          # Formulaire d'ajout
│       └── edit.php            # Formulaire d'édition
├── public/
│   └── index.php               # Point d'entrée unique (front controller)
└── sql/
    └── database.sql            # Script de création de la BDD
```

## Principe des namespaces

### A quoi sert un namespace ?

Un **namespace** (espace de noms) permet de regrouper des classes sous un nom commun. Il évite les conflits lorsque deux parties d'une application utilisent des classes portant le même nom.

Par exemple, une classe `Database` appartenant au namespace `App\Core` est identifiée par son nom complet :

```php
App\Core\Database
```

Le namespace est déclaré au début du fichier, après `<?php` :

```php
namespace App\Core;

class Database
{
   // ...
}
```

Le nom `App` représente l'application. Les sous-namespaces correspondent aux grands rôles du projet :

| Namespace | Classes concernées | Rôle |
|---|---|---|
| `App\Core` | `Router`, `Controller`, `Database` | Classes techniques communes |
| `App\Controllers` | `ProductController` | Reçoit les requêtes et orchestre les actions |
| `App\Models` | `ProductModel` | Dialogue avec la base de données |
| `App\Env` | Configuration de l'environnement | Paramètres de connexion et d'exécution |

### Utiliser une classe d'un autre namespace

Pour utiliser une classe située dans un autre namespace, deux écritures sont possibles.

La première utilise le nom complet :

```php
$database = new \App\Core\Database();
```

La seconde, plus lisible, importe la classe avec `use` :

```php
use App\Core\Database;

$database = new Database();
```

Dans `public/index.php`, les lignes suivantes signifient que `Router` et `ProductController` appartiennent à d'autres namespaces :

```php
use App\Controllers\ProductController;
use App\Core\Router;
```

`use` ne charge pas le fichier PHP. Il indique seulement à PHP quel nom complet utiliser. Les fichiers sont donc chargés séparément avec `require_once` :

```php
require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../controllers/ProductController.php';
```

`require_once` charge physiquement le fichier une seule fois, tandis que `use` crée un raccourci vers le nom de la classe. Confondre ces deux rôles provoque souvent l'erreur `Class "App\\Core\\Router" not found`.

### Fonctionnement dans cette application

Lorsqu'une requête arrive, `public/index.php` est le point d'entrée :

1. Il charge les fichiers nécessaires avec `require_once`.
2. Il crée un objet `App\Core\Router` grâce à l'import `use App\Core\Router`.
3. Il enregistre les routes en utilisant `ProductController::class`. Cette constante fournit le nom complet `App\Controllers\ProductController`.
4. Le routeur instancie le contrôleur correspondant à l'URL.
5. Le contrôleur utilise `App\Models\ProductModel`, qui utilise lui-même `App\Core\Database`.

### Actions à faire lors de l'ajout de nouvelles classes dans l'application

Pour ajouter une nouvelle classe, il faut donc déclarer un namespace cohérent avec son rôle, importer les classes utilisées avec `use`, puis charger le fichier avec `require_once` tant qu'aucun autoloader Composer n'est installé.

## Principe de l'architecture MVC

Les classes PHP utilisent des namespaces sous le préfixe `App` :

- `App\Env` pour les données liées à l'environnement et spécifique à l'utilisateur parfois
- `App\Core` pour les classes techniques (`Router`, `Controller`, `Database`)
- `App\Models` pour les modèles de données (`ProductModel`)
- `App\Controllers` pour les contrôleurs (`ProductController`)

Le point d'entrée importe les classes avec `use` et utilise `ProductController::class` dans les routes. Les fichiers sont chargés avec `require_once`, ce qui permet à l'application de fonctionner sans installer de dépendance supplémentaire.

- **Modèle** (`models/`) : dialogue avec la base de données (requêtes SQL via PDO). Ne sait rien de l'affichage.
- **Vue** (`views/`) : uniquement de l'affichage (HTML), reçoit des données déjà préparées.
- **Contrôleur** (`controllers/`) : reçoit la requête, appelle le modèle, choisit la vue à afficher.
- **Routeur** (`core/Router.php`) : fait le lien entre une URL/méthode HTTP et une action de contrôleur.

Toutes les requêtes passent par `public/index.php` (front controller), qui délègue au routeur.

## Installation

## Installation en mode graphique via l'outil WampServer intégrant pour le serveur de bases de données Mysql et utilisation serveur web intégré à VsCode

0.Lancer Wampserver et vérifier sur le logo W est vert (bon fonctionnement)

1.Créer la base de données et la table (en mode graphique):

``` * Se connecter à phpMyadmin
       * Via l'onglet importer, insérer le contenu du fichier database.sql
```

2.Adapter les identifiants dans `config/database.php` si besoin (host, user, mot de passe).

3.Se placer sur la page d'accueil du site dans Vscode puis lancer le serveur PHP
4.Si le serveur est déjà lancé, faire un clic droit sur la page pour demander à l'afficher dans le navigateur.

## Installation en ligne de commande et avec serveurs PHP et Mysql distincts

1.Créer la base de données et les tables (en ligne de commande):

```bash
   mysql -u root -p < sql/database.sql
```

2.Adapter les identifiants dans `config/database.php` si besoin (host, user, mot de passe).

3.Lancer un serveur PHP intégré depuis la racine du projet :

```bash
   php -S localhost:8000
```

4.Ouvrir dans le navigateur :

```bash
   http://localhost:8000/public/produits
```

## Fonctionnalités

- Lister les produits
- Ajouter un produit
- Modifier un produit
- Supprimer un produit

## Pourquoi cette architecture ?

- **Séparation des responsabilités** : modifier l'affichage n'impacte pas la logique métier, et changer de moteur de BDD n'impacte que le modèle.
- **Maintenabilité** : chaque fichier a un rôle clair et limité.
- **Évolutivité** : il est facile d'ajouter un nouveau "module" (ex: `UserModel`, `UserController`, `views/users/`) en suivant le même schéma.

## Aller plus loin

Pour un vrai projet, on ajouterait généralement :

- Validation des données plus robuste (et protection CSRF sur les formulaires)
- Gestion des erreurs et des sessions / authentification

- Un autoloader (PSR-4 via Composer) plutôt que des `require_once` manuels
- Éventuellement migrer vers un micro-framework (Slim) ou un framework complet (Laravel, Symfony) une fois le projet plus conséquent
