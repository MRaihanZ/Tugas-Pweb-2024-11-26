<?php

namespace App\Models;

use App\Models\BaseModel;

class CommentModel extends BaseModel{

    function __construct(string $username, string $password, string $db, string $host = 'localhost')
    {
        parent::__construct($username, $password, $host, $db);
    }
    public static function getAllWithLimit($table, $select, $start, $limit) {
        $query = "WHERE id <= $start ORDER BY id DESC LIMIT 5;";
        $result = self::$conn->query("SELECT {$select} FROM {$table} {$query}");
        if (!$result) {
            echo json_encode(['success' => false, 'code' => 500, 'body' => ["message" => "Failed to retrieve data from database"]]);
        } else {
            $ids = [];
            $comments = [];
            while ($row = $result->fetch_assoc()) {
                $comments[] = $row["comment"];
                $ids[] = $row["id"];
            };
            $datas = ["id" => $ids,"comment"=> $comments];
        };
        return $datas;
    }

    public static function getLastIdComment($table, $select) {
        $query = "ORDER BY id DESC LIMIT 1;";
        $result = self::$conn->query("SELECT {$select} FROM {$table} {$query}");
        if (!$result) {
            echo json_encode(['success' => false, 'code' => 500, 'body' => ["message" => "Failed to retrieve data from database"]]);
        } else {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data = ["id" => $row["id"]];
            };
        };
        return $data;
    }

    public static function postComment($comment) {
        $result = self::$conn->query("INSERT INTO comment (id, comment) VALUES ('','$comment')");
        if (!$result) {
            echo json_encode(['success' => false, 'code' => 500, 'body' => ["message" => "Failed to retrieve data from database"]]);
        } else {
            $data = "Comment posted successfully";
        };
        return $data;
    }
}