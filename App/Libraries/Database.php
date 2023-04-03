<?php
namespace App\Libraries;

class Database
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "12Qwerty@";
    private $dbname = "notes_app";
    private $conn;
    public function __construct()
    {
        $this->conn = new \mysqli(
            $this->host,
            $this->user,
            $this->pass,
            $this->dbname,
        );
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        } else {
        }
    }
    public function execute($query)
    {
        $result = $this->conn->query($query);
        return $result;
    }
}
