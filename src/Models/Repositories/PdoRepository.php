<?php

namespace Morainstein\Mvc\Models\Repositories;
use Morainstein\Mvc\Controllers\UserController;
use Morainstein\Mvc\Models\Entities\EntityException;
use Morainstein\Mvc\Models\Entities\Entity;
use Morainstein\Mvc\Utils\Util;
use PDO;
use Ramsey\Uuid\Uuid;

class PdoRepository implements Repository
{

  protected PDO $conn;
  protected string $table = "";

  protected function __construct()
  {
    $this->conn = Util::generateConn();
  }


  
  protected function add(Entity $entity) 
  {
    $columns = [];
    $binds = [];
    $values = [];
    foreach($entity as $key => $value){
      if(!is_null($value)){
        $columns[] = $key;
        $binds[] = "?";
        $values[] = $value;
      }
    }
    
  if($_SERVER['REQUEST_METHOD'] === 'POST'){

  //my code here
    $first="SELECT * FROM {$this->table} WHERE email = ?;";
    $stmt = $this->conn->prepare($first);
    $stmt->execute([$_SESSION['email']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if($user){
      session_abort();
      throw new EntityException(EntityException::USER_EXISTS);
    }


    $columns = implode(", ",$columns);
    $binds = implode(", ",$binds);
    
    $query = "INSERT INTO {$this->table} (id, $columns) VALUES (?, $binds);";

    $pdoStatment = $this->conn->prepare($query);
    $pdoStatment->bindValue(1,Uuid::uuid4()->toString());

    $i = 2;
    foreach($values as $val){
      $pdoStatment->bindValue($i++,$val);
    }

    return $pdoStatment->execute();
  }
  }
  protected function remove(string $id) : bool
  {
    $query = "DELETE FROM {$this->table} WHERE id = :id";
    $pdoStatment = $this->conn->prepare($query);
    $pdoStatment->bindValue(':id',$id);
    return $pdoStatment->execute();
  }

  protected function update(Entity $entity) : bool
  {
    
    $columnsAndBinds = [];
    $bindsAndValues = [];
    $id = "";
    foreach($entity as $key => $value){
      if(!is_null($value)){

        if($key == "id"){
          $id = $value;
          continue;
        }

        $columnsAndBinds[] = "$key = :$key";
        $bindsAndValues[] = [":$key",$value];
      }
    }

    $columnsAndBinds = implode(", ",$columnsAndBinds);

    $query = "UPDATE {$this->table} SET $columnsAndBinds WHERE id = :id";
    $pdoStatment = $this->conn->prepare($query);
    

    foreach($bindsAndValues as $value){
      $pdoStatment->bindValue($value[0],$value[1]); 
    }

    $pdoStatment->bindValue(':id',$id);

    return $pdoStatment->execute();
  }

  protected function findById(string $entityId) : ?array
  {
    $query = "SELECT * FROM {$this->table} WHERE id = :id";
    $pdoStatment = $this->conn->prepare($query);
    $pdoStatment->bindValue(':id',$entityId);
    $pdoStatment->execute();
    $result = $pdoStatment->fetch();

    if($result){
      return $result;
    }

    return null;
  }


  protected function all() : ?array
  {
    $query = "SELECT * FROM {$this->table}";
    $pdoStatment = $this->conn->prepare($query);
    $pdoStatment->execute();
    $result = $pdoStatment->fetchAll();

    if($result){
      return $result;
    }

    return null;
  }

}
