<?php

class Database
{
    private $name = "Teaching";
    private $user = "root";
    private $pass = "";
    private $host = "localhost";
    private static $pdoOptions = [
        PDO::MYSQL_ATTR_INIT_COMMAND => "set Names utf8"
    ];


    function function __construct()
    {
        try {

            $connect = new PDO("mysql:host={$this->host};dbname={$this->name}", $this->user, $this->password, static::$pdoOptions);
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connect;

        } catch(PDOException  $e) {
            echo "Error: Connect <p style='color: red'>".$e->getMessage()."</p>";
        }
    }

    private function db($db, $query, $params = []) {
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }

    function getData($db, $query, $params = []) {
        return $this->db($db, $query, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    function setData($db, $query, $params = []) {
        return $this->db($db, $query, $params)->rowCount();
    }
}
