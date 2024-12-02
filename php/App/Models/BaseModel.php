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
            echo "Failed to connect to MySQL: " . self::$conn->connect_error;
            exit();
        }
        echo "success connect host db <br/>";
    }

    private function connectDb(string $db)
    {
        $this->connectHostDb();
        if (!self::$conn->select_db($db)) {
            echo "Failed to select database: " . self::$conn->error;
            exit();
        }
        echo "success connect Db ({$db}) <br/>";
    }

    function __destruct()
    {
        if (self::$conn) {
            self::$conn->close();
            echo "closing db connection <br/>";
        }
    }
}