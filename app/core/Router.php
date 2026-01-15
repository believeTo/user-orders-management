<?php

namespace App\Core;

class Router {
    private $routes = [
        '' => ['controller' => 'App\Controllers\OrderController', 'action' => 'index'],
        'orders' => ['controller' => 'App\Controllers\OrderController', 'action' => 'index'],
    ];

    public function run() {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = trim($uri, '/');

        if (array_key_exists($uri, $this->routes)) {
            $route = $this->routes[$uri];
        } else {
            $segments = explode('/', $uri);
            $controllerName = ucfirst($segments[0] ?? 'Order') . 'Controller';
            $actionName = $segments[1] ?? 'index';

            $route = ['controller' => $controllerName, 'action' => $actionName];
        }

        $controllerName = $route['controller'];
        $actionName = $route['action'];

        if (class_exists($controllerName)) {
            $controller = new $controllerName();
            if (method_exists($controller, $actionName)) {
                $controller->$actionName();
            } else {
                $this->error404();
            }

        } else {
            $this->error404();
        }
    }

    private function error404() {
        header("HTTP/1.0 404 Not Found");
        echo "404 Page Not Found";
        exit();
    }
}