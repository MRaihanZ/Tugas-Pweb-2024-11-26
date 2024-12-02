<?php

namespace App\Models;

use App\Models\BaseModel;

class CommentModel extends BaseModel{

    function __construct(string $username, string $password, string $db, string $host = 'localhost')
    {
        parent::__construct($username, $password, $host, $db);
    }
    public static function getAllWithLimit($table, $select, $limit) {
        $query = "ORDER BY id DESC LIMIT " . $limit;
        $result = self::$conn->query("SELECT {$select} FROM {$table} {$query}");
        "SELECT * FROM table ORDER BY id DESC LIMIT 5";
        if (!$result) {
            echo json_encode(['success' => false, 'code' => 500, 'body' => ["message" => "Failed to retrieve data from database"]]);
        } else {
            $rows = [];
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row["comment"];
            };
        };
        return $rows;
    }
}