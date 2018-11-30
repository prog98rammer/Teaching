<?php
class Database
{
    function PDO ($dbName="Teaching",$dbUser="root",$dbPass="",$dbHost="localhost")
    {
        try
        {
            $Connect= new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser,$dbPass,[PDO::MYSQL_ATTR_INIT_COMMAND=>"set Names utf8"]);
            $Connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $Connect;
        }catch(PDOException  $e)
        {
            echo "Error: Connect <p style='color: red'>".$e->getMessage()."</p>";
        }
    }
    function getData($db,$query,$parm = []) {
        $stmt = $db->prepare($query);
        $stmt->execute($parm);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
}
    function setData($db,$query,$parm = []) {
        $stmt = $db->prepare($query);
        $stmt->execute($parm);
        $count = $stmt->rowCount();
        return $count;
    }
}
?>