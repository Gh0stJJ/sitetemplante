<?php
class Database {
  private $host = 'localhost';
  private $user = 'root';
  private $password = 'root';
  private $port = 3306;
  private $database = 'contacts_app';
  private $connection;

  public function __construct() {
    try {
      $this->connection = new PDO("mysql:host={$this->host};port={$this->port};dbname={$this->database}", $this->user, $this->password);
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      die('Connection failed: ' . $e->getMessage());
    }
  }

  public function getConnection() {
    return $this->connection;
  }
}
?>