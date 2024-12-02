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
        print_r("<br/>");
        print_r($input);
        print_r("<br/>");
        if ($input < 0) {
            print_r("False");
            print_r("<br/>");
            self::$routes[] = compact('method', 'uri', 'controller', 'controllerFunction');
        } else {
            print_r(value: "True");
            print_r("<br/>");
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
            print_r("Before Method");
            print_r("<br/>");
            if ($method === $route['method']) {
                print_r("Method True");
                print_r("<br/>");
                print_r($uri);
                print_r("<br/>");
                print_r(urldecode($uri));
                print_r("<br/>");
                $uri = urldecode($uri);
                $input = preg_match_all('/\{([^}]+)\}/', $uri, $matches);
                if ($input > 0) {
                    print_r("TRUE FROM REGEX");
                    print_r("<br/>");
                    $data = $route["data"];
                    foreach($matches[1] as $index => $value) {
                        $newUri = str_replace(("{".$data[1][$index]."}"), $matches[1][$index], $uri);
                    }
                    print_r($route["uri"]);
                    print_r("<br/>");
                    print_r($newUri);
                    print_r("<br/>");
                }
                if($newUri === $uri) {
                    print_r("URI True");
                    print_r("<br/>");
                    print_r($route['controllerFunction']);
                    print_r("<br/>");
                    $controller = $route['controller'];
                    $controllerFunction = $route['controllerFunction'];
                    if(isset($route["data"])) {
                        return $controller::$controllerFunction($route['data']);
                    } else {
                        return $controller::$controllerFunction();
                    }
                }
                
            }
        }
        echo json_encode(['success' => false, 'message' => 'Route not found']);
    }
}
