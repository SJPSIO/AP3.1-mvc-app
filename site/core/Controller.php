<?php
// core/Controller.php

namespace App\Core;

class Controller
{
    /**
     * Charge une vue en lui passant des données.
     */
    protected function render(string $view, array $data = []): void
    {
        // Rend les variables du tableau $data disponibles dans la vue
        extract($data);

        $viewPath = __DIR__ . '/../views/' . $view . '.php';

        if (!file_exists($viewPath)) {
            die("Vue introuvable : {$view}");
        }

        require_once $viewPath;
    }

    /**
     * Redirige vers une autre URL puis arrête le script.
     */
    protected function redirect(string $url): void
    {
        header("Location: {$url}");
        exit;
    }
}
