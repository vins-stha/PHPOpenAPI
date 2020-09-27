<?php
namespace database;

class Database
{
    private $host = "localhost";
    private $db_name = "restapi";
    private $table = "posti_address";
    private $username = "root";
    private $password = "";
    private $conn;

    public function __construct()
    {
        $this->conn = null;
    }

    public function dbConnect()
    {
        try {
            $this->conn = new \PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
        } catch (PDOException $e) {
            echo "Could not connect to database " . $e->getMessage();
        }

        return $this->conn;
    }
}
