<?php
require_once "../autoload.php";

use App\Routers\Router;
use App\Controllers\Controller;

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

$router = new Router();
$router::get("/api/v1/comments/{start}/{limit}", Controller::class ,"getComments");
$router::post("/api/v1/comment",Controller::class ,"postComment");

Router::dispatch($requestUri, $requestMethod);