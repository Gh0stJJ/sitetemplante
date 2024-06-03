<?php

require_once 'database.php';

class ORM {
  private $conn;

    public function __construct() {
        $this->conn = (new Database())->getConnection();
    }

    private function getTableName($object) {
        $reflection = new ReflectionClass($object);
        return strtolower($reflection->getShortName());
    }

    // Reflection ✨
    public function insert($object) {
        $table = $this->getTableName($object);
        $reflection = new ReflectionClass($object);
        $properties = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);

        $columns = [];
        $values = [];
        $placeholders = [];

        foreach ($properties as $property) {
            $columns[] = $property->getName();
            $values[$property->getName()] = $property->getValue($object);
            $placeholders[] = ':' . $property->getName();
        }

        $columnsString = implode(", ", $columns);
        $placeholdersString = implode(", ", $placeholders);

        $query = "INSERT INTO " . $table . " ($columnsString) VALUES ($placeholdersString)";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        foreach ($values as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }

        return $stmt->execute();
    }

    // Select * from table
    public function read($object, $id) {
        $table = $this->getTableName($object);
        $query = "SELECT * FROM " . $table . " WHERE id = :id LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            foreach ($row as $key => $value) {
                $object->$key = $value;
            }
            return true;
        }

        return false;
    }

    

    // get all
    public function all($object) {
        $table = $this->getTableName($object);
        $query = "SELECT * FROM " . $table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    // update
    public function update($object, $id) {
        $table = $this->getTableName($object);
        $reflection = new ReflectionClass($object);
        $properties = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);

        $columns = [];
        $values = [];

        foreach ($properties as $property) {
            $columns[] = $property->getName() . " = :" . $property->getName();
            $values[$property->getName()] = $property->getValue($object);
        }

        $columnsString = implode(", ", $columns);
        $query = "UPDATE " . $table . " SET $columnsString WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        foreach ($values as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }

    // remove
    public function delete($object) {
        $table = $this->getTableName($object);
        $id = $object->id;
        $query = "DELETE FROM " . $table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    // find by
    public function findBy($object, $column, $value) {
      $table = $this->getTableName($object);
      $query = "SELECT * FROM " . $table . " WHERE " . $column . " = :value";
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':value', $value);
      $stmt->execute();

      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $results;
  }

  //Get the contact country

    public function getCountry($object, $id) {
        $table = $this->getTableName($object);
        $query = "SELECT name FROM " . $table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return $row['name'];
        }
        
    
        return false;
    }
}
?>
