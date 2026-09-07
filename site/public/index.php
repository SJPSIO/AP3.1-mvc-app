<?php
// public/index.php

declare(strict_types=1);

use App\Controllers\ProductController;
use App\Core\Router;

require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../controllers/ProductController.php';

$router = new Router();

// Définition des routes
$router->add('GET',    '/produits',                ProductController::class, 'index');
$router->add('GET',    '/produits/create',         ProductController::class, 'create');
$router->add('POST',   '/produits/create',         ProductController::class, 'store');
$router->add('GET',    '/produits/{id}/edit',      ProductController::class, 'edit');
$router->add('POST',   '/produits/{id}/edit',      ProductController::class, 'update');
$router->add('POST',   '/produits/{id}/delete',    ProductController::class, 'destroy');

// Page d'accueil : redirige vers la liste des produits
$router->add('GET', '/index.php', ProductController::class, 'index');
$router->add('GET', '/', ProductController::class, 'index');

$router->dispatch();
