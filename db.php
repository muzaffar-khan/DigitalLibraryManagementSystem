<?php
class db
{
    protected $connection;

    function setconnection()
    {
        try {
            $this->connection = new PDO("mysql:host=localhost; dbname=digital_library", "root", "");
        } catch (PDOException $e) {
            echo "Error";
        }
    }
}
?>