<?php

namespace App;

class Router
{
    private $routes = [];

    public function get($uri, $controller):void
    {
        $method = "get";
        $this->routes[] = compact('method', 'uri', 'controller');
    }
    public function post($uri, $controller):void
    {
        $method = "post";
        $this->routes[] = compact('method', 'uri', 'controller');
    }

    public function dispatch($method, $uri)
    {
        foreach ($this->routes as $route) {
            if ($method === $route['method'] && $uri === $route['uri']) {
                list($controller, $action) = explode('@', $route['controller']);
                
                $controller = "App\\Controller\\$controller";
                $controller = new $controller();
                return $controller->$action();
            }
        }
        
        echo "404 Not Found";
    }
}
