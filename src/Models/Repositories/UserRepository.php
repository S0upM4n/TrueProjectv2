<?php

namespace Morainstein\Mvc\Models\Repositories;

use Morainstein\Mvc\Models\Entities\User;
use PDO;

class UserRepository extends PdoRepository
{

  protected PDO $conn;
  protected string $table = "usuarios";

  public function __construct()
  {
    parent::__construct();
  }

  public function addUser(User $user) : bool
  {
    return $this->add($user);
  }

  public function removeUser(string $idUser) : bool
  {
    return $this->remove($idUser);
  }

  public function updateUser(User $user) : bool
  {
    return $this->update($user);
  }

  public function findUserById(string $idUser) : ?User
  {
    $result = $this->findById($idUser);

    if($result){
      $user = new User($result['nome'],$result['email'],$result['senha'],$result['titulo']);
      $user->setId($result['id']);
      return $user;
    }

    return null;
  }

  /**
   * @return User[] 
   */
  public function all() : array
  {
    $query = "SELECT id, nome, email FROM {$this->table} ORDER BY nome;";
    $result = $this->conn->query($query)->fetchAll();

    $pessoaslist = [];
    foreach($result as $pessoa){
      $p = new User($pessoa['nome'],$pessoa['email'],null,$pessoa['titulo'] ?? null);
      $p->setId($pessoa['id']);
      $pessoaslist[] = $p;
    }
    return $pessoaslist;
  }

  public function findUserByEmail(string $email) : User
  {
    $query = "SELECT * FROM {$this->table} WHERE email LIKE ?;";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$email]);
    $result = $stmt->fetch();
    
    $user = new User($result['nome'],$result['email'], null,$result['titulo'] ?? null);
    $user->setId($result['id']);

    return $user;
  }

  public function userExistsByEmail(string $email) : bool
  {
    $query = "SELECT id FROM {$this->table} WHERE email = ?;";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$email]);
    return $stmt->fetch() !== false;
  }
  
  
  public function checkForUserWithEmailAndPassword(string $email, string $senha) : ?User
  {
    $query = "SELECT * FROM {$this->table} WHERE email = ?;";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$email]);
    $result = $stmt->fetch();

    if ($result && password_verify($senha, $result['senha'])) {
        $user = new User($result['nome'], $result['email'], null, $result['titulo'] ?? null);
        $user->setId($result['id']);
        return $user;
    }

    return null;
  }public function updateProfile( string $nome, string $email, string $titulo) : bool
  {
    $query = "UPDATE {$this->table} SET nome = ?, email = ?, titulo = ? WHERE email = ?;";
    $stmt = $this->conn->prepare($query);
    return $stmt->execute([$nome, $email, $titulo, $email]);
  }
}