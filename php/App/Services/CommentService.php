<?php

namespace App\Services;

use App\Models\CommentModel;

class CommentService {
    public static function getCommentWithLimit($data) {
        $CommentModel = new CommentModel("root", "", "tugas_pweb_comment", "localhost");
        $start = $data[0];
        $limit = $data[1];
        $result = $CommentModel::getAllWithLimit("comment", "*", $start,$limit);
        return $result;
    }

    public static function getLastIdComment() {
        $CommentModel = new CommentModel("root", "", "tugas_pweb_comment", "localhost");
        $result = $CommentModel::getLastIdComment("comment", "id");
        return $result;
    }

    public static function postComment($comment) {
        $CommentModel = new CommentModel("root", "", "tugas_pweb_comment", "localhost");
        $result = $CommentModel::postComment($comment);
        return $result;
    }
}