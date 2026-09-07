<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titre ?? 'Exemple d\'une application MVC') ?></title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <header class="site-header">
        <nav class="site-nav" aria-label="Navigation principale">
            <a class="site-brand" href="/public/produits">Gestion des produits</a>
        </nav>
    </header>

    <main class="page-content">