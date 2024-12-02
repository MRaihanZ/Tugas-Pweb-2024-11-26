<?php

namespace App\Controllers;

use App\Services\CommentService;

class CommentController {
    public static function getComments($data) {
        if (!isset($data)) {
            echo json_encode(['success' => false, 'message' => 'Data is not given in URI']);
            return;
        }
        $comments = CommentService::getCommentWithLimit($data);
        echo json_encode(['success' => true, 'message' => $comments]);
    }
}