<?php
class Router {
    private $routes = [];

    public function addRoute($method, $path, $controller, $action) {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function handleRequest($method, $path) {
        foreach ($this->routes as $route) {
            $pattern = $this->convertPath($route['path']);
            if (preg_match($pattern, $path, $matches) && $route['method'] === $method) {
                array_shift($matches);
                $controllerName = "App\\Controllers\\" . $route['controller'];
                $controller = new $controllerName();
                call_user_func_array([$controller, $route['action']], $matches);
                return;
            }
        }
       
        http_response_code(404);
        echo json_encode(["status" => "error", "message" => "Route not found"]);
    }

    private function convertPath($path) {
        return '@^' . preg_replace('/\/{(.*?)}/', '/([^/]+)', $path) . '$@D';
    }
}