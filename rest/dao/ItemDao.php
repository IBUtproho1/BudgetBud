<?php
class ItemDao{

  private $conn;

  public function __construct(){
    $servername = "localhost";
    $username = "root";
    $password = "tarikproho1";
    $schema = "budgetBud";

    // Create connection
    $this->conn = new PDO("mysql:host=$servername;dbname=$schema", $username, $password);
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

public function get_all(){
  $stmt = $this->conn->prepare("SELECT * FROM items");
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function get_by_id($id){
  $stmt = $this->conn->prepare("SELECT * FROM items WHERE Id = :id");
  $stmt->execute(['id' => $id]);
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return @reset($result);
}


public function add($todo){
  $stmt = $this->conn->prepare("INSERT INTO items (name) VALUES (:name)");
  $result = $stmt->execute($todo);
  $todo['id'] = $this->conn->lastInsertId();
  return $todo;
}

public function delete($id){
  $stmt = $this->conn->prepare("DELETE FROM items WHERE Id=:id");
  $stmt->execute(['id' => $id]);
}

public function update($todo){
  $stmt = $this->conn->prepare("UPDATE items SET name=:name WHERE Id=:id");
  $stmt->execute($todo);
}

}

 ?>
