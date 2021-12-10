<?php

namespace database;
use PDO;

class DbConnection
{
    private static $db;
    protected $configs = array();
    private $pdo;

    function __construct()
    {
        $configs = include('config.php');

        try {

            $this->pdo = new PDO('mysql:host=' . $configs->host . ';dbname=' . $configs->db_name . ';charset=utf8mb4', $configs->db_username, $configs->db_password);
        } catch (PDOException $e) {
            exit('Error Connecting To DataBase');
        }
    }

    public static function getConnection()
    {
        if (self::$db == null) {
            self::$db = new DbConnection();
        }
        return self::$db;
    }

    function __destruct()
    {
        $this->pdo = NULL;
    }

    public function query($myquery)
    {
        $query = $this->pdo->prepare($myquery);
        $query->execute();
        return $query->fetchAll();
    }

}

