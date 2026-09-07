<?php
// core/Router.php

namespace App\Core;

class Router
{
    private array $routes = [];

    /**
     * Enregistre une route : ex. add('GET', '/produits', 'ProductController', 'index')
     */
    public function add(string $method, string $path, string $controller, string $action): void
    {
        $this->routes[] = [
            'method'     => $method,
            'path'       => $path,
            'controller' => $controller,
            'action'     => $action,
        ];
    }

    /**
     * Analyse la requête courante et exécute l'action correspondante.
     */
    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // On retire le préfixe éventuel (ex: /mvc-app/public)
        $basePath = '/public';
        $uri = str_replace($basePath, '', $uri);
        $uri = rtrim($uri, '/') ?: '/';

        foreach ($this->routes as $route) {
            // Transforme /produits/{id} en regex
            $pattern = preg_replace('#\{(\w+)\}#', '(?P<$1>[^/]+)', $route['path']);
            $pattern = '#^' . $pattern . '$#';

            if ($route['method'] === $method && preg_match($pattern, $uri, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                $controllerClass = $route['controller'];
                $controller = new $controllerClass();
                call_user_func_array([$controller, $route['action']], $params);
                return;
            }
        }

        http_response_code(404);
        echo "404 - Page non trouvée";
    }
}
