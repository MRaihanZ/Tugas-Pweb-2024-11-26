<?php

namespace App\Routers;

use App\Controllers\CommentController;

class Router
{
    private static $routes = [];
    public static function get($uri, $controller, $controllerFunction): void
    {
        $method = "GET";
        $input = preg_match_all('/\{([^}]+)\}/', $uri, $matches);

        if ($input > 0) {
            $data = $matches[1];
            self::$routes[] = compact('method', 'uri', 'data', 'controller', 'controllerFunction');
        } else {
            self::$routes[] = compact('method', 'uri', 'controller', 'controllerFunction');
        }
    }

    public static function post($uri, $controller, $controllerFunction):void
    {
        $method = "POST";
        self::$routes[] = compact('method', 'uri', 'controller', 'controllerFunction');
    }

    public static function dispatch($uri, $method)
    {
        foreach (self::$routes as $route) {
            if ($method === $route['method']) {
                if ($route["uri"] !== urldecode($uri)) {
                    $uri = urldecode($uri);
                }

                $newUri = $route["uri"];
                $input = preg_match_all('/\{([^}]+)\}/', $uri, $matches);
    
                if ($input > 0) {
                    $data = $route["data"];
                    foreach ($matches[1] as $index => $value) {
                        $newUri = str_replace("{" . $data[$index] . "}", "{".$matches[1][$index]."}", $newUri);
                    }
                }
                if ($method === "GET" && $uri === $newUri) {
                    $controller = $route['controller'];
                    $controllerFunction = $route['controllerFunction'];
    
                    if ($input > 0) {
                        return $controller::$controllerFunction($matches[1]);
                    } else {
                        return $controller::$controllerFunction();
                    }
                } elseif ($method === "POST" && $uri === $newUri) {
                    $json_data = file_get_contents("php://input");
                    $data = json_decode($json_data, true);
                    var_dump($data);
                    $controller = $route['controller'];
                    $controllerFunction = $route['controllerFunction'];

                    if (json_last_error() === JSON_ERROR_NONE) {
                        return $controller::$controllerFunction($data);
                    } else {
                        echo json_encode(['success' => false, 'code' => 400, 'message' => 'Invalid JSON']);
                        exit();
                    }
                }
            }
        }
    
        echo json_encode(['success' => false, 'code' => 500, 'message' => 'Route not found']);
    }    
}