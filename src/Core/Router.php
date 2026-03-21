<?php

declare(strict_types=1);

namespace App\Core;

class Router
{
    private array $routes = [];

    public function addRoute(string $action, string $controllerClass, string $method): void
    {
        $this->routes[$action] = [
            'controller' => $controllerClass,
            'method' => $method
        ];
    }

    public function dispatch(array $request): string
    {
        $action = $request['action'] ?? '';

        if (!isset($this->routes[$action])) {
            http_response_code(404);
            return json_encode(['success' => false, 'message' => 'Action not found']);
        }

        $route = $this->routes[$action];
        $controllerName = $route['controller'];
        $method = $route['method'];

        if (class_exists($controllerName)) {
            $controller = new $controllerName();
            if (method_exists($controller, $method)) {
                return $controller->$method($request);
            }
        }

        http_response_code(500);
        return json_encode(['success' => false, 'message' => 'Internal Server Error']);
    }
}
