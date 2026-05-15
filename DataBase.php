<?php
require_once 'dbconn.php';

class DataBase
{

    private static $instance = null;
    private $pdo;

    // Приватный конструктор (синглтон)
    private function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }



    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new DataBase();
        }
        return self::$instance;
    }

    public function getOnceFetch($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch();
    }

    public function getAllFetch($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function execute($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }
    public function insert($table, $data)
    {
        $columns = array_keys($data);
        $columns_str = implode(',', $columns);
        $place_holders = ':' . implode(", :", $columns);
        $insert = $this->pdo->prepare("INSERT INTO $table ($columns_str) VALUES ($place_holders)");
        $insert->execute($data);
        return $this->lastInsertId();
    }
    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }
    public static function OneFetch($sql, $params = [])
    {
        return self::getInstance()->getOnceFetch($sql, $params);
    }
    public static function AllFetch($sql, $params = [])
    {
        return self::getInstance()->getAllFetch($sql, $params);
    }
    public static function insertRow($table, $data = [])
    {
        return self::getInstance()->insert($table, $data);
    }
    public static function execu($sql, $params = [])
    {
        return self::getInstance()->execute($sql, $params);
    }
    public static function lastId()
    {
        return self::getInstance()->lastInsertId();
    }
}
