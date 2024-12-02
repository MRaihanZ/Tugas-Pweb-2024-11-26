<?php
require_once "autoload.php";

use App\Routers\Router;
use App\Controllers\CommentController;

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

$router = new Router();
$router::get("/api/v1/comments/{limit}", CommentController::class ,"getComments");
$router::post("/api/v1/comment",CommentController::class ,"postComment");
Router::dispatch($requestUri, $requestMethod );