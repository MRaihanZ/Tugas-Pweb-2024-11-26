<?php

namespace App\Routers;

class Router
{
    private static $routes = [];

    public static function get($uri, $controller, $controllerFunction):void
    {
        $method = "get";
        $input = preg_match('/^\/api\/v1\/comments\/(\d+)\/(\d+)$/', $uri, $matches);
        if ($input === false) {
            self::$routes[] = compact('method', 'uri', 'controller', 'controllerFunction');
        } else {
            $data = [$matches[1], $matches[2]];
            self::$routes[] = compact('method', 'uri', 'data', 'controller', 'controllerFunction');
        }
    }
    public static function post($uri, $controller, $controllerFunction):void
    {
        $method = "post";
        self::$routes[] = compact('method', 'uri', 'controller', 'controllerFunction');
    }

    public static function dispatch($method, $uri)
    {
        foreach (self::$routes as $route) {
            if ($method === $route['method'] && $uri === $route['uri']) {
                $controller = $route['controller'];
                $controller = "App\\Controller\\$controller";
                $controller = new $controller();
                if(isset($route["data"])) {
                    return $controller::$route['controllerFunction']($route['data']);
                } else {
                    return $controller::$route['controllerFunction']();
                }
            }
        }
        echo json_encode(['success' => false, 'message' => 'Route not found']);
    }
}
