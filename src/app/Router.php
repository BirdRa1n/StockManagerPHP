<?php
class Router {
    private $routes = [];
    
    public function get($path, $callback) {
        $this->routes['GET'][$path] = $callback;
    }
    
    public function post($path, $callback) {
        $this->routes['POST'][$path] = $callback;
    }
    
    public function run() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        $path = rtrim($path, '/');
        if (empty($path)) $path = '/';
        
        // Check exact match first
        if (isset($this->routes[$method][$path])) {
            return $this->executeCallback($this->routes[$method][$path]);
        }
        
        // Check pattern matches
        foreach ($this->routes[$method] ?? [] as $route => $callback) {
            if ($this->matchRoute($route, $path)) {
                return $this->executeCallback($callback, $this->extractParams($route, $path));
            }
        }
        
        http_response_code(404);
        echo "404 - Página não encontrada: " . $path;
    }
    
    private function matchRoute($route, $path) {
        $routePattern = preg_replace('/\{[^}]+\}/', '([^/]+)', $route);
        return preg_match('#^' . $routePattern . '$#', $path);
    }
    
    private function extractParams($route, $path) {
        $routePattern = preg_replace('/\{[^}]+\}/', '([^/]+)', $route);
        preg_match('#^' . $routePattern . '$#', $path, $matches);
        return array_slice($matches, 1);
    }
    
    private function executeCallback($callback, $params = []) {
        if (is_array($callback)) {
            [$controller, $method] = $callback;
            return call_user_func_array([$controller, $method], $params);
        }
        return call_user_func_array($callback, $params);
    }
}