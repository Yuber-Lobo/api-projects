<?php

class Router {
    private $routes = [];

    public function add($methods, $path, $controller, $action) {
        if (!is_array($methods)) {
            $methods = [$methods];
        }
        foreach ($methods as $method) {
            $this->routes[] = [
                'method' => $method,
                'path' => $path,
                'controller' => $controller,
                'action' => $action
            ];
        }
    }

    public function handle($method, $uri) {
        $path = parse_url($uri, PHP_URL_PATH);
        
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $this->matchPath($route['path'], $path, $params)) {
                $controller = new $route['controller'](Database::getInstance()->getConnection());
                $queryParams = [];
                if (isset(parse_url($uri)['query'])) {
                    parse_str(parse_url($uri)['query'], $queryParams);
                }
                call_user_func_array([$controller, $route['action']], [$params, $queryParams, $method]);
                return;
            }
        }
        
        http_response_code(404);
        echo json_encode(['error' => 'Not Found']);
    }

    private function matchPath($routePath, $uri, &$params) {
        $routeParts = explode('/', trim($routePath, '/'));
        $uriParts = explode('/', trim($uri, '/'));
        
        if (count($routeParts) !== count($uriParts)) {
            return false;
        }

        $params = [];
        for ($i = 0; $i < count($routeParts); $i++) {
            if (strpos($routeParts[$i], ':') === 0) {
                $params[substr($routeParts[$i], 1)] = $uriParts[$i];
            } elseif ($routeParts[$i] !== $uriParts[$i]) {
                return false;
            }
        }

        return true;
    }
}