<?php

namespace Morainstein\Mvc\RouteHandler;

class Router
{
    static private array $getRoutes;
    static private array $postRoutes;

    static public function get(string $path, string $controllerName, string $controllerMethod): void
    {
        self::$getRoutes[$path] = [$controllerName, $controllerMethod];
    }

    static public function post(string $path, string $controllerName, string $controllerMethod): void
    {
        self::$postRoutes[$path] = [$controllerName, $controllerMethod];
    }

    static public function realize()
    {
        /**
         * Identifica a rota e o método HTTP da requisição.
         * 
         */
        $path = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $routes = self::$getRoutes;
        } else if ($method === 'POST') {
            $routes = self::$postRoutes;
        } else {
            http_response_code(405);
            return;
        }

        /**
         * Verifica se a rota existe.
         */
        if (!array_key_exists($path, $routes)) {
            http_response_code(404);
                // echo "Rota não encontrada: " . $_SERVER['PATH_INFO'];
            return;
        }

        /**
         * Instancia o controller e chama o método correspondente à rota.
         */
        $controllerName = $routes[$path][0];
        $controllerMethod = $routes[$path][1];

        $controller = new $controllerName();
        $controller->$controllerMethod();


    }
}