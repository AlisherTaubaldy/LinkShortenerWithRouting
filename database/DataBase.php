<?php

namespace Database;

use PDO;
use PDOException;

class DataBase
{
    private $servername = "mysql"; // database Host
    private $dbUsername = "root"; // database Username
    private $dbPassword = "root"; // database Password
    private $dbName = "test"; // database Name

    protected $dbConn;

    public function dbConnect()
    {
        try {
            $this->dbConn = new PDO("mysql:host=$this->servername;dbname=$this->dbName", $this->dbUsername, $this->dbPassword);
            // Set the PDO error mode to exception
            $this->dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->dbConn;
        } catch (PDOException $e) {
            return "Connection failed: " . $e->getMessage();
        }
    }

}

