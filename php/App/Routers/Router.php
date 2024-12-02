<?php

namespace App\Routers;

use App\Controllers\CommentController;

class Router
{
    private static $routes = [];

    public static function get($uri, $controller, $controllerFunction):void
    {
        $method = "GET";
        // $checkUri = explode("/", explode("{", $uri)[0]);
        // $input = preg_match('/^\/api\/v1\/comments\/(\d+)\/(\d+)$/', $uri, $matches);
        $input = preg_match_all('/\{([^}]+)\}/', $uri, $matches);
        if ($input < 0) {
            self::$routes[] = compact('method', 'uri', 'controller', 'controllerFunction');
        } else {
            $data = $matches[1];
            self::$routes[] = compact('method', 'uri', 'data', 'controller', 'controllerFunction');
        }
    }
    public static function post($uri, $controller, $controllerFunction):void
    {
        $method = "POST";
        self::$routes[] = compact('method', 'uri', 'controller', 'controllerFunction');
    }

    public static function dispatch($uri, $method,)
    {
        foreach (self::$routes as $route) {
            if ($method === $route['method']) {
                $uri = urldecode($uri);
                $input = preg_match_all('/\{([^}]+)\}/', $uri, $matches);
                if ($input > 0) {
                    $data = $route["data"];
                    foreach($matches[1] as $index => $value) {
                        $newUri = str_replace("{".$data[$index]."}", $matches[1][$index], $uri);
                    }
                }
                if($newUri === $uri) {
                    $controller = $route['controller'];
                    $controllerFunction = $route['controllerFunction'];
                    if(isset($route["data"])) {
                        return $controller::$controllerFunction($matches[1]);
                    } else {
                        return $controller::$controllerFunction();
                    }
                }
                
            }
        }
        echo json_encode(['success' => false, 'code' => 500, 'message' => 'Route not found']);
    }
}
