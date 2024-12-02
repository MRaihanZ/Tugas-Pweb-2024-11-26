<?php

namespace App\Services;

use App\Models\CommentModel;

class CommentService {
    public static function getCommentWithLimit($data) {
        $CommentModel = new CommentModel("root", "", "tugas_pweb_comment", "localhost");
        $limit = $data[0];
        $result = $CommentModel::getAllWithLimit("comment", "comment", $limit);
        return $result;
    }
}