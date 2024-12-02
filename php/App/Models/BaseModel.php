<?php

namespace App\Models;

class BaseModel {
    private string $host;
    private string $username;
    private string $password;
    protected static $conn;
    protected function __construct(string $username, string $password, string $host, string $db)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->connectDb($db);
    }

    private function connectHostDb()
    {
        self::$conn = new \mysqli($this->host, $this->username, $this->password);
        if (self::$conn->connect_errno) {
            echo json_encode(['success' => false, 'code' => 500, 'body' => ["message" => "Failed to connect to MySQL: " . self::$conn->connect_error]]);
            exit();
        }
    }

    private function connectDb(string $db)
    {
        $this->connectHostDb();
        if (!self::$conn->select_db($db)) {
            echo json_encode(['success' => false, 'code' => 500, 'body' => ["message" => "Failed to select database: " . self::$conn->error]]);
            exit();
        }
    }

    function __destruct()
    {
        if (self::$conn) {
            self::$conn->close();
        }
    }
}