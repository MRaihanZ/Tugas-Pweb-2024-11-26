<?php
// CORS headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once "autoload.php";

use App\Routers\Router;
use App\Controllers\CommentController;

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

$router = new Router();
$router::get("/api/v1/comments/{start}/{limit}", CommentController::class ,"getComments");
$router::get("/api/v1/comment/lastid", CommentController::class ,"getLastCommentId");
$router::post("/api/v1/comment",CommentController::class ,"postComment");
Router::dispatch($requestUri, $requestMethod );