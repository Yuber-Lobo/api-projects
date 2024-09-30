<?php

namespace src\utils;

use Exception;

class Router
{
    private $routes = [];

    public function addRoute($method, $path, $handler)
    {
        $this->routes[$method][$path] = $handler;
    }

    public function dispatch($method, $uri)
    {
        $path = parse_url($uri, PHP_URL_PATH);
        if (isset($this->routes[$method][$path])) {
            $handler = $this->routes[$method][$path];
            list($controller, $action) = explode('@', $handler);

            $controllerFile = CONTROLLERS_PATH . $controller . '.php';
            if (file_exists($controllerFile)) {
                require_once $controllerFile;
                $controllerClass = "\\src\\controllers\\" . $controller;
                $controllerInstance = new $controllerClass();
                $controllerInstance->$action();
            } else {
                throw new Exception("Controller not found: $controller");
            }
        } else {
            // Handle 404
            header("HTTP/1.0 404 Not Found");
            echo "404 Not Found";
        }
    }
}
