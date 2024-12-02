<?php

namespace App\Services;

use App\Models\CommentModel;

class CommentService {
    public static function getCommentWithLimit($data) {
        $start = $data[0];
        $limit = $data[1];
        return $comment = CommentModel::getAllWithLimit($start, $limit);
    }
}