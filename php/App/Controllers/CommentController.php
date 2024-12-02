<?php

namespace App\Controllers;

use App\Services\CommentService;

class CommentController {
    public static function getComments($data) {
        if (!isset($data)) {
            echo json_encode(['success' => false, 'code' => 500,'message' => 'Data is not given in URI']);
            return;
        }
        $comments = CommentService::getCommentWithLimit($data);
        $body = [];
        foreach ($comments as $index => $value) {
            $body[] = ["comment"=> $comments[$index]];
        };
        echo json_encode(['success' => true, 'code' => 200, 'body' => $body]);
    }
}