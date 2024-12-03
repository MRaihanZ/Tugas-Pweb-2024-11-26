<?php

namespace App\Controllers;

use App\Services\CommentService;

class CommentController {
    public static function getComments($data) {
        if (!isset($data)) {
            echo json_encode(['success' => false, 'code' => 500,'message' => 'Data is not given in URI']);
            return;
        }
        $result = CommentService::getCommentWithLimit($data);
        $body = [];
        foreach ($result["id"] as $index => $id) {
            $body[] = ["id" => $id,"comment"=> $result["comment"][$index]];
        };
        echo json_encode(['success' => true, 'code' => 200, 'body' => $body]);
    }

    public static function getLastCommentId() {
        $result = CommentService::getLastIdComment();
        echo json_encode(['success' => true, 'code' => 200, 'body' => ["id" => $result["id"]]]);
    }

    public static function postComment($comment) {
        echo var_dump($comment);
        if (isset($comment['data']['comment'])) {
            $cleanComment = $comment['data']['comment'];
            $result = CommentService::postComment($cleanComment);
            echo json_encode(['success' => true, 'code' => 200, 'message' => $result]);
        } else {
            echo json_encode(['success' => false, 'code' => 500, 'message' => 'Comment data not found']);
        }
    }
}