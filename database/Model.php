<?php

namespace Database;

use Database\DataBase;
use PDO;
use PDOException;

class Model
{
    protected array $data = [];

    protected $dbConn;

    protected $tableName;
    public function __construct()
    {
        $db = new DataBase();
        $this->dbConn = $db->dbConnect();
    }

    public function create($data):bool
    {
        $columns = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO $this->tableName ($columns) VALUES ($values)";

        $stmt = $this->dbConn->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }

    public function read($id)
    {
        $sql = "SELECT * FROM $this->tableName WHERE id = :id";

        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result : null;
    }

    public function update($id, $data):bool
    {
        $setClause = '';

        foreach ($data as $key => $value) {
            $setClause .= "$key = :$key, ";
        }
        $setClause = rtrim($setClause, ', ');

        $sql = "UPDATE `" . $this->tableName . "` SET $setClause WHERE id = :id";

        $stmt = $this->dbConn->prepare($sql);

        $stmt->bindValue(':id', $id);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }

    public function delete($id):bool
    {
        $sql = 'DELETE FROM $this->tableName WHERE id = :id';

        $stmt = $this->dbConn->prepare($sql);

        $stmt->bindValue(':id', $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function find($id_array, string $primary_key = "id")
    {
        if (is_array($id_array)){
            $ids = implode(', ', array_values($id_array));
        }else{
            $ids = $id_array;
        }

        $sql = "SELECT * FROM $this->tableName WHERE $primary_key IN ($ids)";

        //SELECT * FROM `redirect` WHERE id IN (1,2,3);

        $stmt = $this->dbConn->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result ? $result : null;
    }//to find out elements by ids and their key

    public function first(array $conditions = [], string $orderBy = "id")
    {
        $setClause = '';
        foreach ($conditions as $key => $value) {
            $setClause .= "$key = :$key AND ";
        }
        $setClause = rtrim($setClause, 'AND ');

        $sql = "SELECT * FROM $this->tableName";
        if (!empty($setClause)) {
            $sql .= " WHERE $setClause";
        }
        $sql .= " ORDER BY $orderBy LIMIT 1";

        $stmt = $this->dbConn->prepare($sql);

        foreach ($conditions as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result : null;
    }

    public function get(array $conditions = [], string $orderBy = "id", int $limit = null, int $offset = 0)
    {
        $whereClause = '';
        foreach ($conditions as $key => $value) {
            $whereClause .= "$key = :$key AND ";
        }
        $whereClause = rtrim($whereClause, 'AND ');

        $sql = "SELECT * FROM $this->tableName";
        if (!empty($whereClause)) {
            $sql .= " WHERE $whereClause";
        }
        $sql .= " ORDER BY $orderBy";

        if ($limit !== null) {
            $sql .= " LIMIT $limit";
            if ($offset > 0) {
                $sql .= " OFFSET $offset";
            }
        }

        $stmt = $this->dbConn->prepare($sql);

        foreach ($conditions as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result ? $result : null;
    }

    public function searchKey(string $key, string $value)
    {
        $sql = "SELECT * FROM `" . $this->tableName . "` WHERE " . $key . " = '" . $value . "'";

        $stmt = $this->dbConn->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result : null;
    }//столбец / значение
}