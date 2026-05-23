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

    public function deleteOnValue($table, $column, $value)
    {
        try {
            $sql = $this->pdo->prepare("DELETE FROM `$table` WHERE `$column` = :value");
            $sql->execute([':value' => $value]);

            if ($sql->rowCount() > 0) {
                return ['success' => true, 'deleted' => $sql->rowCount()];
            } else {
                return ['success' => false, 'message' => 'Запись не найдена'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Ошибка: ' . $e->getMessage()];
        }
    }
    public function update($table, $data, $where, $whereValue)
    {

        $setParts = [];
        foreach (array_keys($data) as $column) {
            $setParts[] = "`$column` = :$column";
        }
        $setClause = implode(', ', $setParts);


        $sql = "UPDATE `$table` SET $setClause WHERE `$where` = :where_value";


        $data['where_value'] = $whereValue;


        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute($data);

        if ($result) {
            return ['success' => true, 'message' => 'Запись обновлена'];
        } else {
            return ['success' => false, 'message' => 'Ошибка обновления'];
        }
    }
    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }
    public static function deletes($table, $column, $value)
    {
        return self::getInstance()->deleteOnValue($table, $column, $value);
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
    public static function updateRow($table, $data, $where, $whereValue)
    {
        return self::getInstance()->update($table, $data, $where, $whereValue);
    }
}
