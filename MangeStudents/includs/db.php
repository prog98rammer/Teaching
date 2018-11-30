<?php

class Database
{
    const DB_NAME = "Teaching";
    const DB_USER = "root";
    const DB_PASS = "";
    const DB_HOST = "localhost";
    private static $pdoOptions = [
        PDO::MYSQL_ATTR_INIT_COMMAND => "set Names utf8"
    ];


    function connect($name, $host, $user, $password)
    {
        try {

            $connect = new PDO("mysql:host={$host};dbname={$name}", $user,$password, static::$pdoOptions);
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
