<?php
require_once "autoload.php";

use App\Routers\Router;
use App\Controllers\CommentController;

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

$router = new Router();
print_r("Before Index Called");
print_r("<br/>");
print_r($requestUri);
print_r("<br/>");
print_r($requestMethod);
print_r("<br/>");
print_r(gettype($requestMethod));
$router::get("/api/v1/comments/{start}/{limit}", CommentController::class ,"getComments");
print_r("api 1 Called");
print_r("<br/>");
$router::post("/api/v1/comment",CommentController::class ,"postComment");
print_r("api 2 Called");
print_r("<br/>");
Router::dispatch($requestUri, $requestMethod );