<?php
class db {
  protected $server;
  protected $username;
  protected $password;
  protected $dbname;
  protected $connection;
  protected $show_errors = TRUE;
  protected $query_closed = TRUE;
  public $query_count = 0;

  function __construct($server, $username, $password, $dbname) {
    $this->server = $server;
    $this->username = $username;
    $this->password = $password;
    $this->dbname = $dbname;
    try {
      $this->connection = new PDO("mysql:host=$this->server;dbname=$this->dbname", $this->username, $this->password);
      // set the PDO error mode to exception
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //echo "Connected successfully";
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }


  function select($data, $table) {
    try {
      $dataContent = implode(",", $data);
      $stmt = $this->connection->prepare("SELECT $dataContent FROM $table");
      $stmt->execute();

      // set the resulting array to associative
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

      $data = $stmt->fetchAll();
      return $data;
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
  }

  function selectWhere($data, $table, $where) {
    try {
      $stmt = $this->connection->prepare("SELECT $data FROM $table WHERE $where");
      $stmt->execute();

      // set the resulting array to associative
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

      $data = $stmt->fetchAll();
      return $data;
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
  }
  function selectMostRecent($table, $field) {
    try {
      $stmt = $this->connection->prepare("SELECT * FROM $table ORDER BY $field DESC LIMIT 1");
      $stmt->execute();

      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

      $data = $stmt->fetchAll();

      return $data;
    } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }

  }
  function insert($fields, $table, $data) {
    try {
      $dataFields = implode(",", $fields);

      $dataArray = array();
      foreach($data as $content) {
        $content = "'$content'";
        array_push($dataArray, $content);
      }
      $dataContent = implode(",", $dataArray);

      $stmt = $this->connection->prepare("INSERT INTO $table ($dataFields) VALUES ($dataContent)");
      $stmt->execute();

      // set the resulting array to associative
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

      $data = $stmt->fetchAll();
      return $data;
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
  }
}


 ?>
